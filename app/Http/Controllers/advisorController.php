<?php

namespace App\Http\Controllers;

use App\Models\Advisor;
use App\Models\PasttoNow;
use Illuminate\Http\Request;

class advisorController extends Controller
{
    public function advisor()
    {
        return view('advisor');
    }
    public function advisorekle()
    {
        return view('admin.advisor.ekle');
    }
    public function advisoreklePost(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required',
            'linkedin' => 'required',
            'task' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $advisor = new advisor();
        $advisor->name = $request->input('name');
        $advisor->email = $request->input('email');
        $advisor->linkedin = $request->input('linkedin');
        $advisor->task = $request->input('task');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/advisor/';
            $file->move(public_path($path), $filename); // public_path ile dosya yolu düzeltiliyor
            $advisor->image = $path . $filename; // 💡 EKLENEN KISIM: Veritabanına dosya yolunu ekliyoruz
        } else {
            return redirect()->back();
        }
        if ($advisor->save()) {
            return redirect('admin/dashboard');
        } else {
            return redirect()->back();
        }

    }
    public function advisoredit($id)
    {
            $data['title'] = 'Danışman Düzenle';
            $data['advisor'] = Advisor::find($id);

            if (!$data['advisor']) {
                return redirect()->route('dashboard')->with('error', 'Danışman kaydı bulunamadı.');
            }

            return view('admin.advisor.edit', ['advisor' => $data['advisor']]);
    }
    public function advisoreditPost(Request $request, $id)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required',
            'linkedin' => 'required',
            'task' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $advisor = Advisor::find($id);
        $advisor->name = $request->input('name');
        $advisor->email = $request->input('email');
        $advisor->linkedin = $request->input('linkedin');
        $advisor->task = $request->input('task');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/pasttonow/';
            $file->move(public_path($path), $filename);
            $advisor->image = $path . $filename; // Yeni resim kaydediliyor
        }
        if($advisor->save()){
            return redirect()->route('dashboard')->with('success', 'Geçmişten Günümüze başarıyla güncellendi.');
        }else{
            return redirect()->back();
        }
    }
    public function advisorlistele()
    {
        return view('admin.advisor.listele');
    }
}
