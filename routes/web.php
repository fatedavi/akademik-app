<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\HomeController; // <- ini perlu
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\GuruController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\KelasController;

// Aktifkan route bawaan Laravel termasuk email verification

// ===================================================
//  Auth & Verification
// ===================================================

// Aktifkan fitur login, register, reset password, verifikasi email
Auth::routes(['verify' => true]);

// Halaman verifikasi email
Route::get('/email/verify', [VerificationController::class, 'show'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

// Override halaman register default (jika diperlukan)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// ===================================================
// Umum / Landing / Dashboard
// ===================================================

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/home', [HomeController::class, 'index'])
    ->middleware('auth')
    ->name('home');

// ===================================================
//  Siswa & Guru Akses Bersama
// ===================================================
Route::middleware(['auth', 'role:admin,guru'])->group(function () {
    Route::resource('nilai', NilaiController::class);
    Route::get('/nilai/siswa/{id}', [NilaiController::class, 'nilaiBySiswa']);

});


Route::middleware(['auth', 'verified', 'role:siswa,guru,admin'])->group(function () {
    Route::resource('siswa', SiswaController::class);
        Route::post('/admin/siswa', [SiswaController::class, 'store'])->name('siswa.store');
    
});

// ===================================================
//  Guru Area
// ===================================================

Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/dashboard', [GuruController::class, 'index'])->name('guru.dashboard');
    Route::get('/guru/list-siswa', [GuruController::class, 'listSiswa'])->name('guru.list-siswa');

});

// ===================================================
// Admin Area
// ===================================================

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard & Manajemen Role
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/edit-role', [AdminController::class, 'editRole'])->name('admin.edit-role');
    Route::resource('subjects', SubjectController::class);

    //Kelas

    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
    Route::post('/kelas', [KelasController::class, 'store'])->name('kelas.store');

    Route::get('/kelas/{id}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
    Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');
    // Manajemen Siswa oleh Admin
    Route::get('/admin/add-siswa', [SiswaController::class, 'create'])->name('siswa.addSiswa');

    // Manajemen Guru

    Route::post('/admin/guru', [GuruController::class, 'store'])->name('guru.store');
    Route::resource('guru', GuruController::class);
});

// ===================================================
// Super Admin Area
// ===================================================

Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.index');
    Route::get('/superadmin/management', [SuperAdminController::class, 'management'])->name('superadmin.management');
});