<?php

use GuzzleHttp\Middleware;
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

Route::middleware('jwt.verify')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');
Route::get('profile', 'UserController@profile')->middleware('jwt.verify');
Route::patch('edit/profile', 'UserController@edit_profile')->middleware('jwt.verify');

Route::group(['namespace' => 'Api','middleware' => ['jwt.verify', 'role:nasabah']], function() {
    Route::get('nasabah/home', 'NasabahController@home');
    Route::get('nasabah/get_permintaan', 'PermintaanController@get_permintaan');
    Route::post('nasabah/permintaan', 'NasabahController@permintaan');
    
});

Route::group(['namespace' => 'Api', 'middleware' => ['jwt.verify', 'role:pengurus1']], function() {
    Route::get('pengurus1/get_permintaan', 'Pengurus1Controller@get_permintaan');
    Route::post('pengurus1/pendataan/{id}', 'Pengurus1Controller@pendataanJemput');
});

Route::group(['namespace' => 'Api', 'middleware' => 'jwt.verify'], function() {
    Route::get('permintaan/{id}', 'PermintaanController@get_permintaan_id');
});
