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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin-page', function() {
    return 'Halaman untuk Admin';
})->middleware('role:admin')->name('admin.page');

Route::get('user-page', function() {
    return 'Halaman untuk User';
})->middleware('role:user')->name('user.page');
// Route::group(['namesace' => 'Web', 'middleware' => 'role:admin'], function() {

    //Pengurus
    Route::get('admin/pengurus', 'Web\PengurusController@index');

    //Nasabah
    Route::get('admin/nasabah', 'Web\UserController@index');

    Route::get('admin/tabungan/nasabah/{id}', 'Web\TabunganController@index');

    //Penyetoran OR Pendataan
    Route::get('admin/penyetoran', 'Web\PenyetoranController@index');

    //Sampah
    Route::get('admin', 'Web\AdminController@index');
    Route::get('admin/sampah', 'Web\AdminController@sampah');
    Route::post('admin/sampah/tambah', 'Web\AdminController@addSampah');
    Route::patch('admin/sampah/update/{id}', 'Web\AdminController@ubahSampah');
    Route::delete('admin/sampah/delete/{id}', 'Web\AdminController@hapusSampah');
    Route::get('admin/sampah/cari', 'Web\AdminController@cari');
// });

Route::get('/ajax', function () {
    return view('admin/layouts/ajax');
});
Route::post('/kirimpesan', function () {
    return view('admin/layouts/kirimpesan');
});