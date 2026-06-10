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

            <div class="header-right">

                {{-- RESET --}}
                    <button
                        type="button"
                        class="btn-reset1"
                        id="resetTrigger">
                        Reset
                    </button>

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

            <form action="{{ route('penduduk.index') }}"
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
                    {{-- <select name="status">

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

                    </select> --}}

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

                    {{-- tampilkan semua --}}
                    <a href="{{ route('penduduk.index') }}"
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
            <form
                id="resetForm"
                action="{{ route('penduduk.reset') }}"
                method="POST"
                style="display:none;"
            >
                @csrf
                @method('DELETE')
            </form>

        </div>

    </div>

    <!-- RESET MODAL -->
    <div class="delete-modal" id="resetModal">

        <div class="delete-modal-content">

            <div class="delete-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>

            <h3>Reset Semua Data?</h3>

            <p>
                Semua data penduduk akan dihapus permanen dan tidak dapat dikembalikan.
            </p>

            <div class="delete-actions">

                <button
                    type="button"
                    class="btn-cancel-delete"
                    id="cancelReset">
                    Batal
                </button>

                <button
                    type="button"
                    class="btn-confirm-delete"
                    id="confirmReset">
                    Ya, Reset Semua
                </button>

            </div>

        </div>

    </div>

</div>


@endsection

@push('scripts')
<script src="{{ asset('js/import.js') }}"></script>
@endpush
