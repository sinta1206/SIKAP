@extends('layouts.layoutMain')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/klasifikasi.css') }}">
@endpush

@section('content')

<div class="klasifikasi-page">

  <div class="container">

    <h1>Klasifikasi Pemilu</h1>
    <p class="desc">
      Jalankan proses klasifikasi otomatis berdasarkan kriteria yang telah ditetapkan
    </p>

    <!-- Kriteria -->
    <div class="card">
      <h2>Kriteria Kelayakan Pemilu</h2>
      <p>Penduduk dinyatakan layak memilih apabila memenuhi semua kriteria berikut:</p>

      <div class="item">🎂 Berusia ≥ 17 tahun atau sudah menikah</div>
      <div class="item">🆔 Berstatus WNI</div>
      <div class="item">🏘️ Berdomisili di desa setempat</div>
      <div class="item">💚 Masih hidup</div>
      <div class="item">✅ Hak pilih tidak dicabut</div>

      <div class="note">
        Jika salah satu kriteria tidak terpenuhi, penduduk diklasifikasikan sebagai Tidak Layak Memilih.
      </div>
    </div>

    <!-- Ringkasan -->
    <div class="card">
      <h2>Ringkasan Data</h2>

      <div class="summary">
        <div class="box red">
          <h3>{{ $total ?? 0 }}</h3>
          <p>Total Data</p>
        </div>

        <div class="box green">
          <h3>{{ $layak ?? 0 }}</h3>
          <p>Layak</p>
        </div>

        <div class="box orange">
          <h3>{{ $tidak ?? 0 }}</h3>
          <p>Tidak Layak</p>
        </div>
      </div>
    </div>

    <!-- Mesin -->
    <div class="card">
      <h2>Mesin Klasifikasi</h2>

      @if(auth()->user()->role == 'pegawai_desa')

        <div class="actions">
          <button class="btn-primary" onclick="runKlasifikasi()">Jalankan Klasifikasi</button>
          <button class="btn-outline" onclick="goHasil()">Lihat Hasil</button>
        </div>

      @else

        <div class="alert-success">
          <h3>✔ Klasifikasi Berhasil!</h3>
          <p>
            {{ $layak ?? 0 }} layak,
            {{ $tidak ?? 0 }} tidak layak
          </p>
        </div>

        <div class="alert-info">
          Hanya admin yang bisa menjalankan klasifikasi
        </div>

        <button class="btn-outline" onclick="goHasil()">Lihat Hasil →</button>

      @endif

    </div>

    <!-- Flow -->
    <div class="card">
      <h2>Alur Kerja Klasifikasi</h2>

      <div class="flow">
        <div>📂 Baca Data</div>
        <div>🔍 Validasi</div>
        <div>⚖️ Cek Kriteria</div>
        <div>🏷️ Tentukan Status</div>
        <div>💾 Simpan Hasil</div>
      </div>
    </div>

  </div>

</div>

@endsection

@push('scripts')
<script src="{{ asset('js/klasifikasi.js') }}"></script>
@endpush
