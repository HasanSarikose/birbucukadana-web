<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TGaleri;
use App\Models\TUrun;
use Illuminate\Http\Request;

class TGaleriController extends Controller
{
    public function TGaleri($team_slug)
    {
        $team = Team::where('slug', $team_slug)->firstOrFail();
        $fotos = TGaleri::where('team_id', $team->id)->get();
        return view('takimlar/galeri', compact('team', 'fotos'));
    }
    public function TGaleriekle()
    {
        return view('admin/team/galeri/ekle');
    }
    public function TGalerieklePost(Request $request)
    {
        $request->validate([
            'team_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'baslik' => 'required',
            'aciklama' => 'required',
        ]);
        $foto = new TGaleri();
        $foto->team_id = $request->input('team_id');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/takimlar/galeri/';
            $file->move(public_path($path), $filename);
            $foto->image = $path . $filename;
        }
        $foto->baslik = $request->input('baslik');
        $foto->aciklama = $request->input('aciklama');
        if ($foto->save()) {
            return redirect()->route('teamdashboard');
        }else{
            return redirect()->back();
        }
    }
    public function TGaleriListele($team_slug)
    {
        $team = Team::where('slug', $team_slug)->first();
        $galeri = TGaleri::where('team_id', $team->id)->get();
        return view('admin/team/galeri/listele', compact('team', 'galeri'));
    }
    public function TGaleriEdit($id)
    {
        $galeri = TGaleri::find($id);
        $team = Team::find($galeri->team_id);
        return view('admin/team/galeri/edit', compact('team', 'galeri'));
    }
    public function TGaleriUpdate(Request $request, $id)
    {
        $request->validate([
            'team_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'baslik' => 'required',
            'aciklama' => 'required',
        ]);
        $galeri = TGaleri::find($id);
        $galeri->team_id = $request->input('team_id');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/takimlar/galeri/';
            $file->move(public_path($path), $filename);
            $galeri->image = $path . $filename;
        }
        $galeri->baslik = $request->input('baslik');
        $galeri->aciklama = $request->input('aciklama');
        if ($galeri->save()) {
            return redirect()->route('teamdashboard');
        }else{
            return redirect()->back();
        }
    }
    public function TGaleriSil($id)
    {
        $galeri = TGaleri::find($id);

        if ($galeri->image && file_exists(public_path($galeri->image))) {
            unlink(public_path($galeri->image));
        }

        $galeri->delete();
        return redirect()->back()->with('success', 'Araç başarıyla silindi.');
    }

}
