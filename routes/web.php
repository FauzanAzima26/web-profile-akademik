<?php

use App\Models\Dosen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\homeController;
use App\Http\Controllers\Frontend\DosenController;
use App\Http\Controllers\Frontend\SejarahController;
use App\Http\Controllers\Backend\dashboardController;
use App\Http\Controllers\Frontend\AkademikController;
use App\Http\Controllers\Frontend\StrukturController;
use App\Http\Controllers\Frontend\visiMisiController;
use App\Http\Controllers\Frontend\AkreditasiController;

Route::get('/', [homeController::class, 'index'])->name('frontend.home');
Route::prefix('profil')->group(function () {
    Route::resource('visi-misi', visiMisiController::class)->names('frontend.visi-misi');
    Route::resource('sejarah', SejarahController::class)->names('frontend.sejarah');
    Route::resource('struktur', StrukturController::class)->names('frontend.struktur');
    Route::resource('akreditasi', AkreditasiController::class)->names('frontend.akreditasi');
});
Route::resource('dosen', DosenController::class)->names('frontend.dosen');
Route::resource('akademik', AkademikController::class)->names('frontend.akademik');

Route::resource('dashboard', dashboardController::class)->names('backend.dashboard');



Route::get('/berita', fn() => view('frontend.berita.index'));
Route::get('/galeri', fn() => view('frontend.galeri.index'));
Route::get('/kontak', fn() => view('frontend.kontak.index'));
use App\Http\Controllers\Backend\PengaturanController;


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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
