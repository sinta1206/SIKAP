<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\HasilController;
use Illuminate\Support\Facades\Route;

// Login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Middleware Auth untuk semua route setelah login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- FITUR KELOLA PENDUDUK ---
    // Menampilkan daftar penduduk
    Route::get('/penduduk', [PendudukController::class, 'index'])->name('penduduk.index');
    // tambah data manual
    Route::get('/penduduk/create', [PendudukController::class, 'create'])->name('penduduk.create');
    // Simpan data manual
    Route::post('/penduduk/store', [PendudukController::class, 'store'])->name('penduduk.store');
    // Import file Excel/CSV
    Route::post('/penduduk/import', [PendudukController::class, 'import'])->name('penduduk.import');
    // Halaman Form Edit Data Penduduk
    Route::get('/penduduk/{id}/edit', [PendudukController::class, 'edit'])->name('penduduk.edit');
    // Proses Update Data Penduduk
    Route::put('/penduduk/{id}', [PendudukController::class, 'update'])->name('penduduk.update');
    // Reset Data Penduduk
    Route::delete('/penduduk/reset', [PendudukController::class, 'resetData'])
    ->name('penduduk.reset');
    // Hapus data penduduk
    Route::delete('/penduduk/{id}', [PendudukController::class, 'destroy'])->name('penduduk.destroy');
    // -----------------------------

    // --- FITUR KLASIFIKASI PEMILU ---
    // Halaman utama klasifikasi (menampilkan kriteria & ringkasan)
    Route::get('/klasifikasi', [KlasifikasiController::class, 'index'])->name('klasifikasi.index');
    // Proses menjalankan mesin klasifikasi (POST karena mengubah data di DB)
    Route::post('/klasifikasi/jalankan', [KlasifikasiController::class, 'jalankan'])->name('klasifikasi.run');

    // --- FITUR HASIL KLASIFIKASI ---
    // 1. Halaman Utama Hasil Klasifikasi (Menampilkan Empty State / Tabel Hasil sesuai Role)
    Route::get('/hasil', [HasilController::class, 'index'])->name('hasil.index');
    // 2. Fungsi Unduh Hasil Format CSV (Bisa diakses Pegawai & Panitia)
    Route::get('/hasil/export', [HasilController::class, 'export'])->name('hasil.export');
    // 3. Halaman Form Tambah Data Manual di Halaman Hasil (Hanya Pegawai Desa)
    Route::get('/hasil/create', [HasilController::class, 'create'])->name('hasil.create');
    // 4. Proses Simpan Data Baru dari Form Tambah ke Database
    Route::post('/hasil', [HasilController::class, 'store'])->name('hasil.store');
    // 5. Halaman Form Edit Status & Keterangan Hak Pilih Manual (Hanya Pegawai Desa)
    Route::get('/hasil/{id}/edit', [HasilController::class, 'edit'])->name('hasil.edit');
    // 6. Proses Update / Memperbarui Data dari Form Edit ke Database
    Route::put('/hasil/{id}', [HasilController::class, 'update'])->name('hasil.update');

    // --- FITUR PROFILE ---
    // Route untuk update Username
    Route::post('/profil/update-username', [ProfilController::class, 'updateUsername'])->name('profil.username.update');
    // Route untuk update Password
    Route::post('/profil/update-password', [ProfilController::class, 'updatePassword'])->name('profil.password.update');

});
