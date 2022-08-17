<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::prefix('backend')->group(function () {
    Route::get('/home', 'backend\HomeController@index')->name('home');
    Route::get('/edit-profile', 'backend\HomeController@editprofile')->name('editprofile');
    Route::post('/edit-profile/{id}', 'backend\HomeController@aksieditprofile');

    Route::resource('/roles','backend\rolesController');
    Route::get('/data-roles','backend\rolesController@listdata');
    
    Route::get('/data-admin','backend\AdminController@listdata');
    Route::resource('/admin','backend\AdminController');
    Route::get('/web-setting', 'backend\HomeController@websetting');
    Route::post('/web-setting', 'backend\HomeController@updatewebsetting');

    // Kasir Salon
    Route::resource('/toko', 'backend\TokoController');
    Route::get('/cari_toko', 'backend\TokoController@cari_toko');
    Route::get('/cari_toko_hasil/{id}', 'backend\TokoController@cari_toko_hasil');

    Route::resource('/customer', 'backend\CustomerController');
    Route::get('/cari_customer', 'backend\CustomerController@cari_customer');
    Route::get('/cari_customer_hasil/{id}', 'backend\CustomerController@cari_customer_hasil');

    Route::resource('/produk', 'backend\ProdukController');
    Route::get('/cari_produk', 'backend\ProdukController@cari_produk');
    Route::get('/cari_produk_hasil/{id}', 'backend\ProdukController@cari_produk_hasil');

    Route::resource('/pegawai', 'backend\PegawaiController');
    Route::get('/cari_pegawai', 'backend\PegawaiController@cari_pegawai');
    Route::get('/cari_pegawai_hasil/{id}', 'backend\PegawaiController@cari_pegawai_hasil');
    
    Route::resource('/paket_salon', 'backend\PaketsalonController');
    Route::get('/cari_paket_salon', 'backend\PaketsalonController@cari_paket_salon');
    Route::get('/cari_paket_salon_hasil/{id}', 'backend\PaketsalonController@cari_paket_salon_hasil');

    Route::resource('/transaksi', 'backend\TransaksiController');
    Route::post('/pembayaran/insert', 'backend\TransaksiController@insert_transaksi')->name('transaksi.transaksi.insert');
    Route::post('/list-pesanan/insert', 'backend\TransaksiController@insert_list_pesanan')->name('transaksi.list_pesanan.insert');
    Route::post('/list-pesanan/update', 'backend\TransaksiController@update_list_pesanan')->name('transaksi.list_pesanan.update');
    Route::get('/list_pesanan/delete/{id}','backend\TransaksiController@destroy')->name('transaksi.list_pesanan.delete');

    Route::resource('/history-transaksi', 'backend\HistorytransaksiController');

    Route::resource('/laporan', 'backend\LaporanController');

    Route::get('/cetaknota/{id}', 'backend\TransaksiController@cetaknota');

    Route::resource('/diskon', 'backend\DiskonController');
    
});
