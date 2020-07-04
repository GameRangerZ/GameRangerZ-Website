<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

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
    public function index($user)
    {
        $user = User::find($user);
        return view('home',['user' => $user]);
    }

    public function dashboard($user = false)
    {
        if(!$user){
            $user = Auth::user();
        }else{
            //User ID vorhanden
            $user = User::find($user);
        }
        return view('home',['user' => $user]);
    }
}
