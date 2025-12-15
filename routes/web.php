<?php

use App\Models\Dosen;
use App\Models\contact;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\homeController;
use App\Http\Controllers\Frontend\DosenController;
use App\Http\Controllers\Frontend\BeritaController;
use App\Http\Controllers\Backend\BeritaController as backendBerita;
use App\Http\Controllers\Backend\AgendaController as backendAgenda;
use App\Http\Controllers\Frontend\GaleriController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\SejarahController;
use App\Http\Controllers\Backend\dashboardController;
use App\Http\Controllers\Backend\KategoriBeritaController;
use App\Http\Controllers\Frontend\AkademikController;
use App\Http\Controllers\Frontend\PrestasiController;
use App\Http\Controllers\Frontend\StrukturController;
use App\Http\Controllers\Frontend\visiMisiController;
use App\Http\Controllers\Frontend\AkreditasiController;
use App\Http\Controllers\Frontend\PenelitianController;

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
Route::prefix('management-konten')->group(function () {
    Route::resource('berita', backendBerita::class)->names('backend.berita');
    Route::get('data/berita', [backendBerita::class, 'getData'])->name('backend.berita.data');

    Route::get('data/agenda', [backendAgenda::class, 'getData'])->name('backend.agenda.data');
    Route::get('agenda/sampah', [backendAgenda::class, 'sampah'])->name('agenda.sampah');
    Route::post('agenda/{id}/restore', [backendAgenda::class, 'restore'])->name('agenda.restore');
    Route::delete('agenda/{id}/force-delete', [backendAgenda::class, 'forceDelete'])->name('agenda.forceDelete');
    Route::resource('agenda', backendAgenda::class)->names('backend.agenda');

    Route::resource('kategori-berita', KategoriBeritaController::class)->names('backend.kategori-berita');
    Route::get('data/kategori-berita', [KategoriBeritaController::class, 'data'])->name('backend.kategori-berita.data');

    Route::resource('sejarah', SejarahController::class)->names('frontend.sejarah');
    Route::resource('struktur', StrukturController::class)->names('frontend.struktur');
    Route::resource('akreditasi', AkreditasiController::class)->names('frontend.akreditasi');
});

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
