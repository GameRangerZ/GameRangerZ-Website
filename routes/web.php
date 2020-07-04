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
Route::get('/about-us', 'PagesController@about_us');
Route::get('/airsoft' , 'PagesController@airsoft');
Route::get('/partner' , 'PagesController@partner');




Route::get('/airsoft', function () {
    return view('content.airsoft');
});
Route::get('/partner', function () {
    return view('content.partner');
});


//Gaming
Route::get('/gaming/rocket-league', 'PagesController@rocket_league');
Route::get('/gaming/league-of-legends', 'PagesController@league_of_legends');
Route::get('/gaming/arma-3', 'PagesController@arma3');
Route::get('/gaming/counter-strike-global-offensive', 'PagesController@csgo');
Route::get('/gaming/world-of-warcraft', 'PagesController@world_of_warcraft');

//News

Route::get('/news', 'NewsController@index');

//Users

Route::get('/home/{user}', 'HomeController@index')->name('profile.show');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
Route::get('/dashboard/{user}', 'HomeController@dashboard')->name('dashboard');

Auth::routes([
    'register' => true, // Registration Routes...
    'reset' => true, // Password Reset Routes...
    'verify' => true, // Email Verification Routes...
]);

//Steam Auth
Route::get('auth/steam', 'AuthController@redirectToSteam')->name('auth.steam');
Route::get('auth/steam/handle', 'AuthController@handle')->name('auth.steam.handle');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
