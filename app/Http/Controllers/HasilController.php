<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;

class HasilController extends Controller
{
    public function index(Request $request)
    {
        // Query untuk Cek apakah sudah ada penduduk yang diklasifikasi
        $sudahKlasifikasi = Penduduk::whereNotNull('hak_pilih')->exists();

        // Jika belum ada hasil, tampilkan halaman "Empty State"
        if (!$sudahKlasifikasi) {
            return view('hasil.empty');
        }

        // Jika sudah ada, siapkan Query untuk tabel
        $query = Penduduk::query();

        // Fitur Pencarian (Nama atau NIK)
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('nik', 'LIKE', '%' . $request->search . '%');
            });
        }

        // Fitur Filter Gender
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // Fitur Filter Status Kelayakan (Layak/Tidak Layak)
        if ($request->filled('status')) {
            $query->where('hak_pilih', $request->status);
        }

        $data = $query->get();

        // Hitung Ringkasan Data untuk Card
        $totalData = $data->count();
        $layak = $data->where('hak_pilih', 'Layak')->count();
        $tidakLayak = $data->where('hak_pilih', 'Tidak Layak')->count();

        //Arahkan ke view berdasarkan Role
        $viewPath = (Auth::user()->role == 'pegawai_desa') ? 'hasil.pegawai.index' : 'hasil.panitia.index';

        return view($viewPath, compact('data', 'totalData', 'layak', 'tidakLayak'));
    }

    // Fungsi Unduh CSV (Hanya data yang sudah ada hasil klasifikasinya)
    public function export()
    {
        $list = Penduduk::whereNotNull('hak_pilih')->get();

        return (new FastExcel($list))->download('hasil_klasifikasi_pemilu.csv', function ($p) {
            return [
                'NIK'             => $p->nik,
                'Nama'            => $p->nama,
                'Umur'            => $p->umur . ' thn',
                'Jenis Kelamin'   => $p->gender,
                'Status Kawin'    => $p->status_kawin,
                'Kewarganegaraan' => $p->kewarganegaraan,
                'Domisili'        => $p->domisili,
                'Hasil'           => $p->hak_pilih,
            ];
        });
    }
}
