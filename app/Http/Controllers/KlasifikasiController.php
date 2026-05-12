<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KlasifikasiController extends Controller
{
    public function index()
    {
        // 1. Ambil Ringkasan Data
        $totalData = Penduduk::count();
        $layak = Penduduk::where('hak_pilih', 'Layak')->count();
        $tidakLayak = Penduduk::where('hak_pilih', 'Tidak Layak')->count();

        return view('klasifikasi.index', compact('totalData', 'layak', 'tidakLayak'));
    }

    public function jalankan()
    {
        // 2. Keamanan: Hanya 'pegawai' yang bisa eksekusi
        if (Auth::user()->role !== 'pegawai_desa') {
            return redirect()->back()->with('error', 'Hanya Pegawai Desa yang dapat menjalankan proses ini.');
        }

        // 3. Ambil semua data penduduk
        $penduduks = Penduduk::all();

        foreach ($penduduks as $p) {
            // Logika Klasifikasi (Hardcoded di Backend)
            $isLayak = true;

           // 1. Kriteria Umur & Perkawinan
        if (!($p->umur >= 17 || $p->status_kawin === 'Kawin' || $p->status_kawin === 'Pernah Kawin')) {
            $isLayak = false;
        }

        // 2. Kriteria WNI
        if ($p->kewarganegaraan !== 'WNI') {
            $isLayak = false;
        }

        // 3. Kriteria Status Hidup
        if ($p->status_hidup !== 'Hidup') {
            $isLayak = false;
        }

        // 4. Kriteria Pekerjaan (TNI/Polri Tidak Boleh Memilih)
        // Kita gunakan strtoupper agar tidak sensitif terhadap huruf besar/kecil
        $pekerjaan = strtoupper(trim($p->pekerjaan));
        if ($pekerjaan === 'TNI' || $pekerjaan === 'POLRI' || $pekerjaan === 'POLISI') {
            $isLayak = false;
        }

        // 5. Kriteria Domisili
        if ($p->domisili !== 'Desa Ilie') {
            $isLayak = false;
        }

        // 6. Hak Pilih Tidak Dicabut (Opsional, jika ada kolom status hukum)
        if ($p->hak_pilih_internal === 'Dicabut') {
            $isLayak = false;
        }

        // Update status ke database
        $p->update([
            'hak_pilih' => $isLayak ? 'Layak' : 'Tidak Layak'
        ]);
    }

        return redirect()->back()->with('success', 'Proses klasifikasi otomatis selesai!');
    }
}
