<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\AnggotaLivewire;
use App\Http\Livewire\PeminjamanLivewire;
use App\Http\Livewire\PengembalianLivewire;
use App\Http\Livewire\BukuLivewire;
use App\Http\Livewire\PetugasLivewire;
use App\Http\Livewire\RakLivewire;
use App\Http\Controllers\AnimeController;

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
    return view('auth\login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => ['auth:sanctum','verified']], function(){
    Route::get('/dashboard', function(){
        return view('dashboard');
    })->name('dashboard');

    Route::get('/analytic', function(){
        return view('analytic');
    })->name('analytic');

    
    Route::get('anime', 'App\Http\Controllers\AnimeController@index')->name('anime');
    Route::get('createanime', 'App\Http\Controllers\AnimeController@create')->name('createanime');
    Route::post('getanime/{id_genre}', 'App\Http\Controllers\AnimeController@store')->name('getanime');
    Route::get('genre', 'App\Http\Controllers\GenreController@index')->name('genre');
    Route::post('getgenre', 'App\Http\Controllers\GenreController@store')->name('getgenre');

    Route::get('anggota', AnggotaLivewire::class)->name('anggota');
    Route::get('peminjaman', PeminjamanLivewire::class)->name('peminjaman');
    Route::get('pengembalian', PengembalianLivewire::class)->name('pengembalian');
    Route::get('buku', BukuLivewire::class)->name('buku');
    Route::get('petugas', PetugasLivewire::class)->name('petugas');
    Route::get('rak', RakLivewire::class)->name('rak');
});
