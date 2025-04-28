<?php

use App\Http\Controllers\AdminManagementController;
use App\Http\Controllers\ArtikelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DapurController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KepengurusanController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\TentangKamiController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->group(function () {
    Route::get('/', [AdminManagementController::class, 'index'])->name('dapurSuperadmin');
    Route::get('/edit/{id}',[AdminManagementController::class, 'edit'])->name('editAdmin');
    Route::put('/edit/{id}', [AdminManagementController::class, 'update'])->name('updateAdmin');
    Route::delete('/hapus/{user}', [AdminManagementController::class, 'destroy'])->name('hapusAdmin');
});

Route::prefix('dapur')->middleware(['auth', 'role:admin|superadmin'])->group(function () {
    Route::get('/', [DapurController::class, 'index'])->name('viewdapur');
    Route::get('/artikel', [ArtikelController::class, 'indexDapur'])->name('dapurartikel');
    Route::get('/tentang-kami', [TentangKamiController::class, 'indexDapur'])->name('dapurtentangkami');
    Route::get('/galeri', [GaleriController::class, 'indexDapur'])->name('dapurgaleri');
    Route::get('/kepengurusan', [KepengurusanController::class, 'indexDapur'])->name('dapurpengurus');
    Route::get('/kontak', [KontakController::class, 'indexDapur'])->name('dapurkontak');
});

Route::controller(ArtikelController::class)->prefix('dapur')->middleware(['auth', 'role:admin|superadmin'])->group(Function(){
    Route::get('/artikel/tambah', 'tambahArtikel')->name('tambahArtikel');
    Route::post('/artikel', 'store')->name('artikel.store'); 
    Route::get('/artikel/{slug}/edit', 'edit')->name('artikel.edit');
    Route::put('/artikel/{slug}', 'update')->name('artikel.update');
    Route::delete('/artikel/{slug}', 'destroy')->name('artikel.destroy');
});

Route::controller(TentangKamiController::class)->prefix('dapur/tentang-kami')->middleware(['auth', 'role:admin|superadmin'])->group(function () {
    Route::get('/tambah', 'tambahtentangkami')->name('tambahtentangkami');
    Route::post('/tambah', 'store')->name('tentangkami.store'); 
    Route::get('/edit/{id}', 'edit')->name('tentangkami.edit');
    Route::put('/update/{id}', 'update')->name('tentangkami.update');
    Route::delete('/{id}', 'destroy')->name('tentangkami.destroy');
});

Route::controller(GaleriController::class)->prefix('dapur/galeri')->middleware(['auth', 'role:admin|superadmin'])->group(function () {
    Route::get('/tambah', 'tambahalbum')->name('tambahalbum');
    Route::post('/tambah', 'store')->name('galeri.store'); 
    Route::get('/edit/{id}', 'edit')->name('galeri.edit');
    Route::post('/edit/{id}', 'uploadFoto')->name('galeri.upload');
    Route::delete('/edit/{id}/foto/{fileId}', 'hapusFoto')->name('galeri.hapus');
    Route::put('/update/{id}', 'update')->name('tentangkami.update');
    Route::delete('/{id}', 'destroy')->name('galeri.destroy');
    Route::get('/galeri/download-seeder', 'downloadSeederFromDrive')->name('galeri.downloadSeeder');
});

Route::controller(KepengurusanController::class)->prefix('dapur/pengurus')->middleware(['auth', 'role:admin|superadmin'])->group(function () {
    Route::get('/tambah', 'tambahpengurus')->name('tambahpengurus');
    Route::post('/tambah', 'store')->name('pengurus.store');
    Route::get('/edit/{id}', 'edit')->name('pengurus.edit');
    Route::put('/{id}', 'update')->name('pengurus.update');
    Route::delete('/{id}', 'destroy')->name('pengurus.destroy');
});

Route::controller(KontakController::class)->prefix('dapur/kontak')->middleware(['auth', 'role:admin|superadmin'])->group(function () {
    Route::put('/{id}', 'update')->name('kontak.update');
});

Route::get('/oauth/google', function () {
    return Socialite::driver('google')->scopes([
        'https://www.googleapis.com/auth/drive',
        'https://www.googleapis.com/auth/drive.file',
    ])->redirect();
})->name('google.login');

Route::get('/oauth/google/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();

    // Simpan token ke session untuk sementara (atau database nanti)
    Session::put('google_token', $googleUser->token);
    Session::put('google_refresh_token', $googleUser->refreshToken);

    return Redirect::to('/dapur/galeri'); // atau ke halaman lain
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/temp-thumb/{filename}', function ($filename) {
    $path = storage_path('framework/cache/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
});