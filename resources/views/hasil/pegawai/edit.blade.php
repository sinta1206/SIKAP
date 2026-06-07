@extends('layouts.layoutMain')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/hasil-form.css') }}">
@endpush

@section('content')

<div class="edit-hasil-page">

    <div class="container">

        <div class="form-card">

            {{-- HEADER --}}
            <div class="form-header">

                <div>
                    <h1>Edit Hasil Klasifikasi</h1>
                    <p class="subtitle">
                        Perbarui data hasil klasifikasi pemilih
                    </p>
                </div>

                <a href="{{ route('hasil.index') }}"
                   class="close-btn">

                    <i class="fas fa-times"></i>

                </a>

            </div>

            {{-- ALERT ERROR --}}
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
            <form action="{{ route('hasil.update', $penduduk->id) }}"
                  method="POST"
                  id="formEditHasil">

                @csrf
                @method('PUT')

                <div class="form-grid">

                    {{-- NIK --}}
                    <div class="form-group full-width">

                        <label>NIK</label>

                        <input type="text"
                               name="nik"
                               id="inNIK"
                               value="{{ old('nik', $penduduk->nik) }}"
                               placeholder="Masukkan NIK"
                               required>

                    </div>

                    {{-- NAMA --}}
                    <div class="form-group full-width">

                        <label>Nama Lengkap</label>

                        <input type="text"
                               name="nama"
                               value="{{ old('nama', $penduduk->nama) }}"
                               placeholder="Masukkan nama lengkap"
                               required>

                    </div>

                    {{-- UMUR --}}
                    <div class="form-group">

                        <label>Umur</label>

                        <input type="number"
                               name="umur"
                               value="{{ old('umur', $penduduk->umur) }}"
                               required>

                    </div>

                    {{-- GENDER --}}
                    <div class="form-group">

                        <label>Jenis Kelamin</label>

                        <select name="gender" required>

                            <option value="Laki-laki"
                                {{ old('gender', $penduduk->gender) == 'Laki-laki' ? 'selected' : '' }}>

                                Laki-laki

                            </option>

                            <option value="Perempuan"
                                {{ old('gender', $penduduk->gender) == 'Perempuan' ? 'selected' : '' }}>

                                Perempuan

                            </option>

                        </select>

                    </div>

                    {{-- STATUS KAWIN --}}
                    <div class="form-group">

                        <label>Status Kawin</label>

                        <select name="status_kawin" required>

                            <option value="Belum Menikah"
                                {{ old('status_kawin', $penduduk->status_kawin) == 'Belum Menikah' ? 'selected' : '' }}>

                                Belum Menikah

                            </option>

                            <option value="Menikah"
                                {{ old('status_kawin', $penduduk->status_kawin) == 'Menikah' ? 'selected' : '' }}>

                                Menikah

                            </option>

                            <option value="Cerai"
                                {{ old('status_kawin', $penduduk->status_kawin) == 'Cerai' ? 'selected' : '' }}>

                                Cerai

                            </option>

                        </select>

                    </div>

                    {{-- KEWARGANEGARAAN --}}
                    <div class="form-group">

                        <label>Kewarganegaraan</label>

                        <select name="kewarganegaraan" required>

                            <option value="WNI"
                                {{ old('kewarganegaraan', $penduduk->kewarganegaraan) == 'WNI' ? 'selected' : '' }}>

                                WNI

                            </option>

                            <option value="WNA"
                                {{ old('kewarganegaraan', $penduduk->kewarganegaraan) == 'WNA' ? 'selected' : '' }}>

                                WNA

                            </option>

                        </select>

                    </div>

                    {{-- DOMISILI --}}
                    <div class="form-group">

                        <label>Dusun</label>

                        <input type="text"
                               name="domisili"
                               value="{{ old('domisili', $penduduk->domisili) }}"
                               required>

                    </div>

                    {{-- PEKERJAAN --}}
                    <div class="form-group">

                        <label>Pekerjaan</label>

                        <input type="text"
                               name="pekerjaan"
                               value="{{ old('pekerjaan', $penduduk->pekerjaan) }}"
                               required>

                    </div>

                    {{-- STATUS HIDUP --}}
                    <div class="form-group">

                        <label>Status Hidup</label>

                        <select name="status_hidup">

                            <option value="Hidup"
                                {{ old('status_hidup', $penduduk->status_hidup) == 'Hidup' ? 'selected' : '' }}>

                                Hidup

                            </option>

                            <option value="Meninggal"
                                {{ old('status_hidup', $penduduk->status_hidup) == 'Meninggal' ? 'selected' : '' }}>

                                Meninggal

                            </option>

                        </select>

                    </div>

                    {{-- HAK PILIH --}}
                    <div class="form-group">

                        <label>Hak Pilih</label>

                        <select name="hak_pilih">

                            <option value="Aktif"
                                {{ old('hak_pilih', $penduduk->hak_pilih) == 'Aktif' ? 'selected' : '' }}>

                                Aktif

                            </option>

                            <option value="Non Aktif"
                                {{ old('hak_pilih', $penduduk->hak_pilih) == 'Non Aktif' ? 'selected' : '' }}>

                                TNI/Polri (Non-Aktif)

                            </option>

                            <option value="Dicabut"
                                {{ old('hak_pilih', $penduduk->hak_pilih) == 'Dicabut' ? 'selected' : '' }}>

                                Dicabut

                            </option>

                        </select>

                    </div>

                    {{-- HASIL --}}
                    <div class="form-group">

                        <label>Hasil Klasifikasi</label>

                        <select name="status" required>

                            <option value="Layak"
                                {{ old('status', $penduduk->status) == 'Layak' ? 'selected' : '' }}>
                                Layak
                            </option>

                            <option value="Tidak Layak"
                                {{ old('status', $penduduk->status) == 'Tidak Layak' ? 'selected' : '' }}>
                                Tidak Layak
                            </option>

                        </select>

                    </div>

                    {{-- KETERANGAN --}}
                    <div class="form-group full-width">

                        <label>Keterangan</label>

                        <input type="text"
                               name="keterangan"
                               value="{{ old('keterangan', $penduduk->keterangan) }}"
                               placeholder="Masukkan keterangan hasil"
                               required>

                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="form-footer">

                    <a href="{{ route('hasil.index') }}"
                       class="btn btn-cancel">

                        Batal

                    </a>

                    <button type="submit"
                            class="btn btn-submit">

                        <i class="fas fa-save"></i>
                        Simpan Perubahan

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
