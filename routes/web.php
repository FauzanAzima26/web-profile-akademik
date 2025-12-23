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
use App\Http\Controllers\Backend\ProfilProdiController as backendProfilProdi;
use App\Http\Controllers\Backend\StrukturOrganisasiController as backendStrukturOrganisasi;
use App\Http\Controllers\Backend\DosenController as backendDosen;
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

    Route::get('data/berita', [backendBerita::class, 'getData'])->name('backend.berita.data');
    Route::get('berita/sampah', [backendBerita::class, 'sampah'])->name('berita.sampah');
    Route::post('berita/{id}/restore', [backendBerita::class, 'restore'])->name('berita.restore');
    Route::delete('berita/{id}/force-delete', [backendBerita::class, 'forceDelete'])->name('berita.forceDelete');
    Route::get('/kategori-berita/list', [backendBerita::class, 'list']);
    Route::resource('berita', backendBerita::class)->names('backend.berita');

    Route::resource('kategori-berita', KategoriBeritaController::class)->names('backend.kategori-berita');
    Route::get('data/kategori-berita', [KategoriBeritaController::class, 'data'])->name('backend.kategori-berita.data');

    Route::get('data/agenda', [backendAgenda::class, 'getData'])->name('backend.agenda.data');
    Route::get('agenda/sampah', [backendAgenda::class, 'sampah'])->name('agenda.sampah');
    Route::post('agenda/{id}/restore', [backendAgenda::class, 'restore'])->name('agenda.restore');
    Route::delete('agenda/{id}/force-delete', [backendAgenda::class, 'forceDelete'])->name('agenda.forceDelete');
    Route::resource('agenda', backendAgenda::class)->names('backend.agenda');

    Route::get('data/profil/prodi', [backendProfilProdi::class, 'getData'])->name('backend.profil.prodi.data');
    Route::get('profil/prodi/sampah', [backendProfilProdi::class, 'sampah'])->name('backend.profil.prodi.sampah');
    Route::post('profil/prodi/{id}/restore', [backendProfilProdi::class, 'restore'])->name('backend.profil.prodi.restore');
    Route::delete('profil/prodi/{id}/force-delete', [backendProfilProdi::class, 'forceDelete'])->name('backend.profil.prodi.forceDelete');
    Route::resource('profil/prodi', backendProfilProdi::class)->names('backend.profil.prodi');

    Route::get('data/struktur/organisasi', [backendStrukturOrganisasi::class, 'getData'])->name('struktur.organisasi.data');
    Route::get('struktur/organisasi/sampah', [backendStrukturOrganisasi::class, 'sampah'])->name('struktur.organisasi.sampah');
    Route::post('struktur/organisasi/{id}/restore', [backendStrukturOrganisasi::class, 'restore'])->name('struktur.organisasi.restore');
    Route::delete('struktur/organisasi/{id}/force-delete', [backendStrukturOrganisasi::class, 'forceDelete'])->name('struktur.organisasi.forceDelete');
    Route::resource('struktur/organisasi', backendStrukturOrganisasi::class)->names('struktur.organisasi');


    Route::resource('sejarah', SejarahController::class)->names('frontend.sejarah');
    Route::resource('struktur', StrukturController::class)->names('frontend.struktur');
    Route::resource('akreditasi', AkreditasiController::class)->names('frontend.akreditasi');
});

Route::prefix('management-akademik')->group(function () {

    Route::get('data/dosen', [backendDosen::class, 'getData'])->name('dosen.data');
    Route::get('dosen/sampah', [backendDosen::class, 'sampah'])->name('dosen.sampah');
    Route::post('dosen/{id}/restore', [backendDosen::class, 'restore'])->name('dosen.restore');
    Route::delete('dosen/{id}/force-delete', [backendDosen::class, 'forceDelete'])->name('dosen.forceDelete');
    Route::resource('dosen', backendDosen::class)->names('dosen');
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
