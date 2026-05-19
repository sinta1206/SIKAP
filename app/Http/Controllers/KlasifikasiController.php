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
            $isLayak = true;
            $alasan = []; // Tempat menampung alasan jika tidak layak

            // 1. Kriteria Umur & Perkawinan
            if (!($p->umur >= 17 || $p->status_kawin === 'Kawin' || $p->status_kawin === 'Pernah Kawin')) {
                $isLayak = false;
                $alasan[] = 'Umur < 17 thn & Belum Menikah';
            }

            // 2. Kriteria WNI
            if ($p->kewarganegaraan !== 'WNI') {
                $isLayak = false;
                $alasan[] = 'Bukan WNI';
            }

            // 3. Kriteria Status Hidup
            if ($p->status_hidup !== 'Hidup') {
                $isLayak = false;
                $alasan[] = 'Sudah Meninggal';
            }

            // 4. Kriteria Pekerjaan (TNI/Polri)
            $pekerjaan = strtoupper(trim($p->pekerjaan));
            if ($pekerjaan === 'TNI' || $pekerjaan === 'POLRI' || $pekerjaan === 'POLISI') {
                $isLayak = false;
                $alasan[] = 'Anggota Aktif ' . $pekerjaan;
            }

             // 5. Kriteria Hak Pilih Dicabut secara Hukum (Ditinjau dari kolom internal)
            if ($p->hak_pilih_internal === 'Dicabut') {
                $isLayak = false;
                $alasan[] = 'Hak Pilih Dicabut Hukum';
            }

            // Tentukan hasil akhir
            $statusAkhir = $isLayak ? 'Layak' : 'Tidak Layak';
            $keteranganAkhir = $isLayak ? '-' : implode(', ', $alasan);

            // Update ke database
            $p->update([
                'hak_pilih'  => $statusAkhir,
                'keterangan' => $keteranganAkhir
            ]);
    }

        return redirect()->back()->with('success', 'Proses klasifikasi otomatis selesai!');
    }
}
