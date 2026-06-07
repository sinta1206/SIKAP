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
        $sudahKlasifikasi = Penduduk::whereNotNull('status')->exists();

        if (!$sudahKlasifikasi) {
            return view('hasil.empty');
        }

        $query = Penduduk::whereNotNull('status');

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

        // Fitur Filter Status Kelayakan
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $data = $query->get();

        // Hitung Ringkasan Data untuk Card
        $totalData = $data->count();
        $layak = $data->where('status', 'Layak')->count();
        $tidakLayak = $data->where('status', 'Tidak Layak')->count();

        $viewPath = (Auth::user()->role == 'pegawai_desa') ? 'hasil.pegawai.index' : 'hasil.panitia.index';

        return view($viewPath, compact('data', 'totalData', 'layak', 'tidakLayak'));
    }

    //FITUR TAMBAH & EDIT OLEH PEGAWAI

    public function create()
    {
        return view('hasil.pegawai.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|unique:penduduks,nik',
            'nama' => 'required',
            'umur' => 'required|numeric',
            'gender' => 'required',
            'status_kawin' => 'required',
            'kewarganegaraan' => 'required',
            'domisili' => 'required',
            'pekerjaan' => 'required',
            'status_hidup' => 'required|string',
            'hak_pilih' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
        ]);

        Penduduk::create($validated);

        return redirect()->route('hasil.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $penduduk = Penduduk::findOrFail($id);
        return view('hasil.pegawai.edit', compact('penduduk'));
    }

    public function update(Request $request, $id)
    {
        $penduduk = Penduduk::findOrFail($id);

        $validated = $request->validate([
            'nik' => 'required|unique:penduduks,nik,' . $id,
            'nama' => 'required',
            'umur' => 'required|numeric',
            'gender' => 'required',
            'status_kawin' => 'required',
            'kewarganegaraan' => 'required',
            'domisili' => 'required',
            'pekerjaan' => 'required',
            'status_hidup' => 'required',
            'hak_pilih' => 'required',
            'status' => 'required',
            'keterangan' => 'required',
        ]);

        $penduduk->update($validated);

        return redirect()->route('hasil.index')->with('success', 'Data hasil klasifikasi berhasil diperbarui.');
    }

    // FITUR UNDUH CSV
    public function export()
    {
        $list = Penduduk::whereNotNull('status')->get();

        return (new FastExcel($list))->download('hasil_klasifikasi_pemilu.csv', function ($p) {
            return [
                'NIK'             => $p->nik,
                'Nama'            => $p->nama,
                'Umur'            => $p->umur . ' thn',
                'Jenis Kelamin'   => $p->gender,
                'Status Kawin'    => $p->status_kawin,
                'Kewarganegaraan' => $p->kewarganegaraan,
                'Domisili'        => $p->domisili,
                'Pekerjaan'       => $p->pekerjaan,
                'Status Hidup'    => $p->status_hidup,
                'Hak Pilih'       => $p->hak_pilih,
                'Hasil'           => $p->status,
                'Keterangan'      => $p->keterangan,
            ];
        });
    }
}
