@extends('layouts.layoutMain')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/hasil-form.css') }}">
@endpush

@section('content')

<div class="create-hasil-page">

    <div class="container">

        <div class="form-card">

            {{-- HEADER --}}
            <div class="form-header">

                <div>
                    <h1>Tambah Hasil Klasifikasi</h1>
                    <p class="subtitle">
                        Input data hasil klasifikasi pemilih baru
                    </p>
                </div>

                <a href="{{ route('hasil.index') }}" class="close-btn">
                    &times;
                </a>

            </div>

            {{-- ERROR VALIDASI --}}
            @if ($errors->any())
                <div class="alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM --}}
            <form action="{{ route('hasil.store') }}" method="POST">

                @csrf

                <div class="form-grid">

                    {{-- NIK --}}
                    <div class="form-group full-width">
                        <label>NIK</label>
                        <input type="text" name="nik" value="{{ old('nik') }}" required>
                    </div>

                    {{-- NAMA --}}
                    <div class="form-group full-width">
                        <label>Nama</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required>
                    </div>

                    {{-- UMUR --}}
                    <div class="form-group">
                        <label>Umur</label>
                        <input type="number" name="umur" value="{{ old('umur') }}" required>
                    </div>

                    {{-- GENDER --}}
                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" required>
                            <option value="">Pilih</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    {{-- STATUS KAWIN --}}
                    <div class="form-group">
                        <label>Status Kawin</label>
                        <select name="status_kawin" required>
                            <option value="">Pilih</option>
                            <option value="Belum Kawin">Belum Menikah</option>
                            <option value="Menikah">Menikah</option>
                            <option value="Cerai">Cerai</option>
                        </select>
                    </div>

                    {{-- KEWARGANEGARAAN --}}
                    <div class="form-group">
                        <label>Kewarganegaraan</label>
                        <select name="kewarganegaraan" required>
                            <option value="">Pilih</option>
                            <option value="WNI">WNI</option>
                            <option value="WNA">WNA</option>
                        </select>
                    </div>

                    {{-- DOMISILI --}}
                    <div class="form-group">
                        <label>Dusun</label>
                        <input type="text" name="domisili" value="{{ old('domisili') }}" required>
                    </div>

                    {{-- PEKERJAAN --}}
                    <div class="form-group">
                        <label>Pekerjaan</label>
                        <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}" required>
                    </div>

                    {{-- STATUS HIDUP --}}
                    <div class="form-group">
                        <label>Status Hidup</label>
                        <select name="status_hidup" required>
                            <option value="Hidup">Hidup</option>
                            <option value="Meninggal">Meninggal</option>
                        </select>
                    </div>

                    {{-- HAK PILIH --}}
                    <div class="form-group">
                        <label>Hak Pilih</label>
                        <select name="hak_pilih" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Non Aktif">TNI/Polri (Non-Aktif)</option>
                            <option value="Dicabut">Dicabut</option>
                        </select>
                    </div>

                    {{-- HASIL --}}
                    <div class="form-group">
                        <label>Hasil Klasifikasi</label>
                        <select name="status" required>
                            <option value="Layak">Layak</option>
                            <option value="Tidak Layak">Tidak Layak</option>
                        </select>
                    </div>



                    {{-- KETERANGAN --}}
                    <div class="form-group full-width">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" value="{{ old('keterangan') }}" required>
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="form-footer">

                    <a href="{{ route('hasil.index') }}" class="btn btn-cancel">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-submit">
                        Simpan Data
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script src="{{ asset('js/hasil-form.js') }}"></script>
@endpush
