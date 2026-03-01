<?php

namespace App\Http\Controllers;

use App\Models\Basarilar;
use App\Models\Team;
use Illuminate\Http\Request;

class BasarilarContoller extends Controller
{
    public function Basarilar($team_slug)
    {
        $team = Team::where('slug', $team_slug)->firstOrFail();
        $achievements = Basarilar::where('team_id', $team->id)->get();

        return view('takimlar.basarilar', compact('team', 'achievements'));
    }
    public function basarilarekle()
    {
        return view('admin/team/basarilar/ekle');
    }
    public function basarilareklePost(Request $request){
        $request->validate([
            'team_id' => 'required|exists:teams,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|mimes:jpg,jpeg,png', // ✅ BOŞLUKLAR KALDIRILDI
        ]);

        $basari = new Basarilar;
        $basari->team_id = $request->input('team_id');
        $basari->title = $request->input('title');
        $basari->description = $request->input('description');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/takimlar/basarilar/';
            $file->move(public_path($path), $filename);
            $basari->image = $path . $filename;
        }

        if ($basari->save()) {
            return redirect()->route('teamdashboard');
        } else {
            dd("Kayıt başarısız", $basari);
        }
    }
    public function basarilaredit($id)
    {
        // Başarıyı veritabanından al
        $basari = Basarilar::findOrFail($id);

        // Takımı bul (başarı ile ilişkili takım)
        $team = Team::find($basari->team_id);

        // İlgili başarıyı ve takımı view'a gönder
        return view('admin/team/basarilar/edit', compact('basari', 'team'));
    }
    public function basarilareditPost(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png'
        ]);

        $basari = Basarilar::findOrFail($id);
        $basari->title = $request->input('title');
        $basari->description = $request->input('description');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/takimlar/basarilar/';
            $file->move(public_path($path), $filename);
            $basari->image = $path . $filename;
        }

        if($basari->save())
        {
            return redirect()->route('teamdashboard')->with('success', 'Başarı güncellendi!');
        }else{
            return redirect()->back();
        }


    }
    public function basariListele()
    {
        $data = Basarilar::all();
        return view('admin/team/basarilar/listele', compact('data'));
    }
}
