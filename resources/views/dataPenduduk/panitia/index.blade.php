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
                    Data penduduk yang telah diinput oleh pegawai desa
                </p>
            </div>

        </header>

        {{-- INFO --}}
        <div class="info-box">

            <i class="fas fa-circle-info"></i>

            <div class="info-content">

                <p>Informasi Data Penduduk</p>

                <div class="tags">
                    <span>Total Data: {{ $totalData }}</span>
                    <span>Mode Panitia</span>
                    <span>View Only</span>
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

                        </tr>

                    @empty

                        <tr>

                            <td colspan="11" style="text-align:center;">
                                Data penduduk belum tersedia
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
