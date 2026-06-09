@extends('layouts.layoutMain')

@push('styles')
<style>
    .empty-wrapper {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 40px;
    }

    .empty-box {
        max-width: 500px;
    }

    .empty-icon {
        font-size: 70px;
        color: #ccc;
        margin-bottom: 20px;
    }

    .empty-title {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .empty-text {
        color: #777;
        margin-bottom: 25px;
    }

    .empty-btn {
        display: inline-block;
        padding: 10px 18px;
        background: #2563eb;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        transition: 0.2s;
    }

    .empty-btn:hover {
        background: #1e4fd6;
    }
</style>
@endpush

@section('content')

<div class="empty-wrapper">

    <div class="empty-box">

        <div class="empty-icon">
            <i class="fas fa-folder-open"></i>
        </div>

        <div class="empty-title">
            Belum Ada Data Klasifikasi
        </div>

        <div class="empty-text">
            Data hasil klasifikasi pemilih belum tersedia. Silakan tambahkan atau lakukan proses klasifikasi terlebih dahulu.
        </div>

        {{-- <a href="{{ route('hasil.create') }}" class="empty-btn">
            + Tambah Data
        </a> --}}

        @if(auth()->user()->role == 'pegawai_desa')

            <a href="{{ route('hasil.create') }}" class="empty-btn">
                + Tambah Data
            </a>

        @endif

    </div>

</div>

@endsection
