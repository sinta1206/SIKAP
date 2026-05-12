<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\KlasifikasiController;
use Illuminate\Support\Facades\Route;

// Halaman login (GET)
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

// Proses login (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// Proses logout (POST)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route setelah login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- FITUR KELOLA PENDUDUK ---
    // Menampilkan daftar penduduk
    Route::get('/penduduk', [PendudukController::class, 'index'])->name('penduduk.index');

    // Simpan data manual
    Route::post('/penduduk/store', [PendudukController::class, 'store'])->name('penduduk.store');

    // Import file Excel/CSV
    Route::post('/penduduk/import', [PendudukController::class, 'import'])->name('penduduk.import');

    // Hapus data
    Route::delete('/penduduk/{id}', [PendudukController::class, 'destroy'])->name('penduduk.destroy');
    // -----------------------------

    // --- FITUR KLASIFIKASI PEMILU ---
    // Halaman utama klasifikasi (menampilkan kriteria & ringkasan)
    Route::get('/klasifikasi', [KlasifikasiController::class, 'index'])->name('klasifikasi.index');

    // Proses menjalankan mesin klasifikasi (POST karena mengubah data di DB)
    Route::post('/klasifikasi/jalankan', [KlasifikasiController::class, 'jalankan'])->name('klasifikasi.run');

    // Route Profile (Jika nanti diaktifkan kembali)
    // Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    // Route::put('/profile', [ProfileController::class, 'updatePassword'])->name('profile.update');
});
