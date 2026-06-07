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
        $layak = Penduduk::where('status', 'Layak')->count();
        $tidakLayak = Penduduk::where('status', 'Tidak Layak')->count();

        return view('klasifikasi.index', compact('totalData', 'layak', 'tidakLayak'));
    }

    public function jalankan()
    {
        // 2. Keamanan: Hanya 'pegawai' yang bisa eksekusi
        if (Auth::user()->role !== 'pegawai_desa') {
            return redirect()->back()->with('error', 'Hanya Pegawai Desa yang dapat menjalankan proses ini.');
        }

        // 3. Ambil semua data penduduk yang belum diklasifikasi (status = null)
        $penduduks = Penduduk::whereNull('status')->get();

        foreach ($penduduks as $p) {
            $isLayak = true;
            $alasan = []; // Tempat menampung alasan jika tidak layak

            // 1. Kriteria Umur & Perkawinan
            if (!($p->umur >= 17 || $p->status_kawin === 'Menikah' || $p->status_kawin === 'Cerai')) {
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

            // 4. Status Hak Pilih
            if ($p->hak_pilih !== 'Aktif') {
                $isLayak = false;

                if ($p->hak_pilih === 'Non Aktif') {
                    $alasan[] = 'Hak Pilih Non Aktif (Anggota TNI/Polri)';
                }

                if ($p->hak_pilih === 'Dicabut') {
                    $alasan[] = 'Hak Pilih Dicabut Hukum';
                }
            }

            // Tentukan hasil akhir
            $statusAkhir = $isLayak ? 'Layak' : 'Tidak Layak';
            $keteranganAkhir = $isLayak ? '-' : implode(', ', $alasan);

            // Update ke database
            $p->update([
                'status'      => $statusAkhir,
                'keterangan'  => $keteranganAkhir
            ]);
    }

        return redirect()->back()->with('success', 'Proses klasifikasi otomatis selesai!');
    }
}
