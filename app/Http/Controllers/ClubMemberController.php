<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClubMember;
use Illuminate\Support\Facades\File;

class ClubMemberController extends Controller
{
    // 1. Üyeleri Listeleme
    public function index()
    {
        $user = auth()->user();
        if ($user->role !== 'club_admin') { abort(403, 'Yetkisiz işlem.'); }

        // Sadece giriş yapan adminin kulübüne ait üyeleri getir
        $members = ClubMember::where('club_id', $user->club_id)->get();

        return view('admin.clubs.members.index', compact('members'));
    }

    // 2. Üye Ekleme Sayfası
    public function create()
    {
        if (auth()->user()->role !== 'club_admin') { abort(403); }
        return view('admin.clubs.members.create');
    }

    // 3. Üyeyi Veritabanına Kaydetme
    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user->role !== 'club_admin') { abort(403); }

        $request->validate([
            'name'      => 'required|string|max:255',
            'title'     => 'required|string|max:255',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'instagram' => 'nullable|url',
            'linkedin'  => 'nullable|url',
        ]);

        $member = new ClubMember();
        $member->club_id = $user->club_id; // Üyeyi bu kulübe bağla
        $member->name = $request->name;
        $member->title = $request->title;
        $member->instagram = $request->instagram;
        $member->linkedin = $request->linkedin;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/clubs/members/';
            $file->move(public_path($path), $filename);
            $member->image = $path . $filename;
        }

        $member->save();

        return redirect()->route('admin.club_members.index')->with('success', 'Yönetim kurulu üyesi başarıyla eklendi.');
    }

    // 4. Üye Düzenleme Sayfası
    public function edit($id)
    {
        $user = auth()->user();
        if ($user->role !== 'club_admin') { abort(403); }

        $member = ClubMember::findOrFail($id);

        // Güvenlik: Başka kulübün üyesini düzenlemeye çalışırsa engelle
        if ($member->club_id !== $user->club_id) { abort(403, 'Bu üyeyi düzenleme yetkiniz yok.'); }

        return view('admin.clubs.members.edit', compact('member'));
    }

    // 5. Üyeyi Güncelleme
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $member = ClubMember::findOrFail($id);

        if ($member->club_id !== $user->club_id) { abort(403); }

        $request->validate([
            'name'      => 'required|string|max:255',
            'title'     => 'required|string|max:255',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'instagram' => 'nullable|url',
            'linkedin'  => 'nullable|url',
        ]);

        $member->name = $request->name;
        $member->title = $request->title;
        $member->instagram = $request->instagram;
        $member->linkedin = $request->linkedin;

        if ($request->hasFile('image')) {
            // Eski resmi sil (isteğe bağlı ama sunucuda yer açar)
            if ($member->image && File::exists(public_path($member->image))) {
                File::delete(public_path($member->image));
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/clubs/members/';
            $file->move(public_path($path), $filename);
            $member->image = $path . $filename;
        }

        $member->save();

        return redirect()->route('admin.club_members.index')->with('success', 'Üye bilgileri güncellendi.');
    }

    // 6. Üye Silme
    public function destroy($id)
    {
        $user = auth()->user();
        $member = ClubMember::findOrFail($id);

        if ($member->club_id !== $user->club_id) { abort(403); }

        // Resmi de sunucudan sil
        if ($member->image && File::exists(public_path($member->image))) {
            File::delete(public_path($member->image));
        }

        $member->delete();

        return redirect()->back()->with('success', 'Üye başarıyla silindi.');
    }
}
