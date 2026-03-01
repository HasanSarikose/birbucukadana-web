<?php

namespace App\Http\Controllers;

use App\Models\Anasayfa;
use App\Models\Duyuru;
use App\Models\PasttoNow;
use Illuminate\Http\Request;
use App\Models\Hakkimizda;

class HakkimizdaController extends Controller
{
    public function hakkimizda()
    {
        $hakkimizda = Hakkimizda::first();
        return view('hakkimizda', compact('hakkimizda'));
    }
    public function hakkimizdaekle()
    {
        return view('admin/hakkimizda/ekle');
    }
    public function hakkimizdaeklepost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'hakkimizda' => 'required',
        ]);
        $hakkimizda = new Hakkimizda();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/hakkimizda/';
            $file->move(public_path($path), $filename); // public_path ile dosya yolu düzeltiliyor
            $hakkimizda->image = $path . $filename; // 💡 EKLENEN KISIM: Veritabanına dosya yolunu ekliyoruz
        }
        $hakkimizda->hakkimizda = $request->input('hakkimizda');
        if ($hakkimizda->save()) {
            return redirect()->route('dashboard');
        }else
        {
            return redirect()->back();
        }

    }
    public function hakkimizdaedit($id)
    {
        $data['title'] = 'Hakkımızda Düzenle';
        $data['hakkimizda'] = Hakkimizda::find($id);

        if (!$data['hakkimizda']) {
            return redirect()->route('dashboard')->with('error', 'Hakkımızda kaydı bulunamadı.');
        }

        return view('admin.hakkimizda.edit', ['hakkimizda' => $data['hakkimizda']]);
    }
    public function hakkimizdaeditPost(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'hakkimizda' => 'required',
        ]);
        $hakkimizda = Hakkimizda::find($id);
        if (!$hakkimizda) {
            return redirect()->route('hakkimizdaedit', ['id' => $id])->with('error', 'Hakkımızda kaydı bulunamadı.');
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/hakkimizda/';
            $file->move(public_path($path), $filename);
            $hakkimizda->image = $path . $filename; // Yeni resim kaydediliyor
        }
        $hakkimizda->hakkimizda = $request->input('hakkimizda');
        if ($hakkimizda->save()) {
            return redirect()->route('dashboard');
        }else{
            return redirect()->back();
        }
    }

    public function pasttonowekle()
    {
        return view('admin/pasttonow/ekle');
    }
    public function pasttonoweklepost(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'baslik' => 'required',
            'yazi' => 'required',
        ]);
        $post = new PasttoNow();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/pasttonow/';
            $file->move(public_path($path), $filename); // public_path ile dosya yolu düzeltiliyor
            $post->image = $path . $filename; // 💡 EKLENEN KISIM: Veritabanına dosya yolunu ekliyoruz
        }
        $post->baslik = $request->input('baslik');
        $post->yazi = $request->input('yazi');
        if ($post->save()) {
            return redirect()->route('dashboard');
        }else{
            return redirect()->back();
        }
    }
    public function pasttonowekleedit($id)
    {
        $data['title'] = 'Geçmişten Günümüze Düzenle';
        $data['pasttonow'] = PasttoNow::find($id);

        if (!$data['pasttonow']) {
            return redirect()->route('dashboard')->with('error', 'geçmişten günümüze kaydı bulunamadı.');
        }

        return view('admin.pasttonow.edit', ['pasttonow' => $data['pasttonow']]);
    }
    public function pasttonoweditPost(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|mimes:jpeg,jpg,png',
            'baslik' => 'required',
            'yazi' => 'required',

        ]);
        $post = PasttoNow::find($id);

        if (!$post) {
            return redirect()->route('pasttonowedit', ['id' => $id])->with('error', 'Duyuru kaydı bulunamadı.');
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/pasttonow/';
            $file->move(public_path($path), $filename);
            $post->image = $path . $filename; // Yeni resim kaydediliyor
        }
        $post->baslik = $request->input('baslik');
        $post->yazi = $request->input('yazi'); // Hatalı değişken düzeltildi

        // Eğer bir resim yüklendiyse güncelle


        if($post->save()){
            return redirect()->route('dashboard')->with('success', 'Geçmişten Günümüze başarıyla güncellendi.');
        }else{
            return redirect()->back();
        }
    }
    public function pasttonowlistele()
    {
        return view('admin/pasttonow/listele');
    }

}

