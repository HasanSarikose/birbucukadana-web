<?php

namespace App\Http\Controllers;

use App\Http\Middleware\auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function home()
    {    return view('welcome');


    }
    public function index()
    {
        return view('admin/dashboard');
    }
    public function teamdashboard()
    {
        $team = auth()->user()->team;
        return view('admin/teamdashboard', compact('team'));
    }
}
