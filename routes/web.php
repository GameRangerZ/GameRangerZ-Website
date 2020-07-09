<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@index');

//Static Content
Route::get('/about-us', 'PagesController@about_us')->name('pages.about_us');
Route::get('/airsoft', 'PagesController@airsoft')->name('pages.airsoft');
Route::get('/partner', 'PagesController@partner')->name('pages.partner');

//Gaming
Route::get('/gaming/rocket-league', 'PagesController@rocket_league')->name('pages.rocket_league');
Route::get('/gaming/league-of-legends', 'PagesController@league_of_legends')->name('pages.league_of_legends');
Route::get('/gaming/arma-3', 'PagesController@arma3')->name('pages.arma3');
Route::get('/gaming/counter-strike-global-offensive', 'PagesController@csgo')->name('pages.csgo');
Route::get('/gaming/world-of-warcraft', 'PagesController@world_of_warcraft')->name('pages.world_of_warcraft');

//News

Route::get('/news', 'NewsController@index');

//Users
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
Route::get('/tetris/', 'TeamSpeakController@tetris')->name('tetris');
Route::POST('/tetris/submit', 'TeamSpeakController@tetrisSubmit')->name('tetris.submit');
Route::get('/achievements', 'HomeController@achievements')->name('achievements');

Auth::routes([
    'register' => true, // Registration Routes...
    'reset' => true, // Password Reset Routes...
    'verify' => true, // Email Verification Routes...
]);

//Steam Auth
Route::get('auth/steam', 'SteamAuthController@redirectToSteam')->name('auth.steam');
Route::get('auth/steam/handle', 'SteamAuthController@handle')->name('auth.steam.handle');
Route::get('auth/teamspeak', 'TeamSpeakController@FindAccount')->name('auth.teamspeak');
Route::get('auth/teamspeak/manual', 'TeamSpeakController@ChooseManual')->name('auth.teamspeak.manual');
Route::POST('auth/teamspeak/handle', 'TeamSpeakController@ClientSubmit')->name('auth.teamspeak.submit');
Route::POST('auth/teamspeak/verifycode', 'TeamSpeakController@VerifyCode')->name('auth.teamspeak.verifycode');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

//Legal
Route::get('datenschutz', 'PagesController@datenschutz')->name('datenschutz');
Route::get('impressum', 'PagesController@impressum')->name('impressum');
