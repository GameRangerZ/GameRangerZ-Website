<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('welcome');
    }
    public function about_us(){
        SEOTools::setTitle('Über uns');

        return view('content.about-us');
    }
    public function airsoft(){
        SEOTools::setTitle('Airsoft');

        return view('content.airsoft');
    }
    public function partner(){
        SEOTools::setTitle('Partner');

        return view('content.partner');
    }
    public function world_of_warcraft(){
        SEOTools::setTitle('World of Warcraft');

        return view('content.gaming.world-of-warcraft');
    }
    public function rocket_league(){
        SEOTools::setTitle('Rocket League');

        return view('content.gaming.rocket-league');
    }
    public function league_of_legends(){
        SEOTools::setTitle('League of Legends');

        return view('content.gaming.league-of-legends');
    }

    public function arma3()
    {
        SEOTools::setTitle('ArmA 3');

        return view('content.gaming.arma-3');
    }

    public function csgo()
    {
        SEOTools::setTitle('CS:GO');

        return view('content.gaming.cs-go');
    }

    public function datenschutz()
    {
        SEOTools::setTitle('Datenschutz');

        return view('legal.datenschutz');
    }

    public function impressum()
    {
        SEOTools::setTitle('Impressum');

        return view('legal.impressum');
    }

}
