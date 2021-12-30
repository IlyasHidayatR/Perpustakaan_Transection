<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\AnggotaLivewire;
use App\Http\Livewire\PeminjamanLivewire;
use App\Http\Livewire\PengembalianLivewire;
use App\Http\Livewire\BukuLivewire;
use App\Http\Livewire\PetugasLivewire;
use App\Http\Livewire\RakLivewire;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::group(['middleware'=>'auth:sanctum'], function() {

    //API Peminjaman
    Route::get('peminjamanApi', 'App\Http\Controllers\PeminjamanController@index')->name('peminjamanApi');
    Route::post('peminjamanApi','App\Http\Controllers\PeminjamanController@store')->name('peminjamanApi');
    Route::post('peminjamanApi/{id_peminjaman}','App\Http\Controllers\PeminjamanController@update');
    Route::delete('peminjamanApi/{id_peminjaman}','App\Http\Controllers\PeminjamanController@destroy');

    //API Penngembalian
    Route::get('pengembalianApi', 'App\Http\Controllers\PengembalianController@index')->name('pengembalianApi');
    Route::post('pengembalianApi','App\Http\Controllers\PengembalianController@store')->name('pengembalianApi');
    Route::post('pengembalianApi/{id_pengembalian}','App\Http\Controllers\PengembalianController@update');
    Route::delete('pengembalianApi/{id_pengembalian}','App\Http\Controllers\PeminjamanController@destroy');

    //API Buku
    Route::get('bukuApi', 'App\Http\Controllers\BukuController@index')->name('bukuApi');
    Route::post('bukuApi','App\Http\Controllers\BukuController@store')->name('bukuApi');
    Route::post('bukuApi/{id_buku}','App\Http\Controllers\BukuController@update');
    Route::delete('bukuApi/{id_buku}','App\Http\Controllers\BukuController@destroy');

    //API Rak
    Route::get('rakApi', 'App\Http\Controllers\RakController@index')->name('rakApi');
    Route::post('rakApi','App\Http\Controllers\RakController@store')->name('rakApi');
    Route::post('rakApi/{id_rak}','App\Http\Controllers\RakController@update');
    Route::delete('rakApi/{id_rak}','App\Http\Controllers\RakController@destroy');

    //API Anggota
    Route::get('anggotaApi', 'App\Http\Controllers\AnggotaController@index')->name('anggotaApi');
    Route::post('anggotaApi','App\Http\Controllers\AnggotaController@store')->name('anggotaApi');
    Route::post('anggotaApi/{id_anggota}','App\Http\Controllers\AnggotaController@update');
    Route::delete('anggotaApi/{id_anggota}','App\Http\Controllers\AnggotaController@destroy');

    //API Petugas
    Route::get('petugasApi', 'App\Http\Controllers\PetugasController@index')->name('petugasApi');
    Route::post('petugasApi','App\Http\Controllers\PetugasController@store')->name('petugasApi');
    Route::post('petugasApi/{id_petugas}','App\Http\Controllers\PetugasController@update');
    Route::delete('petugasApi/{id_petugas}','App\Http\Controllers\PetugasController@destroy');

    //livewire web
    Route::get('anggota', AnggotaLivewire::class)->name('anggota');
    Route::get('peminjaman', PeminjamanLivewire::class)->name('peminjaman');
    Route::get('pengembalian', PengembalianLivewire::class)->name('pengembalian');
    Route::get('buku', BukuLivewire::class)->name('buku');
    Route::get('petugas', PetugasLivewire::class)->name('petugas');
    Route::get('rak', RakLivewire::class)->name('rak');
});
