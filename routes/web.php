<?php

use App\Models\Dosen;
use App\Models\contact;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\AkreditasiController;
use App\Http\Controllers\Frontend\homeController;
use App\Http\Controllers\Frontend\DosenController;
use App\Http\Controllers\Frontend\BeritaController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\SejarahController;
use App\Http\Controllers\Backend\dashboardController;
use App\Http\Controllers\Frontend\AkademikController;
use App\Http\Controllers\Frontend\PrestasiController;
use App\Http\Controllers\Frontend\StrukturController;
use App\Http\Controllers\Frontend\visiMisiController;
use App\Http\Controllers\Frontend\PenelitianController;
use App\Http\Controllers\Frontend\GaleriController;

Route::get('/', [homeController::class, 'index'])->name('frontend.home');
Route::prefix('profil')->group(function () {
    Route::resource('visi-misi', visiMisiController::class)->names('frontend.visi-misi');
    Route::resource('sejarah', SejarahController::class)->names('frontend.sejarah');
    Route::resource('struktur', StrukturController::class)->names('frontend.struktur');
    Route::resource('akreditasi', AkreditasiController::class)->names('frontend.akreditasi');
});
Route::resource('dosen', DosenController::class)->names('frontend.dosen');
Route::resource('akademik', AkademikController::class)->names('frontend.akademik');
Route::resource('contact', ContactController::class)->names('frontend.contact');
Route::resource('penelitian', PenelitianController::class)->names('frontend.penelitian');
Route::resource('prestasi', PrestasiController::class)->names('frontend.prestasi');
Route::resource('berita', BeritaController::class)->names('frontend.berita');
Route::resource('galery', GaleriController::class)->names('frontend.galery');


Route::resource('dashboard', dashboardController::class)->names('backend.dashboard');





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
