<?php

use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Beranda;
use App\Livewire\User;
use App\Livewire\laporan;
use App\Livewire\Transaksi;
use App\Livewire\Produk;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => true]);

Route::get('/home', Beranda::class)->middleware(['auth'])->name('home');
Route::get('/user', User::class)->middleware(['auth'])->name('user');
Route::get('/laporan', Laporan::class)->middleware(['auth'])->name('laporan');
Route::get('/produk', Produk::class)->middleware(['auth'])->name('produk');
Route::get('/transaksi', Transaksi::class)->middleware(['auth'])->name('transaksi');
Route::get('/transaksi/{id}/struk', [TransaksiController::class, 'cetakStruk'])->name('transaksi.struk');
Route::get('/cetak', ['App\Http\Controllers\HomeController', 'cetak']);
