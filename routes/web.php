<?php

use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\advisorController;
use App\Http\Controllers\AnasayfaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BasvuruController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HakkimizdaController;
use App\Http\Controllers\TakimController;
use App\Http\Controllers\AraclarController;

use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
});
*/


Route::controller(AuthController::class)->group(function () {
    Route::get('doglu', 'login')->name('login');
    Route::post('doglu', 'loginPost')->name('loginPost');
    /*
    Route::get('Adminregister', 'register')->name('register');
    Route::post('Adminregister', 'registerPost')->name('registerPost');
    */
    Route::post('logout', 'logout')->name('logout');
});


Route::controller(dashboardController::class)->group(function () {
    Route::get('', 'home')->name('home');

    Route::get('admin/dashboard','index')->name('dashboard')->middleware('auth');

});
Route::controller(TakimController::class)->group(function () {
    Route::get('admin/takimekle', 'takimekle')->name('takimekle');
    Route::post('admin/takimekle', 'takimeklePost')->name('takimeklePost');
    Route::get('admin/takim/listele', 'takimlistele')->name('takimlistele');
    Route::get('admin/takim/edit/{id}', 'takimedit')->name('takimedit');
    Route::post('admin/takim/edit/{id}', 'takimUpdate')->name('takimUpdate');
    Route::delete('admin/takim/delete/{id}', 'takimDelete')->name('takimDelete');

    Route::get('admin/team/anasayfa_ekle', 'Tanasayfaekle')->name('anasayfa_ekle');
    Route::post('admin/team/anasayfa_ekle', 'TanasayfaeklePost')->name('TanasayfaeklePost');
    Route::get('birbucukadana/{team_slug}/anasayfa', 'Tanasayfa')->name('Tanasayfa');
    Route::get('admin/team/anasayfa/edit/{team_slug}/{id}', 'TanasayfaEdit')->name('TanasayfaEdit');
    Route::post('admin/team/anasayfa/edit/{id}', 'TanasayfaUpdate')->name('TanasayfaUpdate');

    Route::get('birbucukadana/{team_slug}/hakkimizda', 'Thakkimizda')->name('Thakkimizda');
    Route::get('admin/team/hakkimizda_ekle', 'Thakkimizdaekle')->name('Thakkimizdaekle');
    Route::post('admin/team/hakimizda_ekle', 'ThakkimizdaeklePost')->name('ThakkimizdaeklePost');
    Route::get('admin/team/hakkimizda/edit/{team_slug}/{id}', 'ThakkimizdaEdit')->name('ThakkimizdaEdit');
    Route::post('admin/team/hakkimizda/edit/{id}', 'ThakkimizdaUpdate')->name('ThakkimizdaUpdate');

    Route::get('birbucukadana/{team_slug}/uyeler/{year?}/', 'TUyeler')->name('takim.uyeler');
    Route::get('admin//uyeler/ekle', 'TUyelerekle')->name('TUyelerekle');
    Route::post('admin/uyeler/ekle', 'TUyelereklePost')->name('TUyelereklePost');
    Route::get('admin/uyeler/edit/{id}','TUyelerEdit')->name('TUyelerEdit');
    Route::post('admin/uyeler/edit/{id}','TUyelerEditPost')->name('TUyelerEditPost');
    Route::get('admin/uyeler/listele','TUyelerListele')->name('TUyelerListele');
});
Route::controller(\App\Http\Controllers\BasarilarContoller::class)->group(function () {
    Route::get('birbucukadana/{team_slug}/basarilar', 'basarilar')->name('basarilar');
    Route::get('admin/basarilar/ekle', 'basarilarekle')->name('basarilarekle');
    Route::post('admin/basarilar/ekle', 'basarilareklePost')->name('basarilareklePost');
    Route::get('admin/basari/edit/{id}','basarilaredit')->name('basarilaredit');
    Route::post('admin/basari/edit/{id}','basarilareditPost')->name('basarilareditPost');
    Route::get('admin/basari/listele','basariListele')->name('basariListele');
});
Route::controller(\App\Http\Controllers\SponsorController::class)->group(function () {
    Route::get('birbucukadana/{team_slug}/sponsorlar', 'Sponsorlar')->name('Sponsorlar');
    Route::get('admin/sponsor/ekle', 'Sponsorekle')->name('Sponsorekle');
    Route::post('admin/sponsor/ekle', 'SponsorEklePost')->name('SponsorEklePost');
    Route::get('admin/sponsor/listele/{team_slug}','SponsorListele')->name('SponsorListele');
    Route::get('admin/sponsor/edit/{id}','SponsorEdit')->name('SponsorEdit');
    Route::post('admin/sponsor/edit/{id}','SponsorUpdate')->name('SponsorUpdate');
    Route::get('admin/sponsor/sil/{id}','SponsorSil')->name('SponsorSil');

    Route::get('admin/sponsor-paket/ekle', 'SponsorPaketEkle')->name('SponsorPaketEkle');
    Route::post('admin/sponsor-paket/ekle', 'SponsorPaketEklePost')->name('SponsorPaketEklePost');
    Route::get('admin/sponsor-paket/listele/{team_slug}', 'SponsorPaketListele')->name('SponsorPaketListele');
    Route::get('admin/sponsor-paket/edit/{id}','SponsorPaketEdit')->name('SponsorPaketEdit');
    Route::post('admin/sponsor-paket/edit/{id}','SponsorPaketUpdate')->name('SponsorPaketUpdate');
    Route::get('admin/sponsor-paket/sil/{id}','SponsorPaketSil')->name('SponsorPaketSil');
});
Route::controller(\App\Http\Controllers\AraclarController::class)->group(function () {
   Route::get('birbucukadana/{team_slug}/araclar', 'Araclar')->name('araclar');
   Route::get('admin/arac/ekle', 'aracekle')->name('aracekle');
   Route::post('admin/arac/ekle', 'araceklePost')->name('araceklePost');
   Route::get('admin/arac/listele/{team_slug}', 'AracListele')->name('aracListele');
   Route::get('admin/arac/edit/{id}','AracEdit')->name('aracEdit');
   Route::post('admin/arac/edit/{id}','AracUpdate')->name('aracUpdate');
   Route::delete('admin/arac/sil/{id}','AracSil')->name('aracSil');
});

