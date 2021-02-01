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
Route::group(['middleware' => 'role:admin'], function() {
    //Dashboard
    Route::get('admin', 'Web\AdminController@index')->name('dashboard');

    //Pengurus
    Route::get('admin/pengurus', 'Web\PengurusController@index')->name('pengurus');
    Route::post('admin/pengurus/tambah', 'Web\PengurusController@store');
    Route::patch('admin/pengurus/update/{id}', 'Web\PengurusController@update');
    
    //Nasabah
    Route::get('admin/nasabah', 'Web\UserController@index')->name('nasabah');    
    Route::post('admin/nasabah/tambah', 'Web\PengurusController@store');
    Route::delete('admin/nasabah/delete/{id}', 'Web\PengurusController@destroy');
    Route::patch('admin/nasabah/update/{id}', 'Web\PengurusController@update');
    //Tabungan
    Route::get('admin/tabungan/nasabah/{id}', 'Web\TabunganController@index')->name('tabungan');
    Route::post('admin/tabungan/nasabah/tambah', 'Web\TabunganController@store')->name('tambah_tabungan');
    Route::patch('admin/tabungan/nasabah/update/{id}', 'Web\TabunganController@update')->name('ubah_tabungan');
    Route::delete('admin/tabungan/nasabah/delete/{id}', 'Web\TabunganController@destroy')->name('delete_tabungan');
    
    //Penyetoran OR Pendataan
    Route::get('admin/penyetoran', 'Web\PenyetoranController@index')->name('penyetoran');
    Route::get('admin/gudang', 'Web\GudangController@index')->name('gudang');               //Gudang
    Route::get('admin/penjualan', 'Web\PenjualanController@index')->name('penjualan');      //Penjualan
    
    
    //Sampah
    Route::get('admin/sampah', 'Web\SampahController@index')->name('sampah');
    Route::post('admin/sampah/tambah', 'Web\SampahController@store');
    Route::patch('admin/sampah/update/{id}', 'Web\SampahController@update');
    Route::delete('admin/sampah/delete/{id}', 'Web\SampahController@destroy');
    Route::get('admin/sampah/cari', 'Web\SampahController@cari');
    Route::get('cs/chat', function() {
        return view('cs/chat/index');
    });
});

// Route::group(['namespace' => 'Web', 'middleware' => 'role:bendahara'], function() {
    Route::get('bendahara', 'Web\BendaharaController@index')->name('b_dashboard');
    Route::get('bendahara/nasabah', 'Web\UserController@index2')->name('b_nasabah');    
    Route::get('bendahara/penyetoran', 'Web\PenyetoranController@index2')->name('b_penyetoran');
    Route::get('bendahara/penjualan', 'Web\PenjualanController@index2')->name('b_penjualan');    //Penjualan
    Route::get('bendahara/gudang', 'Web\GudangController@index2')->name('b_gudang');
    Route::get('bendahara/tabungan/nasabah/{id}', 'Web\TabunganController@index2')->name('b_tabungan');
    Route::post('bendahara/tabungan/nasabah/tambah', 'Web\TabunganController@store2')->name('tambah_tabungan');

// });

Route::get('/ajax', function () {
    return view('admin/layouts/ajax');
});
Route::post('/kirimpesan', function () {
    return view('admin/layouts/kirimpesan');
});