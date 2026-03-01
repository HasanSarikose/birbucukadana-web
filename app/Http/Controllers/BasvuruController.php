<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Basvuru; // Basvuru modelini import ettik
use App\Models\Team;    // Team modelini import ettik (Model yolun farklıysa burayı düzelt)

class BasvuruController extends Controller
{
    public function basvuru()
    {
        $teams = Team::all();
        return view('basvuru', compact('teams'));
    }

    public function basvuruPost(Request $request)
    {
        $request->validate([
            'team_id' => 'required',
            'ad_soyad' => 'required',
            'email' => 'required|email', // email formatı kontrolü ekledim
            'linkedin' => 'required',
            'task' => 'required',
            'year' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Dosya güvenliği için
        ]);

        $basvuru = new Basvuru();
        $basvuru->ad_soyad = $request->input('ad_soyad');
        $basvuru->email = $request->input('email');
        $basvuru->linkedin = $request->input('linkedin');
        $basvuru->task = $request->input('task');
        $basvuru->year = $request->input('year');
        $basvuru->team_id = $request->input('team_id');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/uyeler2/';
            $file->move(public_path($path), $filename);

            // DİKKAT: Veritabanında sütun adın 'logo' mu 'image' mi?
            // Migration dosyanı kontrol et. Genelde 'image' kullanmıştın.
            $basvuru->foto = $path . $filename;
        }

        if ($basvuru->save()) {
            // 2. Düzeltme: Başarılı olursa geri dön ve mesaj ver
            return redirect()->route('home')->with('success', 'Başvurunuz başarıyla alındı.');
        } else {
            return redirect()->back()->with('error', 'Bir hata oluştu.');
        }
    }
    public function basvurulistele(Request $request)
    {
        $user = auth()->user();

        // Sorguyu başlat
        $query = Basvuru::query();

        // EĞER SÜPER ADMİN İSE:
        if ($user->role === 'super_admin') {
            // Sidebar'dan gelen ?team_id=5 gibi bir filtre varsa onu uygula
            if ($request->has('team_id')) {
                $query->where('team_id', $request->team_id);
            }
            // Yoksa hepsini getirir.
        }
        // EĞER TAKIM YÖNETİCİSİ İSE:
        else {
            // Sadece kendi takımını zorunlu getir
            $query->where('team_id', $user->team_id);
        }

        // Onaylanmamışları (0), yeniden eskiye sırala
        $basvurular = $query->where('onaylandi_mi', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.basvuru_listele', compact('basvurular'));
    }

// Onaylama Fonksiyonu
    public function approve($id)
    {
        $basvuru = Basvuru::findOrFail($id);

        // Yetki Kontrolü
        $user = auth()->user();
        if ($user->role !== 'super_admin' && $user->team_id !== $basvuru->team_id) {
            abort(403, 'Yetkisiz işlem');
        }
        $resimYolu = $basvuru->foto ?? 'assets/back/dist/img/avatar.png';

        // t_uyeler Tablosuna Aktarım
        \App\Models\TUye::create([
            'team_id' => $basvuru->team_id,
            'name'    => $basvuru->ad_soyad,
            'email'   => $basvuru->email,
            'linkedin'=> $basvuru->linkedin ?? '#',
            'task'    => $basvuru->task,
            'year'    => $basvuru->year,
            'image'   => $resimYolu, // $basvuru->foto'dan gelen veriyi buraya (image sütununa) yaz
        ]);

        // Başvuruyu Onaylandı olarak güncelle
        $basvuru->update(['onaylandi_mi' => 1]);

        return redirect()->back()->with('success', 'Öğrenci takıma başarıyla eklendi.');
    }

// Silme Fonksiyonu
    public function destroy($id)
    {
        $basvuru = Basvuru::findOrFail($id);
        // Yetki kontrolü buraya da eklenebilir...
        $basvuru->delete();
        return redirect()->back()->with('success', 'Başvuru silindi.');
    }
}
