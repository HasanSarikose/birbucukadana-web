<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClubEvent;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ClubEventController extends Controller
{
    // 1. Etkinlikleri Listeleme
    public function index()
    {
        $user = auth()->user();
        if ($user->role !== 'club_admin') { abort(403, 'Yetkisiz işlem.'); }

        // Sadece kendi kulübünün etkinliklerini getir
        $events = ClubEvent::where('club_id', $user->club_id)->orderBy('event_date', 'desc')->get();

        return view('admin.clubs.events.index', compact('events'));
    }

    // 2. Etkinlik Ekleme Sayfası
    public function create()
    {
        if (auth()->user()->role !== 'club_admin') { abort(403); }
        return view('admin.clubs.events.create');
    }

    // 3. Etkinliği Kaydetme
    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user->role !== 'club_admin') { abort(403); }

        $request->validate([
            'title'      => 'required|string|max:255',
            'content'    => 'nullable|string', // CKEditor içeriği
            'event_date' => 'required|date',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        $event = new ClubEvent();
        $event->club_id    = $user->club_id;
        $event->title      = $request->title;
        // Slug otomatik olarak Model içindeki boot fonksiyonundan oluşturulacak
        $event->content = $request->input('content');
        $event->event_date = $request->event_date;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/clubs/events/';
            $file->move(public_path($path), $filename);
            $event->image = $path . $filename;
        }

        $event->save();

        return redirect()->route('admin.club_events.index')->with('success', 'Etkinlik başarıyla eklendi.');
    }

    // 4. Etkinlik Düzenleme Sayfası
    public function edit($id)
    {
        $user = auth()->user();
        $event = ClubEvent::findOrFail($id);

        if ($event->club_id !== $user->club_id) { abort(403, 'Bu etkinliği düzenleme yetkiniz yok.'); }

        return view('admin.clubs.events.edit', compact('event'));
    }

    // 5. Etkinliği Güncelleme
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $event = ClubEvent::findOrFail($id);

        if ($event->club_id !== $user->club_id) { abort(403); }

        $request->validate([
            'title'      => 'required|string|max:255',
            'content'    => 'nullable|string',
            'event_date' => 'required|date',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        $event->title      = $request->title;
        $event->content = $request->input('content');
        $event->event_date = $request->event_date;

        if ($request->hasFile('image')) {
            // Eski afişi sunucudan sil
            if ($event->image && File::exists(public_path($event->image))) {
                File::delete(public_path($event->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/clubs/events/';
            $file->move(public_path($path), $filename);
            $event->image = $path . $filename;
        }

        $event->save();

        return redirect()->route('admin.club_events.index')->with('success', 'Etkinlik başarıyla güncellendi.');
    }

    // 6. Etkinlik Silme
    public function destroy($id)
    {
        $user = auth()->user();
        $event = ClubEvent::findOrFail($id);

        if ($event->club_id !== $user->club_id) { abort(403); }

        if ($event->image && File::exists(public_path($event->image))) {
            File::delete(public_path($event->image));
        }

        $event->delete();

        return redirect()->back()->with('success', 'Etkinlik silindi.');
    }
}
