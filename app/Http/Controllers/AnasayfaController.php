<?php

namespace App\Http\Controllers;

use App\Models\Anasayfa;
use App\Models\Duyuru;
use App\Models\PasttoNow;
use Illuminate\Http\Request;

class AnasayfaController extends Controller
{
    public function anasayfaekle()
    {
        return view('admin/anasayfa/ekle');
    }
    public function anasayfaeklePost(Request $request)
    {
        $request->validate([
            'baslik' => 'required',
            'anasayfa' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png',
        ]);

        $anasayfa = new Anasayfa();
        $anasayfa->baslik = $request->input('baslik');
        $anasayfa->anasayfa = $request->input('anasayfa');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/anasayfa/';
            $file->move(public_path($path), $filename); // public_path ile dosya yolu düzeltiliyor
            $anasayfa->image = $path . $filename; // 💡 EKLENEN KISIM: Veritabanına dosya yolunu ekliyoruz
        } else {
            return redirect()->back();
        }

        if ($anasayfa->save()) {
            return redirect('admin/dashboard');
        } else {
            return redirect()->back();
        }
    }
    public function anasayfaedit($id)
    {
        $data['title'] = 'Anasayfa Düzenle';
        $data['anasayfa'] = Anasayfa::find($id);

        if (!$data['anasayfa']) {
            return redirect()->route('dashboard')->with('error', 'Anasayfa kaydı bulunamadı.');
        }

        return view('admin.anasayfa.edit', ['anasayfa' => $data['anasayfa']]);
    }

    public function anasayfaeditPost(Request $request, $id)
    {
        $request->validate([
            'baslik' => 'required',
            'anasayfa' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $anasayfa = Anasayfa::find($id);

        if (!$anasayfa) {
            return redirect()->route('anasayfaedit', ['id' => $id])->with('error', 'Anasayfa kaydı bulunamadı.');
        }

        $anasayfa->baslik = $request->input('baslik');
        $anasayfa->anasayfa = $request->input('anasayfa'); // Hatalı değişken düzeltildi

        // Eğer bir resim yüklendiyse güncelle
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/anasayfa/';
            $file->move(public_path($path), $filename);
            $anasayfa->image = $path . $filename; // Yeni resim kaydediliyor
        }

        $anasayfa->save();

        return redirect()->route('dashboard')->with('success', 'Anasayfa başarıyla güncellendi.');
    }
    public function duyuruekle()
    {
        return view('admin/duyuru/ekle');
    }
    public function duyurueklePost(Request $request)
    {
        $request->validate([
            'baslik' => 'required',
            'aciklama' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png',
        ]);

        $duyuru = new Duyuru();
        $duyuru->baslik = $request->input('baslik');
        $duyuru->aciklama = $request->input('aciklama');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/duyuru/';
            $file->move(public_path($path), $filename); // public_path ile dosya yolu düzeltiliyor
            $duyuru->image = $path . $filename; // 💡 EKLENEN KISIM: Veritabanına dosya yolunu ekliyoruz
        } else {
            return redirect()->back();
        }

        if ($duyuru->save()) {
            return redirect('admin/dashboard');
        } else {
            return redirect()->back();
        }
    }
    public function duyuruedit($id)
    {
        $data['title'] = 'Duyuru Düzenle';
        $data['duyuru'] = Duyuru::find($id);

        if (!$data['duyuru']) {
            return redirect()->route('dashboard')->with('error', 'duyuru kaydı bulunamadı.');
        }

        return view('admin.duyuru.edit', ['duyuru' => $data['duyuru']]);
    }


    public function duyurueditPost(Request $request, $id)
{
    $request->validate([
        'image' => 'nullable|mimes:jpeg,jpg,png',
        'baslik' => 'required',
        'yazi' => 'required',

    ]);
    $duyuru = Duyuru::find($id);

    if (!$duyuru) {
        return redirect()->route('duyuruedit', ['id' => $id])->with('error', 'Duyuru kaydı bulunamadı.');
    }
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $path = 'uploads/duyuru/';
        $file->move(public_path($path), $filename);
        $duyuru->image = $path . $filename; // Yeni resim kaydediliyor
    }
    $duyuru->baslik = $request->input('baslik');
    $duyuru->yazi = $request->input('yazi'); // Hatalı değişken düzeltildi

    // Eğer bir resim yüklendiyse güncelle


    if($duyuru->save()){
    return redirect()->route('dashboard')->with('success', 'Geçmişten Günümüze başarıyla güncellendi.');
    }else{
        return redirect()->back();
    }
}
    public function duyurulistele()
    {
        return view('admin/duyuru/listele');
    }
    public function duyuruara()
    {
        return view('admin/duyuru/ara');
    }
}