Route::controller(\App\Http\Controllers\PortfolioController::class)->group(function () {
    Route::get('birbucukadana/{team_slug}/portfolio', 'Portfolio')->name('portfolio');
    Route::get('admin/portfolio/ekle', 'portfolioekle')->name('portfolioekle');
    Route::post('admin/portfolio/ekle', 'portfolioeklePost')->name('portfolioeklePost');
    Route::get('admin/portfolio/listele/{team_slug}', 'PortfolioListele')->name('portfolioListele');
    Route::get('admin/portfolio/edit/{id}','PortfolioEdit')->name('portfolioEdit');
    Route::post('admin/portfolio/edit/{id}','PortfolioUpdate')->name('portfolioUpdate');
    Route::delete('admin/portfolio/sil/{id}','PortfolioSil')->name('portfolioSil');
});

Route::controller(\App\Http\Controllers\TGaleriController::class)->group(function () {
   Route::get('birbucukadana/{team_slug}/galeri', 'TGaleri')->name('TGaleri');
   Route::get('admin/tgaleri/ekle', 'TGaleriekle')->name('TGaleriekle');
   Route::post('admin/tgaleri/ekle', 'TGalerieklePost')->name('TGalerieklePost');
   Route::get('admin/tgaleri/listele/{team_slug}', 'TGaleriListele')->name('TGaleriListele');
   Route::get('admin/tgaleri/edit/{id}','TGaleriEdit')->name('TGaleriEdit');
   Route::post('admin/tgaleri/edit/{id}','TGaleriUpdate')->name('TGaleriUpdate');
   Route::delete('admin/tgaleri/sil/{id}','TGaleriSil')->name('TGaleriSil');
});
Route::controller(AnasayfaController::class)->group(function () {
   Route::get('admin/anasayfa/ekle', 'anasayfaekle')->name('anasayfaekle');
   Route::post('admin/anasayfa/eklePost', 'anasayfaeklePost')->name('anasayfaeklePost');

   Route::get('admin/anasayfa/edit.blade.php/{id}', 'anasayfaedit')->name('anasayfaedit');
   Route::post('admin/anasayfa/editPost/{id}', 'anasayfaeditPost')->name('anasayfaeditPost');

   Route::get('admin/duyuru/ekle', 'duyuruekle')->name('duyuruekle');
   Route::post('admin/duyuru/eklePost', 'duyurueklePost')->name('duyurueklePost');
   Route::get('admin/duyuru/edit.blade.php/{id}', 'duyuruedit')->name('duyuruedit');
   Route::post('admin/duyuru/editPost/{id}', 'duyurueditPost')->name('duyurueditPost');

   Route::get('admin/duyuru/ara', 'duyuruarama')->name('duyuruara');
   Route::post('admin/duyuru/arama', 'duyuruarama')->name('duyuruarama');
   Route::get('admin/duyuru/listele', 'duyurulistele')->name('duyurulistele');
});

