<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClubController extends Controller
{
    // Kulüp Ekleme Sayfasını Gösterir
    public function create()
    {
        // Sadece super_admin erişebilsin güvenliği
        if (auth()->user()->role !== 'super_admin') {
            abort(403, 'Bu sayfaya erişim yetkiniz yok.');
        }

        return view('admin.clubs.create');
    }

    // Kulübü ve Kulüp Yöneticisini Veritabanına Kaydeder
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'super_admin') {
            abort(403, 'Bu işlem için yetkiniz yok.');
        }

        // 1. Gelen Verileri Doğrula
        $request->validate([
            'club_name' => 'required|string|max:255',
            'user_name' => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email', // Email sistemde benzersiz olmalı
            'password'  => 'required|min:6',
            'logo'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // 2. Transaction Başlat (Hata olursa işlemi geri al)
        DB::beginTransaction();

        try {
            // A) Kulübü Oluştur
            $club = Club::create([
                'name'  => $request->club_name,
                'slug'  => Str::slug($request->club_name),
                'about' => $request->about,
            ]);

            // Logo varsa yükle
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = 'uploads/clubs/';
                $file->move(public_path($path), $filename);

                $club->logo = $path . $filename;
                $club->save();
            }

            // B) Kulüp Yöneticisini (User) Oluştur ve Kulübe Bağla
            User::create([
                'name'     => $request->user_name,
                'email'    => $request->email,
                'password' => Hash::make($request->password), // Şifreyi kriptola
                'role'     => 'club_admin', // Yeni rolümüz
                'club_id'  => $club->id,    // Az önce oluşturulan kulübün ID'si
            ]);

            // Her şey başarılıysa onayla
            DB::commit();

            return redirect()->back()->with('success', 'Kulüp ve Yönetici Hesabı başarıyla oluşturuldu!');

        } catch (\Exception $e) {
            // Hata çıkarsa hiçbir şeyi kaydetme
            DB::rollBack();
            return redirect()->back()->with('error', 'Bir hata oluştu: ' . $e->getMessage());
        }
    }

    // Kulüp Yöneticisinin Kendi Kulübünü Görüntüleme Sayfası
    public function myClub()
    {
        $user = auth()->user();

        // Sadece club_admin girebilsin
        if ($user->role !== 'club_admin') {
            abort(403, 'Sadece Kulüp Yöneticileri bu sayfayı görebilir.');
        }

        // Kullanıcının bağlı olduğu kulübü bul
        $club = $user->club;

        if (!$club) {
            return redirect()->back()->with('error', 'Size atanmış bir kulüp bulunamadı.');
        }

        return view('admin.clubs.my_club', compact('club'));
    }

    // Kulüp Bilgilerini Güncelleme İşlemi
    public function updateMyClub(Request $request)
    {
        $user = auth()->user();

        if ($user->role !== 'club_admin') {
            abort(403, 'Yetkisiz işlem.');
        }

        $club = $user->club;

        $request->validate([
            'name'  => 'required|string|max:255',
            'about' => 'nullable|string',
            'logo'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $club->name = $request->name;
        $club->about = $request->about;

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/clubs/';
            $file->move(public_path($path), $filename);

            $club->logo = $path . $filename;
        }

        $club->save();

        return redirect()->back()->with('success', 'Kulüp bilgileriniz başarıyla güncellendi.');
    }
    // CKEditor içinden resim yükleme işlemi
    public function uploadImage(Request $request)
    {
        $user = auth()->user();
        if ($user->role !== 'club_admin') {
            abort(403, 'Yetkisiz işlem.');
        }

        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/clubs/content/'; // İçerik resimleri için ayrı bir klasör
            $file->move(public_path($path), $filename);

            $url = asset($path . $filename);

            // CKEditor'ün beklediği JSON formatında cevap dön
            return response()->json([
                'uploaded' => 1,
                'fileName' => $filename,
                'url'      => $url
            ]);
        }
    }

    public function detay($slug)
    {
        // Slug'a göre kulübü bul, bulamazsa 404 hata sayfası ver
        $club = \App\Models\Club::where('slug', $slug)->firstOrFail();

        // front/kulup_detay.blade.php sayfasını aç ve kulüp verisini yolla
        return view('clubs.kulup_detay', compact('club'));
    }
}
