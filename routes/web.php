<?php

use App\Http\Controllers\ArtikelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DapurController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TentangKamiController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

Route::middleware(['auth', 'role:admin'])->prefix('dapur')->group(function () {
    Route::get('/', [DapurController::class, 'index'])->name('viewdapur');

    Route::get('/artikel', [ArtikelController::class, 'indexDapur'])->name('dapurartikel');
    Route::get('/tentang-kami', [TentangKamiController::class, 'indexDapur'])->name('dapurtentangkami');
    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
    Route::get('/kepengurusan', [KepengurusanController::class, 'index'])->name('kepengurusan.index');
});

Route::controller(ArtikelController::class)->prefix('dapur')->group(Function(){
    Route::get('/artikel/tambah', 'tambahArtikel')->name('tambahArtikel');
    Route::post('/artikel', 'store')->name('artikel.store'); 
    Route::get('/artikel/{slug}/edit', 'edit')->name('artikel.edit');
    Route::put('/artikel/{slug}', 'update')->name('artikel.update');
    Route::delete('/artikel/{slug}', 'destroy')->name('artikel.destroy');
});

Route::controller(TentangKamiController::class)->prefix('dapur/tentang-kami')->group(function () {
    Route::get('/tambah', 'tambahtentangkami')->name('tambahtentangkami');
    Route::post('/', 'store')->name('tentangkami.store'); 
    Route::get('/edit/{id}/edit', 'edit')->name('tentangkami.edit');
    Route::put('/update/{id}', 'update')->name('tentangkami.update');
    Route::delete('/{id}', 'destroy')->name('tentangkami.destroy');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');