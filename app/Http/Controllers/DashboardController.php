<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Kirim data ke view sesuai variabel yang dibutuhkan di Blade Anda
        return view('dashboard', [
            'name' => $user->username, // Menggunakan username sebagai nama
            'role' => $user->role      // 'pegawai_desa' atau 'panitia_pemilu'
        ]);
    }
}
