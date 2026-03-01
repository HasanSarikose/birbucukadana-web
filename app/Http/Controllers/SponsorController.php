<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use App\Models\SponsorshipPackage;
use App\Models\Team;
use Illuminate\Http\Request;

class SponsorController extends Controller
{

    public function Sponsorlar($team_slug)
    {
        $team = Team::where('slug', $team_slug)->firstOrFail();
        $packages = SponsorshipPackage::with(['sponsors' => function ($query) use ($team) {
            $query->where('team_id', $team->id);
        }])->orderBy('order')->get();

        return view('takimlar.sponsorlar', compact('team', 'packages'));
    }
    public function SponsorEkle()
    {
        $paket = SponsorshipPackage::orderBy('order')->get();
        return view('admin/team/sponsor/sponsor_ekle', compact('paket'));
    }
    public function SponsorEklePost(Request $request)
    {
        $request->validate([
            'team_id' => 'required',
            'package_id' => 'required',
            'name' => 'required',
            'logo_path' => 'required | mimes:jpeg,jpg,png',
        ]);
        $sponsor = new Sponsor();
        $sponsor->team_id = $request->input('team_id');
        $sponsor->package_id = $request->input('package_id');
        $sponsor->name = $request->input('name');
        if ($request->hasFile('logo_path')) {
            $file = $request->file('logo_path');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/takımlar/sponsorlar/';
            $file->move(public_path($path), $filename);
            $sponsor->logo_path = $path . $filename;
        }
        if($sponsor->save()){
            return redirect()->route('teamdashboard');
        }else{
            return redirect()->back();
        }
    }
    public function SponsorListele($team_slug)
    {
        $team = Team::where('slug', $team_slug)->first();
        $sponsors = Sponsor::where('team_id', $team->id)->get();
        return view('admin/team/sponsor/listele', compact('sponsors'));
    }
    public function SponsorEdit($id)
    {
        $sponsor = Sponsor::find($id);
        $team = Team::find($sponsor->team_id);
        $packages = SponsorshipPackage::find($sponsor->package_id);
        return view('admin/team/sponsor/edit', compact('sponsor', 'team', 'packages'));
    }
    public function SponsorSil($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        if ($sponsor->logo_path && file_exists(public_path($sponsor->logo_path))) {
            unlink(public_path($sponsor->logo_path));
        }
        if ($sponsor->delete()) {
            return redirect()->route('teamdashboard')->with('success', 'Sponsor başarıyla silindi.');
        } else {
            return redirect()->back()->with('error', 'Sponsor silinirken bir hata oluştu.');
        }
    }
    public function SponsorUpdate(Request $request, $id)
    {
        $request->validate([
            'team_id' => 'required',
            'package_id' => 'required',
            'name' => 'required',
            'logo_path' => 'nullable | mimes:jpeg,jpg,png',
        ]);
        $sponsor = Sponsor::find($id);
        $sponsor->team_id = $request->input('team_id');
        $sponsor->package_id = $request->input('package_id');
        $sponsor->name = $request->input('name');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/takımlar/sponsorlar/';
            $file->move(public_path($path), $filename); // public_path ile dosya yolu düzeltiliyor
            $sponsor->logo_path = $path . $filename; // 💡 EKLENEN KISIM: Veritabanına dosya yolunu ekliyoruz
        }
        if($sponsor->save()){
            return redirect()->route('teamdashboard');
        }else{
            return redirect()->back();
        }
    }
    public function SponsorPaketEkle()
    {
        return view('admin/team/sponsor/sponsor_paket_ekle');
    }
    public function SponsorPaketEklePost(Request $request)
    {
        $request->validate([
            'team_id' => 'required',
            'title' => 'required | max:255',
            'order' => 'required',
        ]);
        $paket = new SponsorshipPackage();
        $paket->team_id = $request->input('team_id');
        $paket->title = $request->input('title');
        $paket->order = $request->input('order');
        if ($paket->save()) {
            return redirect()->route('teamdashboard');
        }else{
            return redirect()->back();
        }
    }

    public function SponsorPaketListele($team_slug)
    {
        $team = Team::where('slug', $team_slug)->first();
        $packages = SponsorshipPackage::where('team_id', $team->id)->get();
        return view('admin/team/sponsor/paket_listele', compact('packages','team'));
    }

    public function SponsorPaketEdit($id)
    {
        $packages = SponsorshipPackage::find($id);
        return view('admin/team/sponsor/paket_edit', compact('packages'));
    }
    public function SponsorPaketUpdate($id, Request $request)
    {
        $request->validate([
            'team_id' => 'required',
            'title' => 'required | max:255',
            'order' => 'required',
        ]);
        $paket = SponsorshipPackage::find($id);
        $paket->team_id = $request->input('team_id');
        $paket->title = $request->input('title');
        $paket->order = $request->input('order');
        if ($paket->save()) {
            return redirect()->route('teamdashboard');
        }else{
            return redirect()->back();
        }
    }
    public function SponsorPaketSil($id)
    {
        $paket = SponsorshipPackage::find($id);

        if ($paket->delete()) {
            return redirect()->route('teamdashboard')->with('success', 'Paket başarıyla silindi.');
        } else {
            return redirect()->back()->with('error', 'Paket silinirken bir hata oluştu.');
        }
    }


}
