<?php

namespace App\Http\Controllers;

use App\Models\TAnasayfa;
use App\Models\Team;
use App\Models\THakkimizda;
use App\Models\TUye;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TakimController extends Controller
{
    public function takimekle()
    {
        return view('admin/takim/takim_ekle');
    }

    public function takimeklePost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'website' => 'nullable',
            'instagram' => 'nullable',
            'linkedin' => 'nullable',
            'logo' => 'nullable|image|mimes:jpeg,jpg,png',
        ]);

        $team = new Team();
        $team->name = $request->input('name');
        $team->website = $request->input('website');
        $team->instagram = $request->input('instagram');
        $team->linkedin = $request->input('linkedin');

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/teams/';
            $file->move(public_path($path), $filename);
            $team->logo = $path . $filename;
        }

        if ($team->save()) {
            $user = new User();
            $user->name = $team->name . ' Sorumlu';
            $user->email = Str::slug($team->name) . '@takim.com';
            $user->password = Hash::make('admin123');
            $user->role = 'admin';
            $user->team_id = $team->id;
            $user->save();
            //$user->assignRole('admin');

            return redirect()->route('dashboard')->with('success', 'Takım ve kullanıcı başarıyla eklendi.');
        } else {
            return redirect()->back()->with('error', 'Takım eklenirken hata oluştu.');
        }
    }
    public function takimlistele()
    {
        $teams = Team::all();
        return view('admin/takim/listele',compact('teams'));
    }
    public function takimedit($id)
    {
        $takim = Team::find($id);
        return view('admin/takim/edit',compact('takim'));
    }
    public function takimUpdate(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'logo' => 'mimes:jpeg,jpg,png|nullable',
                'website' => 'nullable',
                'linkedin' => 'nullable',
                'instagram' => 'nullable'
            ]);

            $takim = Team::find($id);
            if (!$takim) {
                abort(404, 'Takım bulunamadı.');
            }

            $takim->name = $request->input('name');

            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = 'uploads/teams/';
                $file->move(public_path($path), $filename);
                $takim->logo = $path . $filename;
            }

            $takim->website = $request->input('website');
            $takim->linkedin = $request->input('linkedin');
            $takim->instagram = $request->input('instagram');

            if ($takim->save()) {
                return redirect()->route('takimlistele');
            } else {
                dd('Kayıt başarısız: save() false döndü');
            }

        } catch (\Exception $e) {
            dd('Hata oluştu:', $e->getMessage());
        }
    }
    public function takimDelete($id)
    {
        $team = Team::find($id);
        $team->delete(); // Sil
        return redirect()->back()->with('success', 'Araç başarıyla silindi.');
    }

    public function Tanasayfaekle()
    {
        return view('admin/team/anasayfa_ekle');
    }
    public function TanasayfaeklePost(Request $request)
    {
        $request->validate([
            'teamid'=>'required',
            'anasayfa'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $anasayfa = new TAnasayfa();
        $anasayfa->team_id = $request->input('teamid');
        $anasayfa->anasayfa = $request->input('anasayfa');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/takımlar/anasayfa/';
            $file->move(public_path($path), $filename); // public_path ile dosya yolu düzeltiliyor
            $anasayfa->image = $path . $filename; // 💡 EKLENEN KISIM: Veritabanına dosya yolunu ekliyoruz
        } else {
            return redirect()->back();
        }
        if($anasayfa->save())
        {
            return redirect()->route('dashboard');
        }else{
            return redirect()->back();
        }
    }
    public function tanasayfa($team_slug)
    {
        $team = Team::where('slug', $team_slug)->firstOrFail();
        $tanasayfa = TAnasayfa::where('team_id', $team->id)->firstOrFail();
        return view('takimlar.anasayfa', compact('team', 'tanasayfa'));
    }
    public function TanasayfaEdit($team_slug, $id)
    {
        $team = Team::where('slug', $team_slug)->firstOrFail();
        $tanasayfa = TAnasayfa::where('team_id', $team->id)->firstOrFail();
        return view('admin/team/anasayfa_edit', compact('team', 'tanasayfa'));
    }
    public function TanasayfaUpdate(Request $request, $id)
    {
        $request->validate([
            'team_id'=>'required',
            'anasayfa'=>'required',
            'image'=>'nullable|image|mimes:jpeg,png,jpg',
        ]);
        $post = TAnasayfa::find($id);
        $post->team_id = $request->input('team_id');
        $post->anasayfa = $request->input('anasayfa');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/takimlar/anasayfa/';
            $file->move(public_path($path), $filename);
            $post->image = $path . $filename; // Yeni resim kaydediliyor
        }
        if($post->save()){
            return redirect()->route('teamdashboard');
        }else{
            return redirect()->back();
        }
    }

    public function Thakkimizda($team_slug)
    {
        $team = Team::where('slug', $team_slug)->first();

        if (!$team) {
            abort(404);
        }

        $thakkimizda = THakkimizda::where('team_id', $team->id)->first(); // null olabilir

        return view('takimlar.hakkimizda', compact('team', 'thakkimizda'));
    }
    public function Thakkimizdaekle()
    {
        return view('admin/team/hakkimizda_ekle');
    }
    public function ThakkimizdaeklePost(Request $request)
    {
        $request->validate([
            'teamid'=>'required',
            'baslik'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg',
            'hakkimizda'=>'required'
        ]);

        $hakkimizda = new THakkimizda();
        $hakkimizda->team_id = $request->input('teamid');
        $hakkimizda->baslik = $request->input('baslik');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/takımlar/hakkimizda/';
            $file->move(public_path($path), $filename); // public_path ile dosya yolu düzeltiliyor
            $hakkimizda->image = $path . $filename; // 💡 EKLENEN KISIM: Veritabanına dosya yolunu ekliyoruz
        } else {
            return redirect()->back();
        }
        $hakkimizda->hakkimizda = $request->input('hakkimizda');
        if($hakkimizda->save()){
            return redirect()->route('dashboard');
        }else{
            return redirect()->back();
         }
    }
    public function ThakkimizdaEdit($team_slug, $id)
    {
        $team = Team::where('slug', $team_slug)->firstOrFail();
        $thakkimizda = THakkimizda::where('team_id', $team->id)->first();
        if (!$thakkimizda) {
            return redirect()->back()->with('error', 'Hakkımızda bilgisi bulunamadı.');
        }
        return view('admin/team/hakkimizda_edit', compact('team', 'thakkimizda'));
    }
    public function ThakkimizdaUpdate(Request $request, $id)
    {
        $request->validate([
            'team_id'=>'required',
            'baslik'=>'required',
            'image'=>'nullable|image|mimes:jpeg,png,jpg',
            'hakkimizda'=>'required'
        ]);
        $post = THakkimizda::find($id);
        if (!$post) {
            return redirect()->back()->with('error', 'Kayıt bulunamadı.');
        }
        $post->team_id = $request->input('team_id');
        $post->baslik = $request->input('baslik');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/takimlar/hakkımızda/';
            $file->move(public_path($path), $filename);
            $post->image = $path . $filename; // Yeni resim kaydediliyor
        }
        $post->hakkimizda = $request->input('hakkimizda');
        if($post->save()){
            return redirect()->route('teamdashboard');
        }else{
            return redirect()->back();
        }
    }

    public function TUyeler($team_slug, $year = null)
    {
        $team = Team::where('slug', $team_slug)->firstOrFail();

        // İlgili takıma ait tüm yıllar
        $years = TUye::where('team_id', $team->id)
            ->pluck('year')->unique()->sortDesc();

        // Yıl seçilmemişse en yeni yılı varsayalım
        if (!$year) {
            $year = $years->first();
        }

        // Seçilen yıla ait üyeleri al
        $tuyeler = TUye::where('team_id', $team->id)
            ->where('year', $year)
            ->get();

        return view('takimlar.uyeler', [
            'team' => $team,
            'tuyeler' => $tuyeler,
            'years' => $years,
            'selectedYear' => $year,
        ]);
    }
    public function TUyelerekle()
    {
        return view('admin/team/uyeler/uye_ekle');
    }
    public function TUyelereklePost(Request $request)
    {
        $request->validate([
            'teamid'=>'required',
            'year' =>'required',
            'name'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg',
            'task' =>'required',
            'email' =>'required',
            'linkedin' =>'required',
        ]);
        $uye = new TUye();
        $uye->team_id = $request->input('teamid');
        $uye->year = $request->input('year');
        $uye->name = $request->input('name');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/takımlar/uyeler/';
            $file->move(public_path($path), $filename); // public_path ile dosya yolu düzeltiliyor
            $uye->image = $path . $filename; // 💡 EKLENEN KISIM: Veritabanına dosya yolunu ekliyoruz
        } else {
            return redirect()->back();
        }
        $uye->task = $request->input('task');
        $uye->email = $request->input('email');
        $uye->linkedin = $request->input('linkedin');
        if($uye->save())
        {
            return redirect()->route('dashboard');
        }else{
            return redirect()->back();
        }
    }

    public function TUyelerEdit($id)
    {
        $uye = TUye::find($id);
        $team = \Illuminate\Support\Facades\DB::table('teams')->where('id', $uye->team_id)->first();
        if (!$team) {
            abort(404, "Takım bulunamadı");
        }
        $data = \Illuminate\Support\Facades\DB::table('t_uyeler')->get();
        return view('admin.team.uyeler.uye_edit', [
            'uye' => $uye,
            'team' => $team,
            'data' => $data,
        ]);
    }
    public function TUyelerEditPost(Request $request, $id)
    {
        // İstek verilerini doğrula
        $request->validate([
            'teamid' => 'required',
            'year' => 'required',
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
            'task' => 'required',
            'email' => 'required',
            'linkedin' => 'required',
        ]);

        // Takım üyesini bul
        $uye = TUye::findOrFail($id);

        // Veritabanı verilerini güncelle
        $uye->team_id = $request->input('teamid');
        $uye->year = $request->input('year');
        $uye->name = $request->input('name');

        // Resim dosyasını güncelle (varsa)
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/takımlar/uyeler/';
            $file->move(public_path($path), $filename);
            $uye->image = $path . $filename;
        }

        // Diğer bilgileri güncelle
        $uye->task = $request->input('task');
        $uye->email = $request->input('email');
        $uye->linkedin = $request->input('linkedin');

        // Veriyi kaydet
        if ($uye->save()) {
            return redirect()->route('dashboard')->with('success', 'Takım üyesi başarıyla güncellendi.');
        } else {
            return redirect()->back()->with('error', 'Bir hata oluştu, lütfen tekrar deneyin.');
        }
    }
    public function TUyelerListele(Request $request)
    {
        $user = auth()->user();

        // 1. Veritabanındaki kayıtlı Yılları bul (Tekrarsız - Dropdown için)
        // Eğer süper admin değilse sadece kendi takımının yıllarını görsün
        $yearsQuery = \App\Models\TUye::select('year')->distinct()->orderBy('year', 'desc');

        if ($user->role !== 'super_admin') {
            $yearsQuery->where('team_id', $user->team_id);
        }
        $years = $yearsQuery->pluck('year');

        // 2. Seçili Yılı Belirle (URL'den ?year=2025 gelirse onu al, yoksa Şimdiki Yıl)
        $selectedYear = $request->get('year', date('Y'));

        // 3. Verileri Filtrele
        $query = \App\Models\TUye::query();

        // Yetki kontrolü (Yine takım ayrımı)
        if ($user->role !== 'super_admin') {
            $query->where('team_id', $user->team_id);
        }

        // Yıl filtresini uygula
        $data = $query->where('year', $selectedYear)->get();

        // View'a yılları ve seçili yılı da gönderiyoruz
        return view('admin.team.uyeler.listele', compact('data', 'years', 'selectedYear'));
    }


}




