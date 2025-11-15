<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\homeController;

use App\Http\Controllers\Backend\AkademikController;
use App\Http\Controllers\Frontend\SejarahController;
use App\Http\Controllers\Frontend\visiMisiController;
use App\Http\Controllers\Frontend\StrukturController;
use App\Http\Controllers\Frontend\AkreditasiController;
use App\Http\Controllers\Backend\dashboardController;

Route::get('/', [homeController::class, 'index'])->name('frontend.home');

Route::prefix('profil')->group(function () {
    Route::resource('visi-misi', visiMisiController::class)->names('frontend.visi-misi');
    Route::resource('sejarah', SejarahController::class)->names('frontend.sejarah');
    Route::resource('struktur', StrukturController::class)->names('frontend.struktur');
    Route::resource('akreditasi', AkreditasiController::class)->names('frontend.akreditasi');
});

Route::get('/berita', fn() => view('frontend.berita.index'));
Route::get('/galeri', fn() => view('frontend.galeri.index'));
Route::get('/kontak', fn() => view('frontend.kontak.index'));
use App\Http\Controllers\Backend\PengaturanController;
use App\Http\Controllers\Frontend\DosenController as FrontendDosenController;
use App\Http\Controllers\Frontend\AkademikController as FrontendAkademikController;

Route::get('/akademik', [FrontendAkademikController::class, 'index']);
Route::get('/penelitian', fn() => view('frontend.penelitian.index'));
Route::get('/penelitian', fn() => view('frontend.penelitian.index'));
Route::get('/prestasi', fn() => view('frontend.prestasi.index'));

/*

|--------------------------------------------------------------------------
| BACKEND ROUTES (ADMIN PANEL)
|--------------------------------------------------------------------------
| Semua route backend disimpan di bawah prefix "backend"
| dan dilindungi dengan middleware 'auth'
Route::prefix('backend')->name('backend.')->middleware('auth')->group(function ()

*/

Route::prefix('backend')->name('backend.')->group(function (){

    // Pengaturan
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::put('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');

    // CRUD Akademik
    Route::resource('akademik',AkademikController::class);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
