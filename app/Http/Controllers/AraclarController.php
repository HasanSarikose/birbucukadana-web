<?php

namespace App\Http\Controllers;

use App\Models\Basarilar;
use App\Models\Sponsor;
use App\Models\TAraclar;
use App\Models\Team;
use Illuminate\Http\Request;

class AraclarController extends Controller
{
    public function Araclar($team_slug)
    {
        $team = Team::where('slug', $team_slug)->firstOrFail();
        $arac = TAraclar::where('team_id', $team->id)->get();
        return view('takimlar/araclar', compact('team', 'arac'));
    }

    public function aracekle()
    {
        return view('admin/team/araclar/ekle');
    }
    public function araceklePost(Request $request)
    {
        $request->validate([
            'team_id' => 'required',
            'year' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
            'baslik' => 'required',
            'aciklama' => 'required',
        ]);
        $arac = new TAraclar;
        $arac->team_id = $request->input('team_id');
        $arac->year = $request->input('year');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/takimlar/araclar/';
            $file->move(public_path($path), $filename);
            $arac->image = $path . $filename;
        }
        $arac->baslik = $request->input('baslik');
        $arac->aciklama = $request->input('aciklama');
        if ($arac->save()) {
            return redirect()->route('teamdashboard');
        } else {
            return redirect()->back();
        }
    }
    public function AracListele($team_slug)
    {
        // Takımı slug'a göre bul
        $team = Team::where('slug', $team_slug)->firstOrFail();

        // İlgili araçları getir
        $araclar = TAraclar::where('team_id', $team->id)->get();

        return view('admin.team.araclar.listele', [
            'araclar' => $araclar,
            'team_slug' => $team_slug,
            'team' => $team// View'a slug'ı gönder
        ]);
    }
    public function AracEdit($id)
    {
        $arac = TAraclar::find($id);
        $team = Team::find($arac->team_id);
        return view('admin.team.araclar.edit', compact('arac', 'team'));
    }
    public function AracUpdate(Request $request, $id)
    {
        $request->validate([
            'team_id' => 'required',
            'year' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg',
            'baslik' => 'required',
            'aciklama' => 'required',
        ]);
        $arac = TAraclar::find($id);
        $arac->team_id = $request->input('team_id');
        $arac->year = $request->input('year');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/takimlar/araclar/';
            $file->move(public_path($path), $filename);
            $arac->image = $path . $filename;
        }
        $arac->baslik = $request->input('baslik');
        $arac->aciklama = $request->input('aciklama');
        if ($arac->save()) {
            return redirect()->route('teamdashboard');
        }else {
            return redirect()->back();
        }
    }

    public function AracSil($id)
    {
        // $team_slug olmadan da işlem yapılabilir, araç zaten id ile bulunabiliyor
        $arac = TAraclar::findOrFail($id);

        if ($arac->image && file_exists(public_path($arac->image))) {
            unlink(public_path($arac->image));
        }

        $arac->delete();

        return redirect()->back()->with('success', 'Araç başarıyla silindi.');
    }

}
