<?php

use Illuminate\Support\Facades\Route;

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

Route::get('updateCities', 'App\Http\Controllers\CitiesController@updateCities'); //update Cities

Route::group(
    [
        'prefix' => 'json/{lang}',
        'namespace' => 'App\Http\Controllers'
    ],
    static function () {
        Route::get('getCities', 'CitiesController@getCities');
    });