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

                {{-- <a href="{{ route('penduduk.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Data
                </a> --}}

                <a href="{{ route('penduduk.create') }}" class="btn-add-data">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Data</span>
                </a>

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

    {{-- INFO FORMAT IMPORT --}}
    <div class="info-box">

        <i class="fas fa-circle-info"></i>

        <div class="info-content">

            <p>Format Data Import yang Diperlukan</p>

            <p class="info-hint">
                Klik salah satu kolom untuk melihat format data dan nilai yang valid sebelum melakukan import file Excel atau CSV.
            </p>

            <div class="tags">

                <span class="info-tag" onclick="toggleInfo('nik')">NIK</span>

                <span class="info-tag" onclick="toggleInfo('nama')">Nama</span>

                <span class="info-tag" onclick="toggleInfo('umur')">Umur</span>

                <span class="info-tag" onclick="toggleInfo('jk')">
                    Jenis Kelamin
                </span>

                <span class="info-tag" onclick="toggleInfo('pekerjaan')">
                    Pekerjaan
                </span>

                <span class="info-tag" onclick="toggleInfo('kawin')">
                    Status Kawin
                </span>

                <span class="info-tag" onclick="toggleInfo('wn')">
                    Kewarganegaraan
                </span>

                <span class="info-tag" onclick="toggleInfo('dusun')">
                    Dusun
                </span>

                <span class="info-tag" onclick="toggleInfo('hidup')">
                    Status Hidup
                </span>

                <span class="info-tag" onclick="toggleInfo('hak')">
                    Hak Pilih
                </span>

            </div>

            {{-- DETAIL INFO --}}

            <div id="nik" class="detail-box">
                <button class="close-detail"
                        onclick="closeInfo('nik')">
                    ✕ Tutup
                </button>
                <strong>NIK</strong>
                <p>Harus terdiri dari tepat 16 digit angka.</p>
                <small>Contoh: 1171080917050001</small>
            </div>

            <div id="nama" class="detail-box">
                <button class="close-detail"
                        onclick="closeInfo('nama')">
                    ✕ Tutup
                </button>
                <strong>Nama</strong>
                <p>Nama lengkap penduduk.</p>
                <small>Contoh: Siti Aisyah</small>
            </div>

            <div id="umur" class="detail-box">
                <button class="close-detail"
                        onclick="closeInfo('umur')">
                    ✕ Tutup
                </button>
                <strong>Umur</strong>
                <p>Diisi dalam bentuk angka tanpa satuan tahun.</p>
                <small>Contoh: 25</small>
            </div>

            <div id="jk" class="detail-box">
                <button class="close-detail"
                        onclick="closeInfo('jk')">
                    ✕ Tutup
                </button>
                <strong>Jenis Kelamin</strong>
                <p>Hanya boleh:</p>
                <small>Laki-laki atau Perempuan</small>
            </div>

            <div id="pekerjaan" class="detail-box">
                <button class="close-detail"
                        onclick="closeInfo('pekerjaan')">
                    ✕ Tutup
                </button>
                <strong>Pekerjaan</strong>
                <p>Isi sesuai pekerjaan penduduk.</p>
                <small>Contoh: Petani, Guru, Buruh, Pedagang</small>
            </div>

            <div id="kawin" class="detail-box">
                <button class="close-detail"
                        onclick="closeInfo('kawin')">
                    ✕ Tutup
                </button>
                <strong>Status Kawin</strong>
                <p>Hanya boleh:</p>
                <small>
                    Belum Menikah / Sudah Menikah / Cerai
                </small>
            </div>

            <div id="wn" class="detail-box">
                <button class="close-detail"
                        onclick="closeInfo('wn')">
                    ✕ Tutup
                </button>
                <strong>Kewarganegaraan</strong>
                <p>Hanya boleh:</p>
                <small>WNI atau WNA</small>
            </div>

            <div id="dusun" class="detail-box">
                <button class="close-detail"
                        onclick="closeInfo('dusun')">
                    ✕ Tutup
                </button>
                <strong>Dusun</strong>
                <p>Nama dusun tempat domisili penduduk.</p>
                <small>Contoh: Dusun Mawar</small>
            </div>

            <div id="hidup" class="detail-box">
                <button class="close-detail"
                        onclick="closeInfo('hidup')">
                    ✕ Tutup
                </button>
                <strong>Status Hidup</strong>
                <p>Hanya boleh:</p>
                <small>Hidup atau Meninggal</small>
            </div>

            <div id="hak" class="detail-box">
                <button class="close-detail"
                        onclick="closeInfo('hak')">
                    ✕ Tutup
                </button>
                <strong>Hak Pilih</strong>
                <p>Hanya boleh:</p>
                <small>
                    Aktif / Non Aktif / Dicabut
                </small>
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

                    {{-- RESET --}}
                    <button
                        type="button"
                        class="btn-reset"
                        id="resetTrigger">
                        Reset
                    </button>

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
                        <th>Kewarganegara</th>
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
                                        class="btn-delete delete-trigger"
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
    <!-- DELETE MODAL -->
    <div class="delete-modal" id="deleteModal">

        <div class="delete-modal-content">

            <div class="delete-icon">
                <i class="fas fa-trash-alt"></i>
            </div>

            <h3>Hapus Data?</h3>

            <p>
                Data yang dihapus tidak dapat dikembalikan lagi.
            </p>

            <div class="delete-actions">

                <button
                    type="button"
                    class="btn-cancel-delete"
                    id="cancelDelete"
                >
                    Batal
                </button>

                <button
                    type="button"
                    class="btn-confirm-delete"
                    id="confirmDelete"
                >
                    Ya, Hapus
                </button>

            </div>

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
