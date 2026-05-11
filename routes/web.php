<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\ProfileController;


// Halaman login (GET)
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

// Proses login (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// Proses logout (POST)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route setelah login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/hasil', function () {
        return view('hasil.index');
    })->name('hasil.index');

    // halaman klasifikasi
    Route::get('/klasifikasi', function () {
        return view('klasifikasi.index');
    })->name('klasifikasi.index');

    // // Route Profile
    // Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    // Route::put('/profile', [ProfileController::class, 'updatePassword'])->name('profile.update');
});
