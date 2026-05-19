@extends('layouts.layoutMain')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/klasifikasi.css') }}">
@endpush

@section('content')

<div class="klasifikasi-page">

    <div class="container">

        {{-- HEADER --}}
        <div class="page-header">
            <h1>Klasifikasi Pemilu</h1>

            <p class="desc">
                Jalankan proses klasifikasi otomatis berdasarkan kriteria yang telah ditetapkan
            </p>
        </div>

        {{-- ALERT --}}
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        {{-- KRITERIA --}}
        <div class="card">

            <h2>Kriteria Kelayakan Pemilu</h2>

            <p class="card-desc">
                Penduduk dinyatakan layak memilih apabila memenuhi seluruh kriteria berikut:
            </p>

            <div class="criteria-list">

                <div class="item">
                    🎂 Berusia ≥ 17 tahun atau sudah/pernah menikah
                </div>

                <div class="item">
                    🇮🇩 Berstatus WNI
                </div>

                <div class="item">
                    💚 Status hidup masih aktif
                </div>

                <div class="item">
                    🪖 Bukan anggota aktif TNI/POLRI
                </div>

                <div class="item">
                    ⚖️ Hak pilih tidak dicabut secara hukum
                </div>

            </div>

            <div class="note">
                Jika salah satu kriteria tidak terpenuhi,
                maka sistem otomatis mengklasifikasikan sebagai
                <strong>Tidak Layak</strong>.
            </div>

        </div>

        {{-- RINGKASAN --}}
        <div class="card">

            <h2>Ringkasan Data</h2>

            <div class="summary">

                <div class="box red">
                    <h3>{{ $totalData ?? 0 }}</h3>
                    <p>Total Data</p>
                </div>

                <div class="box green">
                    <h3>{{ $layak ?? 0 }}</h3>
                    <p>Layak</p>
                </div>

                <div class="box orange">
                    <h3>{{ $tidakLayak ?? 0 }}</h3>
                    <p>Tidak Layak</p>
                </div>

            </div>

        </div>

        {{-- MESIN KLASIFIKASI --}}
        <div class="card">

            <h2>Mesin Klasifikasi</h2>

            @if(auth()->user()->role == 'pegawai_desa')

                <div class="actions">

                    {{-- FORM POST --}}
                    <form action="{{ route('klasifikasi.run') }}" method="POST">

                        @csrf

                        <button type="submit" class="btn-primary">
                            Jalankan Klasifikasi
                        </button>

                    </form>

                    <a href="{{ route('hasil.index') }}" class="btn-outline">
                        Lihat Hasil
                    </a>

                </div>

                <div class="info-text">
                    Sistem akan memproses seluruh data penduduk secara otomatis.
                </div>

            @else

                <div class="alert-info">
                    Hanya Pegawai Desa yang dapat menjalankan proses klasifikasi.
                </div>

                <div class="actions">

                    <a href="{{ route('hasil.index') }}" class="btn-outline">
                        Lihat Hasil →
                    </a>

                </div>

            @endif

        </div>

        {{-- FLOW --}}
        <div class="card">

            <h2>Alur Kerja Klasifikasi</h2>

            <div class="flow">

                <div class="flow-item">
                    📂 Baca Data
                </div>

                <div class="flow-item">
                    🔍 Validasi Data
                </div>

                <div class="flow-item">
                    ⚖️ Cek Kriteria
                </div>

                <div class="flow-item">
                    🏷️ Tentukan Status
                </div>

                <div class="flow-item">
                    💾 Simpan Hasil
                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script src="{{ asset('js/klasifikasi.js') }}"></script>
@endpush
