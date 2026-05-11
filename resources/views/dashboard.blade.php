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
                    Selamat datang, {{ $name }} - Desa Maju Bersama - Pemilu {{ date('Y') }}
                    ( {{ $role == 'pegawai_desa' ? 'Pegawai Desa' : 'Panitia Pemilu' }} )
                </p>

            </div>
        </div>

        <div class="header-btns">
            <button class="btn btn-red">Import Data</button>
            <button class="btn btn-light">Lihat Hasil</button>
        </div>
    </header>

    <!-- Statistik -->
    <div class="stats-grid">

        <div class="card stat-card">
            <div class="card-icon red"><i class="fas fa-users"></i></div>
            <div class="card-data">
                <small>Total Data Penduduk</small>
                <h3>20</h3>
                <span class="sub-text">+0 Data Baru</span>
            </div>
            <div class="card-wave"><i class="fas fa-heartbeat"></i></div>
        </div>

        <div class="card stat-card">
            <div class="card-icon green"><i class="fas fa-check-circle"></i></div>
            <div class="card-data">
                <small>Layak Memilih</small>
                <h3>13</h3>
                <span class="sub-text">65% dari total</span>
            </div>
            <div class="card-wave green-text"><i class="fas fa-heartbeat"></i></div>
        </div>

        <div class="card stat-card">
            <div class="card-icon orange"><i class="fas fa-times-circle"></i></div>
            <div class="card-data">
                <small>Tidak Layak Memilih</small>
                <h3>7</h3>
                <span class="sub-text">35% dari total</span>
            </div>
            <div class="card-wave orange-text"><i class="fas fa-heartbeat"></i></div>
        </div>

        <div class="card stat-card">
            <div class="card-icon blue"><i class="fas fa-chart-line"></i></div>
            <div class="card-data">
                <small>Persentase Layak</small>
                <h3>65%</h3>
                <span class="sub-text">Tingkat partisipasi</span>
            </div>
            <div class="card-wave blue-text"><i class="fas fa-heartbeat"></i></div>
        </div>

    </div>

    <!-- Aksi Cepat -->
    <div class="action-section">

        <div class="action-header">
            <i class="fas fa-bolt"></i>
            <span>Aksi Cepat</span>
        </div>

        <div class="action-list">

            <a href="#" class="action-item">
                <div class="action-icon bg-red-light"><i class="fas fa-file-import"></i></div>
                <div class="action-info">
                    <strong>Import Data Penduduk</strong>
                    <p>Unggah File CSV/EXCEL</p>
                </div>
                <div class="action-arrow"><i class="fas fa-chevron-right"></i></div>
            </a>

            <div class="action-item" onclick="handleAction('Klasifikasi')">
                <div class="action-icon bg-purple-light"><i class="fas fa-cogs"></i></div>
                <div class="action-info">
                    <strong>Jalankan klasifikasi</strong>
                    <p>proses data otomatis</p>
                </div>
                <div class="action-arrow"><i class="fas fa-chevron-right"></i></div>
            </div>

            <div class="action-item" onclick="handleAction('Hasil')">
                <div class="action-icon bg-green-light"><i class="fas fa-list-alt"></i></div>
                <div class="action-info">
                    <strong>Lihat hasil klasifikasi</strong>
                    <p>Tabel & status kelayakan</p>
                </div>
                <div class="action-arrow"><i class="fas fa-chevron-right"></i></div>
            </div>

            <div class="action-item" onclick="handleAction('Kriteria')">
                <div class="action-icon bg-blue-light"><i class="fas fa-tasks"></i></div>
                <div class="action-info">
                    <strong>Kelola kriteria pemilu</strong>
                    <p>Atur aturan klasifikasi</p>
                </div>
                <div class="action-arrow"><i class="fas fa-chevron-right"></i></div>
            </div>

        </div>

    </div>

</div>

@endsection

{{-- JS KHUSUS HALAMAN --}}
@push('scripts')
<script src="{{ asset('js/dashboard.js') }}"></script>
@endpush
