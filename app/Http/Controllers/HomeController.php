<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use QCod\Gamify\Badge;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function dashboard()
    {
        $user = Auth::user();
        return view('intern.dashboard', ['user' => $user]);
    }

    public function achievements()
    {
        $user = Auth::user();
        $achievements = Badge::all();

        return view('intern.achievements', ['user' => $user, 'achievements' => $achievements]);
    }
}
