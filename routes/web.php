<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JamController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProgramPaketController;
use App\Http\Controllers\ProgramPilihanController;
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
Route::get('/',[LoginController::class, 'index']); 

// HALAMAN LOGIN
Route::resource('login', LoginController::class);
// Route::get('/Login/',[LoginController::class, 'index'])->name('login')->middleware('guest'); 
// Route::post('/Login/',[LoginController::class, 'authenticate']); 

// HALAMAN DASHBOARD
// Route::middleware(['auth', 'check.surat'])->resource('/dashboard', DashboardController::class);
Route::resource('dashboard', DashboardController::class);

// HALAMAN JAM
// Route::resource('/data-master/kode-surat', KodeSuratController::class)->middleware('auth');
Route::resource('jam', JamController::class);

// HALAMAN PROGRAM-PILIHAN
// Route::resource('/data-master/kode-surat', KodeSuratController::class)->middleware('auth');
Route::resource('program-pilihan', ProgramPilihanController::class);

// HALAMAN PROGRAM-PAKET
// Route::resource('/data-master/kode-surat', KodeSuratController::class)->middleware('auth');
Route::resource('program-paket', ProgramPaketController::class);