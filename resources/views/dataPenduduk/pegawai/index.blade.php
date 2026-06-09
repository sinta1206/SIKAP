@extends('layouts.layoutMain')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/import.css') }}">
@endpush

@section('content')

<div class="dataPenduduk-page">
    <div class="container">

        {{-- HEADER --}}
        <header class="page-header">
            <div class="header-left">
                <h1>Data Penduduk</h1>
                <p class="subtitle">
                    Kelola data penduduk desa untuk proses klasifikasi pemilu
                </p>
            </div>

            <div class="header-right">

                {{-- TEMPLATE --}}
                <button class="btn btn-gray">
                    <i class="fas fa-file-csv"></i>
                    Template CSV
                </button>

                {{-- RESET --}}
                <button class="btn btn-gray">
                    Reset Data
                </button>

            </div>
        </header>

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

        {{-- UPLOAD --}}
        <form action="{{ route('penduduk.import') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="upload-area" onclick="document.getElementById('fileInput').click()">
                <div class="upload-icon">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>

                <p>Geser & letakkan file disini, atau klik untuk memilih</p>
                <span>Mendukung format CSV, XLSX, XLS</span>

                <input
                    type="file"
                    id="fileInput"
                    name="file"
                    hidden
                    onchange="this.form.submit()"
                >
            </div>
        </form>

        {{-- INFO --}}
        <div class="info-box">
            <i class="fas fa-circle-info"></i>

            <div class="info-content">
                <p>Format Data Yang Diperlukan</p>

                <div class="tags">
                    <span>NIK</span>
                    <span>Nama</span>
                    <span>Umur</span>
                    <span>Jenis Kelamin</span>
                    <span>Pekerjaan</span>
                    <span>Status Kawin</span>
                    <span>Kewarganegaraan</span>
                    <span>Dusun</span>
                    <span>Status Hidup</span>
                    <span>Hak Pilih</span>
                </div>
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

                        Tampilkan Semua

                    </a>

                    <span class="results-count">

                        {{ $totalData }} hasil ditemukan

                    </span>

                </div>

            </form>

        </div>

{{-- TABLE --}}
<div class="table-container">

        {{-- TABLE --}}
        <div class="table-container">



            <table>

                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Umur</th>
                        <th>Jenis Kelamin</th>
                        <th>Pekerjaan</th>
                        <th>Status Kawin</th>
                        <th>Warganegara</th>
                        <th>Dusun</th>
                        <th>Status Hidup</th>
                        <th>Hak Pilih</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody id="tableBody">

                    @forelse ($data as $index => $penduduk)

                        <tr>

                            <td>{{ $index + 1 }}</td>

                            <td>{{ $penduduk->nik }}</td>

                            <td>
                                <strong>{{ $penduduk->nama }}</strong>
                            </td>

                            <td>{{ $penduduk->umur }}</td>

                            <td class="{{ $penduduk->gender == 'Perempuan' ? 'pink-text' : 'blue-text' }}">
                                {{ $penduduk->gender }}
                            </td>

                            <td>{{ $penduduk->pekerjaan }}</td>

                            <td>{{ $penduduk->status_kawin }}</td>

                            <td>{{ $penduduk->kewarganegaraan }}</td>

                            <td>{{ $penduduk->domisili }}</td>

                            <td>{{ $penduduk->status_hidup }}</td>

                            <td class="{{ $penduduk->hak_pilih == 'Aktif' ? 'active-status' : '' }}">
                                {{ $penduduk->hak_pilih }}
                            </td>

                            <td class="action-buttons">

                                {{-- EDIT --}}
                                 <a href="{{ route('penduduk.edit', $penduduk->id) }}" class="btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- DELETE --}}
                                <form action="{{ route('penduduk.destroy', $penduduk->id) }}"
                                      method="POST"
                                      style="display:inline-block;">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn-delete"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    >
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="12" style="text-align:center;">
                                Data belum tersedia
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/import.js') }}"></script>
@endpush
