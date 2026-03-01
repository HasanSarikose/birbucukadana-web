<?php

namespace App\Http\Controllers;

use App\Models\TAraclar;
use App\Models\Team;
use App\Models\TUrun;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function Portfolio($team_slug)
    {
        $team = Team::where('slug', $team_slug)->first();
        $products = TUrun::where('team_id', $team->id)->get();
        return view('takimlar/portfolio', compact('team', 'products'));
    }
    public function portfolioekle()
    {
        return view('admin/team/portfolio/ekle');
    }
    public function portfolioeklePost(Request $request)
    {
        $request->validate([
            'team_id' => 'required',
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'feature1' => 'required',
            'feature2' => 'required',
            'feature3' => 'required',
        ]);
        $urun = new TUrun();
        $urun->team_id = $request->input('team_id');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/takimlar/ürünler/';
            $file->move(public_path($path), $filename);
            $urun->image = $path . $filename;
        }
        $urun->name = $request->input('name');
        $urun->feature1 = $request->input('feature1');
        $urun->feature2 = $request->input('feature2');
        $urun->feature3 = $request->input('feature3');
        $urun->feature4 = $request->input('feature4');
        $urun->feature5 = $request->input('feature5');
        if ($urun->save()) {
            return redirect()->route('teamdashboard');
        } else {
            return redirect()->back();
        }
    }

    public function portfolioListele($team_slug)
    {
        $team = Team::where('slug', $team_slug)->firstOrFail();
        $urun = TUrun::where('team_id', $team->id)->get();

        return view('admin.team.portfolio.listele', [
            'urun' => $urun,
            'team_slug' => $team_slug,
            'team' => $team
        ]);
    }

    public function PortfolioEdit($id)
    {
        $urun = TUrun::find($id);
        $team = Team::find($urun->team_id);
        return view('admin.team.portfolio.edit', compact('urun', 'team'));
    }
    public function PortfolioUpdate(Request $request, $id)
    {
        $request->validate([
            'team_id' => 'required',
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'feature1' => 'required',
            'feature2' => 'required',
            'feature3' => 'required',
            'feature4' => 'nullable',
            'feature5' => 'nullable',
        ]);
        $urun = TUrun::find($id);
        $urun->team_id = $request->input('team_id');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/takimlar/urunler/';
            $file->move(public_path($path), $filename);
            $urun->image = $path . $filename;
        }
        $urun->name = $request->input('name');
        $urun->feature1 = $request->input('feature1');
        $urun->feature2 = $request->input('feature2');
        $urun->feature3 = $request->input('feature3');
        $urun->feature4 = $request->input('feature4');
        $urun->feature5 = $request->input('feature5');
        if ($urun->save()) {
            return redirect()->route('teamdashboard');
        }else{
            return redirect()->back();
        }
    }
    public function PortfolioSil($id)
    {
        $urun = TUrun::find($id);

        if ($urun->image && file_exists(public_path($urun->image))) {
            unlink(public_path($urun->image));
        }

        $urun->delete();

        return redirect()->back()->with('success', 'Araç başarıyla silindi.');
    }
}
