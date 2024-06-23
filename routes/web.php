<?php

use App\Http\Controllers\AngketPenilaianController;
use App\Http\Controllers\AngketPesertaDidikBaruController;
use App\Http\Controllers\BerkasAkreditasiController;
use App\Http\Controllers\BiayaDaftarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataRekeningController;
use App\Http\Controllers\HakAksesController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\JamController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\PendaftarOnlineController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PhotoStudentController;
use App\Http\Controllers\ProfilLembagaController;
use App\Http\Controllers\ProgramPaketController;
use App\Http\Controllers\ProgramPilihanController;
use App\Http\Controllers\SaranaPrasaranaController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// HALAMAN AWAL
// Route::get('/', function () {
//     return view('/Login');
// });
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');

// HALAMAN LOGIN
// Define login route
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    // HALAMAN DASHBOARD
    Route::resource('dashboard', DashboardController::class);
    // HALAMAN JAM
    Route::resource('jam', JamController::class);
    // HALAMAN BIAYA PENDAFTARAN
    Route::resource('biaya-pendaftaran', BiayaDaftarController::class);
    // HALAMAN DATA REKENING
    Route::resource('data-rekening', DataRekeningController::class);
    // HALAMAN PROGRAM PILIHAN
    Route::resource('program-pilihan', ProgramPilihanController::class);
    // HALAMAN PROGRAM PAKET
    Route::resource('program-paket', ProgramPaketController::class);
    // HALAMAN USER CATEGORY
    Route::resource('user-category', HakAksesController::class);
    // HALAMAN USER
    Route::resource('user', UserController::class);
    // HALAMAN GANTI PASSWORD
    Route::get('ganti-password', [UserController::class, 'gantipassword']);
    Route::put('/ganti-password/{id}', [UserController::class, 'updatepassword']);
    // HALAMAN SARPRAS
    Route::resource('sarana-prasarana', SaranaPrasaranaController::class);
    // HALAMAN PENGUMUMAN
    Route::resource('pengumuman', PengumumanController::class);
    // HALAMAN PROFIL LEMBAGA
    Route::resource('profil-lembaga', ProfilLembagaController::class);
    // HALAMAN BERKAS PENDUKUNG
    Route::resource('berkas-akreditasi', BerkasAkreditasiController::class);
    // HALAMAN DATA ANGKET PESERTA DIDIK BARU
    Route::resource('angket-peserta-didik-baru', AngketPesertaDidikBaruController::class);
    Route::get('/export-peserta-didik-baru/{type}', [AngketPesertaDidikBaruController::class, 'exportExcel'])->name('exportExcelPesertaDidikBaru');
    // HALAMAN DATA ANGKET PENILAIAN
    Route::resource('angket-penilaian', AngketPenilaianController::class);
    Route::get('/export-penilaian/excel/{type}', [AngketPenilaianController::class, 'exportExcel'])->name('exportExcelPenilaian');
    Route::get('/export-penilaian/peserta/{type}', [AngketPenilaianController::class, 'exportPeserta'])->name('exportExcelPeserta');
    // HALAMAN DATA PENDAFTAR ONLINE
    Route::resource('pendaftar-online', PendaftarOnlineController::class);
    Route::post('pendaftar-online/create/{id}', [PendaftarOnlineController::class, 'store'])->name('pendaftar-online.store');
    Route::get('pendaftar-online/create/{id}', [PendaftarOnlineController::class, 'create'])->name('pendaftar-online.create');
    Route::get('pendaftar-online/{pendaftarOnline}/generate-pdf', [PendaftarOnlineController::class, 'generatePDF'])->name('pendaftar-online.pdf');
    // HALAMAN INFORMATION
    Route::get('/information', [InformationController::class, 'index']);
    // HALAMAN PENDAFTARAN MAUPUN DATA PESERTA DIDIK
    Route::get('pendaftaran/export', [PendaftarController::class, 'export'])->name('pendaftaran.export');
    Route::resource('pendaftaran', PendaftarController::class);
    Route::get('pendaftaran/verifikasi/{no_induk}', [PendaftarController::class, 'verifikasi'])->name('pendaftaran.verifikasi');
    Route::get('pendaftaran/verifikasi/{no_induk}/edit', [PendaftarController::class, 'editVerifikasi'])->name('pendaftaran.editVerifikasi');
    Route::post('pendaftaran/verifikasi/{no_induk}/save', [PendaftarController::class, 'SaveVerifikasi'])->name('pendaftaran.SaveVerifikasi');
    Route::put('pendaftaran/verifikasi/{no_induk}/update', [PendaftarController::class, 'UpdateVerifikasi'])->name('pendaftaran.UpdateVerifikasi');
    // NILAI
    // Route::get('/nilai/{no_induk}', [KursusController::class, 'showForm'])->name('show-nilai-form');
    Route::post('/nilai/{no_induk}', [PendaftarController::class, 'saveNilai'])->name('save-nilai');
    Route::post('/nilai/updateAll', [PendaftarController::class, 'updateAllNilai'])->name('nilai.updateAll');
    // SERTIFIKAT
    Route::resource('sertifikat', SertifikatController::class);
    // HALAMAN PHOTO PESERTA DIDIK
    Route::resource('photostudent', PhotoStudentController::class);
    Route::put('/photostudent/update/{no_induk}', [PhotoStudentController::class, 'update'])->name('photostudent.update');

    // Route::get('/data-pendaftar', [PendaftarController::class, 'getDatas'])->name('datas'); // Route untuk mengambil data
});
