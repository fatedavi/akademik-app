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

// Aktifkan route bawaan Laravel termasuk email verification
Auth::routes(['verify' => true]);

// Landing Page
Route::get('/', [LandingController::class, 'index'])->name('landing');


// Resource siswa
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('siswa', SiswaController::class);
});



// Custom Register (jika override)
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Dashboard setelah login + email terverifikasi
Route::get('/home', [HomeController::class, 'index'])
    ->middleware(['auth'])
    ->name('home');

// Email Verification Routes (gunakan hanya versi ini)
Route::get('/email/verify', [VerificationController::class, 'show'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::middleware(['auth'])->group(function () {
    Route::resource('/nilai', NilaiController::class);
});
Route::middleware(['auth', RoleMiddleware::class . ':guru'])->group(function () {
    Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
    Route::get('/guru/add', [GuruController::class, 'create'])->name('guru.add');
});

Route::middleware(['auth', RoleMiddleware::class . ':guru'])->group(function () {
    Route::get('/guru/add-siswa', [GuruController::class, 'create'])->name('guru.addSiswa');
});