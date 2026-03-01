<?php

namespace App\Http\Controllers;

use App\Models\Advisor;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function galeri()
    {
        return view('galeri');
    }
    public function galeriekle()
    {
        return view('admin.galeri.ekle');
    }
    public function galerieklePost(Request $request)
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'title' => 'required',
            'yazi' => 'required',
        ]);
        $post = new Galeri();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/galeri/';
            $file->move(public_path($path), $filename); // public_path ile dosya yolu düzeltiliyor
            $post->image = $path . $filename; // 💡 EKLENEN KISIM: Veritabanına dosya yolunu ekliyoruz
        } else {
            return redirect()->back();
        }
        $post->title = $request->input('title');
        $post->yazi = $request->input('yazi');
        if($post->save()){
            return redirect()->route('dashboard');
        }else{
            return redirect()->back();
        }
    }
    public function galerilistele()
    {
        return view('admin.galeri.listele');
    }
    public function galeriedit($id)
    {
        $data['title'] = 'Galeri Düzenle';
        $data['galeri'] = Galeri::find($id);

        if (!$data['galeri']) {
            return redirect()->route('dashboard')->with('error', 'galeri kaydı bulunamadı.');
        }

        return view('admin.galeri.edit', ['galeri' => $data['galeri']]);
    }
    public function galerieditPost(Request $request, $id)
    {
        request()->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'title' => 'required',
            'yazi' => 'required',
        ]);
        $post = Galeri::find($id);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/galeri/';
            $file->move(public_path($path), $filename);
            $post->image = $path . $filename; // Yeni resim kaydediliyor
        }
        $post->title = $request->input('title');
        $post->yazi = $request->input('yazi');
        if($post->save()){
            return redirect()->route('galerilistele');
        }else{
            return redirect()->back();
        }
    }
}
