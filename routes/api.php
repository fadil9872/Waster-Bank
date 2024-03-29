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

Route::post('register', 'Api\UserController@register');
Route::post('login', 'Api\UserController@login');
Route::get('profile', 'Api\UserController@profile')->middleware('jwt.verify');
Route::patch('edit/profile', 'Api\UserController@edit_profile')->middleware('jwt.verify');
Route::get('home', 'Api\UserController@home')->middleware('jwt.verify');

Route::post('tambah/alamat', 'Api\AlamatController@addAlamat')->middleware('jwt.verify');
Route::patch('edit/alamat/{id}', 'Api\AlamatController@editAlamat')->middleware('jwt.verify');
Route::delete('hapus/alamat/{id}', 'Api\AlamatController@hapusAlamat')->middleware('jwt.verify');
Route::get('ubah/alamat/utama/{id}', 'Api\AlamatController@ubahAlamat')->middleware('jwt.verify');

// Route::get('message/{id}', 'Api\MessageController@getMessage')->middleware('jwt.verify');
Route::post('message/{id}', 'Api\MessageController@sendMessage')->middleware('jwt.verify');
Route::get('message/{id}', 'Api\MessageController@getMessage')->middleware('jwt.verify');
Route::get('kontak', 'Api\MessageController@indexKontak')->middleware('jwt.verify');

Route::post('password/email', 'Api\ForgotPasswordController@forgot');
Route::post('password/reset', 'Api\ForgotPasswordController@reset');

Route::get('email/resend', 'Api\VerificationController@resend')->name('verification.resend');

Route::get('email/verify/{id}/{hash}', 'Api\VerificationController@verify')->name('verification.verify');

Route::group(['namespace' => 'Api','middleware' => ['jwt.verify', 'role:nasabah']], function() {
    Route::get('nasabah/get_permintaan', 'NasabahController@get_permintaan');
    Route::post('nasabah/permintaan', 'NasabahController@permintaan');
    Route::get('nasabah/kontak/add', 'MessageController@addindexNasabah');
    Route::get('nasabah/tabungan', 'NasabahController@tabungan');
    Route::get('nasabah/coba', 'MessageController@indexCostumer');

});

Route::group(['namespace' => 'Api', 'middleware' => ['jwt.verify', 'role:pengurus1']], function() {
    Route::get('pengurus1/get_permintaan', 'Pengurus1Controller@get_permintaan');
    Route::get('pengurus1/get_sampah', 'Pengurus1Controller@get_sampah');
    Route::post('pengurus1/pendataan/{id}', 'Pengurus1Controller@pendataanJemput');
});

Route::group(['namespace' => 'Api', 'middleware' => ['jwt.verify', 'role:pengurus2']], function() {
    Route::post('pengurus2/penjualan', 'Pengurus2Controller@penjualan');
    Route::get('pengurus2/get_penjualan', 'Pengurus2Controller@getPenjualanPengepul');
    Route::get('pengurus2/get_gudang', 'Pengurus2Controller@getGudang');
    
    // Route::
    // Route::
});

Route::group(['namespace' => 'Api', 'middleware' => ['jwt.verify', 'role:costumer_service']], function() {
    Route::get('cs/kontak/add', 'MessageController@addindexCs');
});
