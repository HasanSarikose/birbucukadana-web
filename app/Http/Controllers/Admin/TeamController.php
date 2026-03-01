<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:super-admin');  // sadece süper adminler erişebilsin
    }

    public function index()
    {
        $teams = Team::all();
        return view('admin.teams.index', compact('teams'));
    }

    public function create()
    {
        return view('admin.teams.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:teams,name',
        ]);

        // Takım oluşturuluyor
        $team = Team::create(['name' => $request->name]);

        // Kullanıcı oluşturuluyor
        $user = User::create([
            'name' => $request->name . ' Admin',
            'email' => Str::lower(Str::slug($request->name)) . '@example.com',
            'password' => Hash::make('password123'),
            'team_id' => $team->id,
        ]);

        return redirect()->route('admin.teams.index')->with('success', 'Team and user have been created!');
    }

    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        $team->users()->delete();  // Takıma ait kullanıcıyı sil
        $team->delete();  // Takımı sil

        return redirect()->route('admin.teams.index')->with('success', 'Team and user have been deleted!');
    }
}