Route::controller(HakkimizdaController::class)->group(function () {
    Route::get('hakkimizda', 'hakkimizda')->name('hakkimizda');
   Route::get('hakkimizda', 'hakkimizda')->name('hakkimizda');
   Route::get('admin/hakkimizda/hakkimizdaekle', 'hakkimizdaekle')->name('hakkimizdaekle');
   Route::post('admin/hakkimizda/hakkimizdaeklePost', 'hakkimizdaeklePost')->name('hakkimizdaeklePost');
   Route::get('admin/hakkimizda/edit.blade.php/{id}', 'hakkimizdaedit')->name('hakkimizdaedit');
   Route::post('admin/hakkimizda/editPost/{id}', 'hakkimizdaeditPost')->name('hakkimizdaeditPost');

   Route::get('admin/pasttonow/ekle', 'pasttonowekle')->name('pasttonowekle');
   Route::post('admin/pasttonow/eklePost', 'pasttonoweklePost')->name('pasttonoweklePost');
   Route::get('admin/pasttonow/edit/{id}', 'pasttonowekleedit')->name('pasttonowedit');
   Route::post('admin/pasttonow/editPost/{id}', 'pasttonoweditPost')->name('pasttonoweditPost');
   /*
   Route::get('admin/pasttonow/ara', 'pasttonowara')->name('pasttonowara');
   Route::post('admin/pasttonow/arama', 'pasttonowara')->name('pasttonowara');
   */
   Route::get('admin/pasttonow/listele', 'pasttonowlistele')->name('pasttonowlistele');
});

Route::controller(\App\Http\Controllers\advisorController::class)->group(function () {
    Route::get('advisor', 'advisor')->name('advisor');
    Route::get('admin/advisor/ekle', 'advisorekle')->name('advisorekle');
    Route::post('admin/advisor/eklePost', 'advisoreklePost')->name('advisoreklePost');
    Route::get('admin/advisor/edit/{id}', 'advisoredit')->name('advisoredit');
    Route::post('admin/advisor/editPost/{id}', 'advisoreditPost')->name('advisoreditPost');
    Route::get('admin/advisor/listele', 'advisorlistele')->name('advisorlistele');
});

Route::controller(GaleriController::class)->group(function () {
    Route::get('galeri', 'galeri')->name('galeri');
    Route::get('admin/galeri/ekle', 'galeriekle')->name('galeriekle');
    Route::post('admin/galeri/eklePost', 'galerieklePost')->name('galerieklePost');
    Route::get('admin/galeri/edit/{id}', 'galeriedit')->name('galeriedit');
    Route::post('admin/galeri/editPost/{id}', 'galerieditPost')->name('galerieditPost');
    Route::get('admin/galeri/listele', 'galerilistele')->name('galerilistele');
});

