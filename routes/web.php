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

Route::get('/', function () {
    return view('welcome');
});

//Static Content

Route::get('/about-us', function () {
    return view('content.about-us');
});
Route::get('/airsoft', function () {
    return view('content.airsoft');
});
Route::get('/partner', function () {
    return view('content.partner');
});


//Gaming

Route::get('/gaming/rocket-league', function () {
    return view('content.gaming.rocket-league');
});
Route::get('/gaming/league-of-legends', function () {
    return view('content.gaming.league-of-legends');
});
Route::get('/gaming/arma-3', function () {
    return view('content.gaming.arma-3');
});
Route::get('/gaming/counter-strike-global-offensive', function () {
    return view('content.gaming.cs-go');
});
Route::get('/gaming/world-of-warcraft', function () {
    return view('content.gaming.world-of-warcraft');
});



//News

Route::get('/news', 'NewsController@index');

//Users

Route::get('/home/{user}', 'HomeController@index')->name('profile.show');




Auth::routes();

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
