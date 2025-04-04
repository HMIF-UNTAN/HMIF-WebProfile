<?php

use App\Http\Controllers\ArtikelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DapurController;
use App\Http\Controllers\Auth\LoginController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

Route::middleware(['auth', 'role:admin'])->prefix('dapur')->group(function () {
    Route::get('/', [DapurController::class, 'index'])->name('viewdapur');

    Route::get('/artikel', [ArtikelController::class, 'indexDapur'])->name('dapurartikel');
    Route::get('/tentang-kami', [TentangKamiController::class, 'index'])->name('tentang.index');
    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
    Route::get('/kepengurusan', [KepengurusanController::class, 'index'])->name('kepengurusan.index');
});

Route::controller(ArtikelController::class)->group(Function(){
    Route::get('/artikel/tambah', 'tambahArtikel')->prefix('dapur')->name('tambahArtikel');
    Route::post('/artikel', 'store')->prefix('dapur')->name('artikel.store'); 
    Route::get('/artikel/{slug}/edit', 'edit')->prefix('dapur')->name('artikel.edit');
    Route::put('/artikel/{slug}', 'update')->prefix('dapur')->name('artikel.update');
    Route::delete('/artikel/{slug}', 'destroy')->prefix('dapur')->name('artikel.destroy');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');