Route::controller(ContactController::class)->group(function () {
    Route::get('contact', 'contact')->name('contact');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/takim/teamdashboard', [DashboardController::class, 'teamdashboard'])->name('teamdashboard');
});
Route::controller(BasvuruController::class)->group(function () {
    Route::get('basvuru', 'basvuru')->name('basvuru');
    Route::post('basvuru', 'basvuruPost')->name('basvuruPost');
    Route::get('basvuru_listele', 'basvurulistele')->name('basvurulistele');
    Route::post('admin/basvuru/onayla/{id}', 'approve')->name('admin.basvuru.approve');
    Route::delete('admin/basvuru/sil/{id}', 'destroy')->name('admin.basvuru.delete');
});

Route::controller(\App\Http\Controllers\ClubController::class)->middleware(['auth'])->group(function () {
    Route::get('admin/kulupler/ekle', 'create')->name('admin.clubs.create');
    Route::post('admin/kulupler/kaydet', 'store')->name('admin.clubs.store');
    Route::get('admin/kulup/bilgilerim', 'myClub')->name('admin.clubs.my_club');
    Route::post('admin/kulup/bilgilerim/guncelle', 'updateMyClub')->name('admin.clubs.update_my_club');
    Route::post('admin/kulup/resim-yukle', 'uploadImage')->name('admin.clubs.upload_image');

    Route::get('kulupler/{slug}', 'detay')->name('kulup.detay');
    Route::get('kulupler/{slug}/iletisim',  'iletisim')->name('kulup.iletisim');
    Route::get('kulupler/{slug}/yonetim-kurulu', 'yonetimKurulu')->name('kulup.yonetim_kurulu');

    // Ziyaretçi Kulüp Etkinlikleri Listesi
    Route::get('kulupler/{slug}/etkinlikler', 'etkinlikler')->name('kulup.etkinlikler');

// Ziyaretçi Kulüp Etkinlik Detayı (Uzun yazıyı okumak için)
    Route::get('kulupler/{slug}/etkinlik/{event_slug}', 'etkinlikDetay')->name('kulup.etkinlik_detay');

    Route::get('kulupler/{slug}/galeri', 'galeri')->name('kulup.galeri');

});

// --- Kulüp Yönetim Kurulu İşlemleri (Sadece club_admin) ---
Route::controller(\App\Http\Controllers\ClubMemberController::class)->middleware(['auth'])->group(function () {
    Route::get('admin/kulup/uyeler', 'index')->name('admin.club_members.index');
    Route::get('admin/kulup/uyeler/ekle', 'create')->name('admin.club_members.create');
    Route::post('admin/kulup/uyeler/kaydet', 'store')->name('admin.club_members.store');
    Route::get('admin/kulup/uyeler/duzenle/{id}', 'edit')->name('admin.club_members.edit');
    Route::post('admin/kulup/uyeler/guncelle/{id}', 'update')->name('admin.club_members.update');
    Route::delete('admin/kulup/uyeler/sil/{id}', 'destroy')->name('admin.club_members.destroy');
});

Route::controller(\App\Http\Controllers\ClubEventController::class)->middleware(['auth'])->group(function () {
    Route::get('admin/kulup/etkinlikler', 'index')->name('admin.club_events.index');
    Route::get('admin/kulup/etkinlikler/ekle', 'create')->name('admin.club_events.create');
    Route::post('admin/kulup/etkinlikler/kaydet', 'store')->name('admin.club_events.store');
    Route::get('admin/kulup/etkinlikler/duzenle/{id}', 'edit')->name('admin.club_events.edit');
    Route::post('admin/kulup/etkinlikler/guncelle/{id}', 'update')->name('admin.club_events.update');
    Route::delete('admin/kulup/etkinlikler/sil/{id}', 'destroy')->name('admin.club_events.destroy');
});

Route::controller(\App\Http\Controllers\ClubGalleryController::class)->middleware(['auth'])->group(function () {
    Route::get('admin/kulup/galeri', 'index')->name('admin.club_gallery.index');
    Route::post('admin/kulup/galeri/kaydet', 'store')->name('admin.club_gallery.store');
    Route::delete('admin/kulup/galeri/sil/{id}', 'destroy')->name('admin.club_gallery.destroy');
    Route::get('admin/kulup/galeri/duzenle/{id}', 'edit')->name('admin.club_gallery.edit');
    Route::post('admin/kulup/galeri/guncelle/{id}', 'update')->name('admin.club_gallery.update');
});
