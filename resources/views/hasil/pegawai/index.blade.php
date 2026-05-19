@extends('layouts.layoutMain')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/hasil.css') }}">
@endpush

@section('content')

<div class="hasil-page">

    <div class="container">

        {{-- HEADER --}}
        <header class="hasil-header">

            <div class="header-left">

                <h1>Hasil Klasifikasi</h1>

                <p class="subtitle">
                    Data hasil klasifikasi pemilih otomatis
                </p>

            </div>

            <div class="header-right">

                {{-- TAMBAH DATA --}}
                <a href="{{ route('hasil.create') }}"
                   class="btn btn-blue">

                    <i class="fas fa-plus"></i>
                    Tambah Data

                </a>

                {{-- EXPORT CSV --}}
                <a href="{{ route('hasil.export') }}"
                   class="btn btn-green">

                    <i class="fas fa-file-export"></i>
                    Unduh CSV

                </a>

            </div>

        </header>

        {{-- CARD STATISTIK --}}
        <div class="stats-grid">

            {{-- TOTAL --}}
            <div class="stat-mini-card">

                <div class="mini-icon red-bg">
                    <i class="fas fa-database"></i>
                </div>

                <div>
                    <small>Total Data</small>
                    <h3 id="totalStat">
                        {{ $totalData }}
                    </h3>
                </div>

            </div>

            {{-- LAYAK --}}
            <div class="stat-mini-card">

                <div class="mini-icon green-bg">
                    <i class="fas fa-check"></i>
                </div>

                <div>
                    <small>Layak</small>
                    <h3>
                        {{ $layak }}
                    </h3>
                </div>

                <span class="badge green-badge">

                    {{ $totalData > 0 ? round(($layak / $totalData) * 100) : 0 }}%

                </span>

            </div>

            {{-- TIDAK LAYAK --}}
            <div class="stat-mini-card">

                <div class="mini-icon orange-bg">
                    <i class="fas fa-times"></i>
                </div>

                <div>
                    <small>Tidak Layak</small>
                    <h3>
                        {{ $tidakLayak }}
                    </h3>
                </div>

                <span class="badge orange-badge">

                    {{ $totalData > 0 ? round(($tidakLayak / $totalData) * 100) : 0 }}%

                </span>

            </div>

        </div>

        {{-- FILTER --}}
        <div class="filter-container">

            <form action="{{ route('hasil.index') }}"
                  method="GET"
                  class="filter-form">

                {{-- SEARCH --}}
                <div class="search-wrapper">

                    <input
                        type="text"
                        name="search"
                        id="searchInput"
                        placeholder="Cari nama / NIK..."
                        value="{{ request('search') }}"
                    >

                </div>

                <div class="filter-options">

                    {{-- FILTER STATUS --}}
                    <select name="status">

                        <option value="">
                            Semua Status
                        </option>

                        <option value="Layak"
                            {{ request('status') == 'Layak' ? 'selected' : '' }}>

                            Layak

                        </option>

                        <option value="Tidak Layak"
                            {{ request('status') == 'Tidak Layak' ? 'selected' : '' }}>

                            Tidak Layak

                        </option>

                    </select>

                    {{-- FILTER GENDER --}}
                    <select name="gender">

                        <option value="">
                            Semua Gender
                        </option>

                        <option value="Laki-laki"
                            {{ request('gender') == 'Laki-laki' ? 'selected' : '' }}>

                            Laki-laki

                        </option>

                        <option value="Perempuan"
                            {{ request('gender') == 'Perempuan' ? 'selected' : '' }}>

                            Perempuan

                        </option>

                    </select>

                    {{-- BUTTON FILTER --}}
                    <button type="submit"
                            class="btn btn-light">

                        Filter

                    </button>

                    {{-- RESET --}}
                    <a href="{{ route('hasil.index') }}"
                       class="btn-reset">

                        Reset

                    </a>

                    <span class="results-count">

                        {{ $totalData }} hasil ditemukan

                    </span>

                </div>

            </form>

        </div>

        {{-- TABLE --}}
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
                        <th>Hasil</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody id="tableBody">

                    @forelse ($data as $index => $item)

                        <tr>

                            <td>{{ $index + 1 }}</td>

                            <td>{{ $item->nik }}</td>

                            <td>
                                <strong>
                                    {{ $item->nama }}
                                </strong>
                            </td>

                            <td>{{ $item->umur }}</td>

                            {{-- GENDER --}}
                            <td class="{{ $item->gender == 'Perempuan' ? 'pink-text' : 'blue-text' }}">

                                {{ $item->gender }}

                            </td>

                            <td>{{ $item->status_kawin }}</td>

                            <td>{{ $item->kewarganegaraan }}</td>

                            <td>{{ $item->domisili }}</td>

                            <td>{{ $item->status_hidup }}</td>

                            {{-- HASIL --}}
                            <td>

                                @if($item->hak_pilih == 'Layak')

                                    <span class="tag-layak">
                                        Layak
                                    </span>

                                @else

                                    <span class="tag-tidak">
                                        Tidak Layak
                                    </span>

                                @endif

                            </td>

                            {{-- KETERANGAN --}}
                            <td>

                                {{ $item->keterangan }}

                            </td>

                            {{-- AKSI --}}
                            <td>

                                <div class="action-buttons">

                                    {{-- EDIT --}}
                                    <a href="{{ route('hasil.edit', $item->id) }}"
                                       class="btn-edit">

                                        <i class="fas fa-pen"></i>

                                    </a>

                                </div>

                            </td>

                        </tr>

                    {{-- @empty

                        <tr>

                            <td colspan="12"
                                style="text-align:center;">

                                Data hasil klasifikasi belum tersedia

                            </td>

                        </tr>

                    @endforelse --}}

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script src="{{ asset('js/hasil.js') }}"></script>
@endpush
