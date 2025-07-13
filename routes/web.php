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

Route::middleware(['auth', 'verified', 'role:siswa,guru'])->group(function () {
    Route::resource('siswa', SiswaController::class);
});

// ===================================================
//  Guru Area
// ===================================================

Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/dashboard', [GuruController::class, 'index'])->name('guru.dashboard');
    Route::get('/guru/add-siswa', [SiswaController::class, 'create'])->name('siswa.addSiswa');

    Route::resource('/nilai', NilaiController::class);
});

// ===================================================
// Admin Area
// ===================================================

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard & Manajemen Role
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/edit-role', [AdminController::class, 'editRole'])->name('admin.edit-role');
    Route::resource('subjects', SubjectController::class);

    // Manajemen Siswa oleh Admin
    Route::get('/admin/add-siswa', [SiswaController::class, 'create'])->name('siswa.addSiswa');
    Route::post('/admin/siswa', [SiswaController::class, 'store'])->name('siswa.store');

    // Manajemen Guru

    Route::post('/admin/guru', [GuruController::class, 'store'])->name('guru.store');
    Route::resource('guru', GuruController::class);
});

// ===================================================
// Super Admin Area
// ===================================================

Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.index');
});