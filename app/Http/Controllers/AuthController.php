<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        $data['title']='Kullanıcı Girişi';
        return view('admin/auth/login',$data);

    }

    public function loginPost(Request $request)
    {
        $validatedData = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->with('sonuc','Kullanıcı Girişi Başarısız');
        }

    }

    public function register(){
        if (Auth::check()) {
            return redirect()->url('/AdminLogin');
        }else {
            $data['title'] = 'Üye Olma';
            return view('admin/auth/register', $data);
        }
    }

    public function registerPost(Request $request){
        $validatedData = $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required' ]);

        $kayit=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        if ($kayit){
            Auth::login($kayit);
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->with('sonuc','Kullanıcı Oluşturma Başarısız');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
