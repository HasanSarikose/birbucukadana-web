<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClubGallery;
use Illuminate\Support\Facades\File; // <-- BU SATIRIN OLDUĞUNDAN EMİN OL
use Illuminate\Support\Str;

class ClubGalleryController extends Controller
{
    // 1. Galeriyi Listeleme (Admin)
    public function index()
    {
        $user = auth()->user();
        if ($user->role !== 'club_admin') { abort(403); }

        $images = ClubGallery::where('club_id', $user->club_id)->latest()->get();
        return view('admin.clubs.gallery.index', compact('images'));
    }

    // 2. Fotoğraf Kaydetme
    public function store(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120', // Max 5MB
            'caption' => 'nullable|string|max:255'
        ]);

        $gallery = new ClubGallery();
        $gallery->club_id = $user->club_id;
        $gallery->caption = $request->caption;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/clubs/gallery/';
            $file->move(public_path($path), $filename);
            $gallery->image = $path . $filename;
        }

        $gallery->save();

        return redirect()->back()->with('success', 'Fotoğraf galeriye eklendi.');
    }

    // 3. Fotoğraf Silme
    public function destroy($id)
    {
        $image = ClubGallery::findOrFail($id);
        if ($image->club_id !== auth()->user()->club_id) { abort(403); }

        if (File::exists(public_path($image->image))) {
            File::delete(public_path($image->image));
        }

        $image->delete();
        return redirect()->back()->with('success', 'Fotoğraf galeriden silindi.');
    }

    // Fotoğraf Düzenleme Sayfası
    public function edit($id)
    {
        $image = ClubGallery::findOrFail($id);
        if ($image->club_id !== auth()->user()->club_id) { abort(403); }

        return view('admin.clubs.gallery.edit', compact('image'));
    }

    // Fotoğraf Güncelleme İşlemi
    public function update(Request $request, $id)
    {
        $image = ClubGallery::findOrFail($id);
        if ($image->club_id !== auth()->user()->club_id) { abort(403); }

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'caption' => 'nullable|string|max:255'
        ]);

        $image->caption = $request->caption;

        if ($request->hasFile('image')) {
            // Eski dosyayı sil
            if (File::exists(public_path($image->image))) {
                File::delete(public_path($image->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/clubs/gallery/';
            $file->move(public_path($path), $filename);
            $image->image = $path . $filename;
        }

        $image->save();

        return redirect()->route('admin.club_gallery.index')->with('success', 'Fotoğraf başarıyla güncellendi.');
    }
}
