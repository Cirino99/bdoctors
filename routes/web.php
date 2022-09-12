<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::middleware('auth')
    ->namespace('Doctor')
    ->name('doctor.')
    ->prefix('doctor')
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('dashboard');
    });

//Route::get('/home', 'Admin\HomeController@index')->name('home');