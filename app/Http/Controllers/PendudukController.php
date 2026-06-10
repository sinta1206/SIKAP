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

    public function create()
    {
        return view('dataPenduduk.pegawai.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => ['required', 'digits:16', 'regex:/^[0-9]{16}$/', 'unique:penduduks,nik'],
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
        return redirect()->route('penduduk.index')->with('success', 'Warga baru berhasil ditambahkan!');
    }

    // LOGIKA 2: IMPORT (Excel & CSV) - VERSI FINAL
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        try {

            $file = $request->file('file');

            $filename = time() . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('temp', $filename);

            $fullPath = storage_path('app/private/' . $path);

            $extension = $file->getClientOriginalExtension();

            $fastExcel = new FastExcel;

            if ($extension === 'csv') {

                $handle = fopen($fullPath, 'r');

                $firstLine = fgets($handle);

                fclose($handle);

                $delimiter = str_contains($firstLine, ';') ? ';' : ',';

                $fastExcel->configureCsv($delimiter);
            }

            $baris = 1;

            $fastExcel->import($fullPath, function ($line) use (&$baris) {

                $baris++;

                $nik = trim((string)($line['NIK'] ?? ''));
                $nama = trim((string)($line['Nama'] ?? ''));
                $umur = trim((string)($line['Umur'] ?? ''));
                $gender = trim((string)($line['Jenis Kelamin'] ?? ''));
                $pekerjaan = trim((string)($line['Pekerjaan'] ?? ''));
                $statusKawin = trim((string)($line['Status Kawin'] ?? ''));
                $kewarganegaraan = trim((string)($line['Kewarganegaraan'] ?? ''));
                $domisili = trim((string)($line['Dusun'] ?? ''));
                $statusHidup = trim((string)($line['Status Hidup'] ?? ''));
                $hakPilih = trim((string)($line['Hak Pilih'] ?? ''));

                // CEK DATA KOSONG
                if (
                    empty($nik) ||
                    empty($nama) ||
                    empty($umur) ||
                    empty($gender) ||
                    empty($pekerjaan) ||
                    empty($statusKawin) ||
                    empty($kewarganegaraan) ||
                    empty($domisili) ||
                    empty($statusHidup) ||
                    empty($hakPilih)
                ) {
                    throw new \Exception(
                        "Baris {$baris}: Terdapat kolom yang belum diisi."
                    );
                }

                // CEK NIK
                if (!preg_match('/^\d{16}$/', $nik)) {
                    throw new \Exception(
                        "Baris {$baris}: NIK harus terdiri dari 16 digit angka."
                    );
                }

                // CEK DUPLIKAT NIK
                if (Penduduk::where('nik', $nik)->exists()) {
                    throw new \Exception(
                        "Baris {$baris}: NIK {$nik} sudah terdaftar di sistem."
                    );
                }

                // CEK GENDER
                if (!in_array($gender, ['Laki-laki', 'Perempuan'])) {
                    throw new \Exception(
                        "Baris {$baris}: Jenis Kelamin harus Laki-laki atau Perempuan."
                    );
                }

                // CEK STATUS KAWIN
                if (!in_array($statusKawin, ['Belum Menikah', 'Sudah Menikah', 'Cerai'])) {
                    throw new \Exception(
                        "Baris {$baris}: Status Kawin harus Belum Menikah, Sudah Menikah, atau Cerai."
                    );
                }

                // CEK KEWARGANEGARAAN
                if (!in_array($kewarganegaraan, ['WNI', 'WNA'])) {
                    throw new \Exception(
                        "Baris {$baris}: Kewarganegaraan harus WNI atau WNA."
                    );
                }

                // CEK STATUS HIDUP
                if (!in_array($statusHidup, ['Hidup', 'Meninggal'])) {
                    throw new \Exception(
                        "Baris {$baris}: Status Hidup harus Hidup atau Meninggal."
                    );
                }

                // CEK HAK PILIH
                if (!in_array($hakPilih, ['Aktif', 'Non Aktif', 'Dicabut'])) {
                    throw new \Exception(
                        "Baris {$baris}: Hak Pilih harus Aktif, Non Aktif, atau Dicabut."
                    );
                }

                return Penduduk::create([
                    'nik'             => $nik,
                    'nama'            => $nama,
                    'umur'            => $umur,
                    'gender'          => $gender,
                    'pekerjaan'       => $pekerjaan,
                    'status_kawin'    => $statusKawin,
                    'kewarganegaraan' => $kewarganegaraan,
                    'domisili'        => $domisili,
                    'status_hidup'    => $statusHidup,
                    'hak_pilih'       => $hakPilih,

                    'status'          => null,
                    'keterangan'      => null,
                ]);
            });

            return redirect()
                ->back()
                ->with('success', 'Data berhasil di-import.');

        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }

    //Edit Data
    public function edit($id)
    {
        $penduduk = Penduduk::findOrFail($id);

        return view('dataPenduduk.pegawai.edit', compact('penduduk'));
    }

    //Update Data
    public function update(Request $request, $id)
    {
        $penduduk = Penduduk::findOrFail($id);

        $validated = $request->validate([
            'nik' => ['required', 'digits:16', 'regex:/^[0-9]{16}$/', 'unique:penduduks,nik,' . $id],
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

        $penduduk->update($validated);

        return redirect()
            ->route('penduduk.index')
            ->with('success', 'Data penduduk berhasil diperbarui.');
    }

    // Hapus Data
    public function destroy($id)
    {
        Penduduk::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    // Reset Data
    public function resetData()
    {
        Penduduk::truncate();

        return redirect()
            ->route('penduduk.index')
            ->with('success', 'Semua data penduduk berhasil direset.');
    }
    
}
