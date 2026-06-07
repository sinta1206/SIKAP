<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        //Ambil data user yang sedang login
        $user = Auth::user();

        //Tentukan sebutan/panggilan dinamis berdasarkan role akun
        if ($user->role == 'pegawai_desa') {
            $panggilan = 'Pegawai Desa';
        } elseif ($user->role == 'panitia_pemilu') {
            $panggilan = 'Panitia Pemilu';
        } else {
            $panggilan = $user->username; // Fallback jika ada role lain
        }

        //Mengambil hitungan data penduduk untuk komponen Card
        $totalData = Penduduk::count();
        $layak = Penduduk::where('status', 'Layak')->count();
        $tidakLayak = Penduduk::where('status', 'Tidak Layak')->count();

        // Menghitung persentase kelayakan tingkat partisipasi
        $persentaseLayak = $totalData > 0 ? round(($layak / $totalData) * 100) : 0;

        //Kirim variabel panggilan ke halaman view dashboard
        return view('dashboard', compact('totalData', 'layak', 'tidakLayak', 'persentaseLayak', 'panggilan'));
    }
}
