<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data (berlaku untuk Pegawai & Panitia)
        $search = $request->input('search');
        $query = Penduduk::query();

        if ($search) {
            $query->where('nama', 'LIKE', "%{$search}%")
                  ->orWhere('nik', 'LIKE', "%{$search}%");
        }

        $data = $query->get();
        $totalData = $data->count();

        // 2. Cek Role User yang sedang login
        $userRole = Auth::user()->role;

        // 3. Arahkan ke view yang sesuai berdasarkan role
        if ($userRole == 'pegawai') {
            return view('pegawai.penduduk', compact('data', 'totalData'));
        } else {
            // Tampilan simpel sesuai gambar yang kamu kirim terakhir
            return view('panitia.penduduk', compact('data', 'totalData'));
        }
    }

    // Method di bawah ini otomatis hanya bisa dijalankan Pegawai
    // karena kita akan proteksi di Route atau Middleware

    public function store(Request $request) { /* simpan data */ }

    public function import(Request $request) { /* import data */ }

    public function destroy($id) { /* hapus data */ }
}
