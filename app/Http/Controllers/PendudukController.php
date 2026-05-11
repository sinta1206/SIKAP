<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Log;

class PendudukController extends Controller
{
    // Menampilkan data untuk Pegawai & Panitia
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Penduduk::query();

        if ($search) {
            $query->where('nama', 'LIKE', "%{$search}%")
                  ->orWhere('nik', 'LIKE', "%{$search}%");
        }

        $data = $query->get();
        $totalData = $data->count();

        // Cek Role
        if (Auth::user()->role == 'pegawai_desa') {
            return view('dataPenduduk.pegawai.index', compact('data', 'totalData'));
        }
        return view('dataPenduduk.panitia.index', compact('data', 'totalData'));
    }

    // LOGIKA 1: TAMBAH MANUAL
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|digits:16|unique:penduduks,nik',
            'nama' => 'required|string',
            'umur' => 'required|numeric',
            'gender' => 'required',
            'pekerjaan' => 'required',
            'status_kawin' => 'required',
            'kewarganegaraan' => 'required',
            'domisili' => 'required',
            'status_hidup' => 'required',
            'hak_pilih' => 'required',
        ]);

        Penduduk::create($validated);
        return redirect()->back()->with('success', 'Warga baru berhasil ditambahkan!');
    }

    // LOGIKA 2: IMPORT (Excel & CSV) - VERSI FINAL
    public function import(Request $request)
    {
        // 1. Validasi File
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        try {
            $file = $request->file('file');
            $path = $file->getRealPath();
            $extension = $file->getClientOriginalExtension();

            // 2. Inisialisasi FastExcel
            $fastExcel = new FastExcel;

            // 3. Jika file adalah CSV, deteksi pemisah (koma atau titik koma)
            if ($extension === 'csv') {
                $handle = fopen($path, 'r');
                $firstLine = fgets($handle);
                fclose($handle);

                $delimiter = str_contains($firstLine, ';') ? ';' : ',';
                $fastExcel->configureCsv($delimiter);
            }

            // 4. Proses Import dan Simpan ke DB
            $fastExcel->import($path, function ($line) {
                return Penduduk::create([
                    'nik'             => trim($line['NIK'] ?? null),
                    'nama'            => trim($line['Nama'] ?? null),
                    'umur'            => trim($line['Umur'] ?? 0),
                    'gender'          => trim($line['Jenis Kelamin'] ?? null),
                    'pekerjaan'       => trim($line['Pekerjaan'] ?? null),
                    'status_kawin'    => trim($line['Status Kawin'] ?? null),
                    'kewarganegaraan' => trim($line['Kewarganegaraan'] ?? null),
                    'domisili'        => trim($line['Dusun'] ?? null),
                    'status_hidup'    => trim($line['Status Hidup'] ?? null),
                    'hak_pilih'       => trim($line['Hak Pilih'] ?? null),
                ]);
            });

            return redirect()->back()->with('success', 'Data berhasil di-import!');

        } catch (\Exception $e) {
            // Log error jika terjadi kegagalan (misal nama kolom di excel tidak sesuai)
            Log::error('Gagal Import: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengimpor data. Pastikan format kolom Excel/CSV sudah sesuai.');
        }
    }

    // Hapus Data
    public function destroy($id)
    {
        Penduduk::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
