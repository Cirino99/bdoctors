<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/doctors', 'Api\DoctorController@index')->name('api.doctors.index');
Route::get('/doctors/{doctor}', 'Api\DoctorController@show')->name('api.doctors.show');
Route::get('/search/', 'Api\DoctorController@search')->name('api.doctors.search');
Route::get('/search/city', 'Api\DoctorController@city')->name('api.doctors.city');
Route::get('/search/specialization', 'Api\DoctorController@specialization')->name('api.doctors.specialization');
