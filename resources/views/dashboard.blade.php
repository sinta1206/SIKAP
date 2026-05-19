@extends('layouts.layoutMain')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')

<div class="container">

    <header>
        <div class="header-content">
            <div class="user-info">
                <h2>Dashboard</h2>

                <p>
                    Selamat datang, {{ $panggilan }} - Desa Maju Bersama - Pemilu {{ date('Y') }}
                </p>

            </div>
        </div>

        <div class="header-btns">
            <a href="{{ route('penduduk.index') }}" class="btn btn-red">
                Import Data
            </a>

            <a href="{{ route('hasil.index') }}" class="btn btn-light">
                Lihat Hasil
            </a>
        </div>
    </header>

    <!-- STATISTIK -->
    <div class="stats-grid">

        <!-- TOTAL -->
        <div class="card stat-card">
            <div class="card-icon red">
                <i class="fas fa-users"></i>
            </div>

            <div class="card-data">
                <small>Total Data Penduduk</small>
                <h3>{{ $totalData }}</h3>
                <span class="sub-text">Data keseluruhan</span>
            </div>

            <div class="card-wave">
                <i class="fas fa-chart-bar"></i>
            </div>

        </div>

        <!-- LAYAK -->
        <div class="card stat-card">
            <div class="card-icon green">
                <i class="fas fa-check-circle"></i>
            </div>

            <div class="card-data">
                <small>Layak Memilih</small>
                <h3>{{ $layak }}</h3>
                <span class="sub-text">
                    {{ $totalData > 0 ? round(($layak / $totalData) * 100) : 0 }}% dari total
                </span>
            </div>

            <div class="card-wave green-text">
                <i class="fas fa-heartbeat"></i>
            </div>

        </div>

        <!-- TIDAK LAYAK -->
        <div class="card stat-card">
            <div class="card-icon orange">
                <i class="fas fa-times-circle"></i>
            </div>

            <div class="card-data">
                <small>Tidak Layak Memilih</small>
                <h3>{{ $tidakLayak }}</h3>
                <span class="sub-text">
                    {{ $totalData > 0 ? round(($tidakLayak / $totalData) * 100) : 0 }}%
                </span>
            </div>

            <div class="card-wave orange-text">
                <i class="fas fa-heartbeat"></i>
            </div>

        </div>

        <!-- PERSENTASE -->
        <div class="card stat-card">
            <div class="card-icon blue">
                <i class="fas fa-chart-line"></i>
            </div>

            <div class="card-data">
                <small>Persentase Layak</small>
                <h3>{{ $persentaseLayak }}%</h3>
                <span class="sub-text">Tingkat kelayakan</span>
            </div>

            <div class="card-wave blue-text">
                <i class="fas fa-heartbeat"></i>
            </div>
            
        </div>

    </div>

    <!-- AKSI CEPAT -->
    <div class="action-section">

        <div class="action-header">
            <i class="fas fa-bolt"></i>
            <span>Aksi Cepat</span>
        </div>

        <div class="action-list">

            <a href="{{ route('penduduk.index') }}" class="action-item">
                <div class="action-icon bg-red-light">
                    <i class="fas fa-file-import"></i>
                </div>

                <div class="action-info">
                    <strong>Import Data Penduduk</strong>
                    <p>Kelola data penduduk</p>
                </div>

                <div class="action-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>

            </a>

            <a href="{{ route('klasifikasi.index') }}" class="action-item">
                <div class="action-icon bg-purple-light">
                    <i class="fas fa-cogs"></i>
                </div>

                <div class="action-info">
                    <strong>Jalankan Klasifikasi</strong>
                    <p>Proses data otomatis</p>
                </div>

                <div class="action-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>

            <a href="{{ route('hasil.index') }}" class="action-item">
                <div class="action-icon bg-green-light">
                    <i class="fas fa-list-alt"></i>
                </div>


                <div class="action-info">
                    <strong>Lihat Hasil</strong>
                    <p>Tabel & status kelayakan</p>
                </div>

                <div class="action-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>

            <div class="action-item">
                <div class="action-icon bg-blue-light">
                    <i class="fas fa-tasks"></i>
                </div>


                <div class="action-info">
                    <strong>Kelola Kriteria</strong>
                    <p>Aturan klasifikasi sistem</p>
                </div>

                <div class="action-arrow">
                    <i class="fas fa-chevron-right"></i>

               </div>
            </div>

        </div>

    </div>

</div>

@endsection


@push('scripts')
<script src="{{ asset('js/dashboard.js') }}"></script>
@endpush
