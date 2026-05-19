@extends('layouts.layoutMain')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/editPenduduk.css') }}">
@endpush

@section('content')

<div class="editPenduduk-page">

    <div class="form-card">

        <header class="form-header">

            <div>
                <h2>Tambah Data Penduduk</h2>
                <p>Tambahkan data penduduk baru</p>
            </div>

            <a href="{{ route('penduduk.index') }}" class="close-btn">
                &times;
            </a>

        </header>

        {{-- ALERT VALIDATION --}}
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
        <form action="{{ route('penduduk.store') }}" method="POST">

            @csrf

            <div class="form-grid">

                {{-- NIK --}}
                <div class="form-group full-width">
                    <label>NIK</label>

                    <input
                        type="text"
                        name="nik"
                        value="{{ old('nik') }}"
                        placeholder="Masukkan 16 digit NIK"
                        required
                    >
                </div>

                {{-- NAMA --}}
                <div class="form-group full-width">
                    <label>Nama Lengkap</label>

                    <input
                        type="text"
                        name="nama"
                        value="{{ old('nama') }}"
                        placeholder="Masukkan nama lengkap"
                        required
                    >
                </div>

                {{-- UMUR --}}
                <div class="form-group">
                    <label>Umur</label>

                    <input
                        type="number"
                        name="umur"
                        value="{{ old('umur') }}"
                        placeholder="Masukkan umur"
                        required
                    >
                </div>

                {{-- GENDER --}}
                <div class="form-group">
                    <label>Jenis Kelamin</label>

                    <select name="gender">

                        <option value="">-- Pilih --</option>

                        <option value="Laki-laki"
                            {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>
                            Laki-laki
                        </option>

                        <option value="Perempuan"
                            {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan
                        </option>

                    </select>
                </div>

                {{-- PEKERJAAN --}}
                <div class="form-group">
                    <label>Pekerjaan</label>

                    <input
                        type="text"
                        name="pekerjaan"
                        value="{{ old('pekerjaan') }}"
                        placeholder="Masukkan pekerjaan"
                        required
                    >
                </div>

                {{-- STATUS KAWIN --}}
                <div class="form-group">
                    <label>Status Kawin</label>

                    <select name="status_kawin">

                        <option value="">-- Pilih --</option>

                        <option value="Belum Menikah"
                            {{ old('status_kawin') == 'Belum Menikah' ? 'selected' : '' }}>
                            Belum Menikah
                        </option>

                        <option value="Menikah"
                            {{ old('status_kawin') == 'Menikah' ? 'selected' : '' }}>
                            Menikah
                        </option>

                        <option value="Cerai"
                            {{ old('status_kawin') == 'Cerai' ? 'selected' : '' }}>
                            Cerai
                        </option>

                    </select>
                </div>

                {{-- KEWARGANEGARAAN --}}
                <div class="form-group">
                    <label>Kewarganegaraan</label>

                    <select name="kewarganegaraan">

                        <option value="">-- Pilih --</option>

                        <option value="WNI"
                            {{ old('kewarganegaraan') == 'WNI' ? 'selected' : '' }}>
                            WNI
                        </option>

                        <option value="WNA"
                            {{ old('kewarganegaraan') == 'WNA' ? 'selected' : '' }}>
                            WNA
                        </option>

                    </select>
                </div>

                {{-- DOMISILI --}}
                <div class="form-group">
                    <label>Dusun</label>

                    <input
                        type="text"
                        name="domisili"
                        value="{{ old('domisili') }}"
                        placeholder="Masukkan dusun"
                        required
                    >
                </div>

                {{-- STATUS HIDUP --}}
                <div class="form-group">
                    <label>Status Hidup</label>

                    <select name="status_hidup">

                        <option value="">-- Pilih --</option>

                        <option value="Hidup"
                            {{ old('status_hidup') == 'Hidup' ? 'selected' : '' }}>
                            Hidup
                        </option>

                        <option value="Meninggal"
                            {{ old('status_hidup') == 'Meninggal' ? 'selected' : '' }}>
                            Meninggal
                        </option>

                    </select>
                </div>

                {{-- HAK PILIH --}}
                <div class="form-group full-width">
                    <label>Hak Pilih</label>

                    <select name="hak_pilih">

                        <option value="">-- Pilih --</option>

                        <option value="Aktif"
                            {{ old('hak_pilih') == 'Aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="Dicabut"
                            {{ old('hak_pilih') == 'Dicabut' ? 'selected' : '' }}>
                            Dicabut
                        </option>

                        <option value="TNI/Polri"
                            {{ old('hak_pilih') == 'TNI/Polri' ? 'selected' : '' }}>
                            TNI/Polri (Non-Aktif)
                        </option>

                    </select>
                </div>

            </div>

            {{-- BUTTON --}}
            <div class="form-footer">

                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i>
                    Simpan Data
                </button>

            </div>

        </form>

    </div>

</div>

@endsection

@push('scripts')
<script src="{{ asset('js/editPenduduk.js') }}"></script>
@endpush
