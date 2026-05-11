@extends('layouts.layoutMain')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/hasil.css') }}">
@endpush


@section('content')

<div class="container">

    <header>
        <div class="header-left">
            <h1>Hasil Klasifikasi</h1>
            <p class="subtitle">Data pemilih hasil klasifikasi otomatis</p>
        </div>

        <div class="header-right">
            <button class="btn btn-light">
                <i class="fas fa-file-export"></i> Unduh CSV
            </button>
            <button class="btn btn-red">
                Cetak
            </button>
        </div>
    </header>

    <!-- Statistik -->
    <div class="stats-grid">
        <div class="stat-mini-card">
            <div class="mini-icon red-bg"><i class="fas fa-clipboard-list"></i></div>
            <div>
                <small>Total Data</small>
                <h3>{{ count($data ?? []) }}</h3>
            </div>
        </div>

        <div class="stat-mini-card">
            <div class="mini-icon green-bg"><i class="fas fa-check"></i></div>
            <div>
                <small>Layak</small>
                <h3 class="green-text">
                    {{ collect($data ?? [])->where('status', 'Layak')->count() }}
                </h3>
            </div>
            <span class="badge green-badge">
                {{ count($data ?? []) > 0 ? round((collect($data)->where('status','Layak')->count()/count($data))*100) : 0 }}%
            </span>
        </div>

        <div class="stat-mini-card">
            <div class="mini-icon orange-bg"><i class="fas fa-times"></i></div>
            <div>
                <small>Tidak Layak</small>
                <h3 class="orange-text">
                    {{ collect($data ?? [])->where('status', 'Tidak Layak')->count() }}
                </h3>
            </div>
            <span class="badge orange-badge">
                {{ count($data ?? []) > 0 ? round((collect($data)->where('status','Tidak Layak')->count()/count($data))*100) : 0 }}%
            </span>
        </div>
    </div>

    <!-- Filter -->
    <div class="filter-container">
        <div class="search-wrapper">
            <input type="text" id="searchInput" placeholder="Cari nama / NIK...">
        </div>

        <div class="filter-options">
            <select><option>Semua Status</option></select>
            <select><option>Semua Gender</option></select>
            {{-- tombol reset DIHAPUS --}}
            <span class="results-count">0 hasil ditemukan</span>
        </div>
    </div>

    <!-- Tabel -->
    <div class="table-container">
        <table>
            <thead>
                <tr class="header-red">
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Jenis Kelamin</th>
                    <th>Status Kawin</th>
                    <th>Kewarganegaraan</th>
                    <th>Domisili</th>
                    <th>Status Hidup</th>
                    <th>Hak Pilih</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                </tr>
            </thead>

            <tbody id="tableBody">

                {{-- DATA DINAMIS --}}
                @forelse($data ?? [] as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row['nik'] }}</td>
                    <td><strong>{{ $row['nama'] }}</strong></td>
                    <td>{{ $row['umur'] }}</td>
                    <td>{{ $row['gender'] }}</td>
                    <td>{{ $row['status_kawin'] }}</td>
                    <td>{{ $row['kewarganegaraan'] }}</td>
                    <td>{{ $row['domisili'] }}</td>
                    <td>{{ $row['status_hidup'] }}</td>
                    <td>{{ $row['hak_pilih'] }}</td>
                    <td>
                        @if($row['status'] == 'Layak')
                            <span class="tag-layak">Layak</span>
                        @else
                            <span class="tag-tidak">Tidak Layak</span>
                        @endif
                    </td>
                    <td>{{ $row['keterangan'] }}</td>
                </tr>

                @empty
                <tr>
                    <td colspan="12" style="text-align:center;">Belum ada data</td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

</div>

@endsection

{{-- JS KHUSUS HALAMAN --}}
@push('scripts')
<script src="{{ asset('js/hasil.js') }}"></script>
@endpush
