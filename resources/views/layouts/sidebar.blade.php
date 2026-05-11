<div class="sidebar">

    <!-- Brand -->
    <div class="brand-section">
        <div class="logo-container">
            <i class="fa-solid fa-check-square"></i>
        </div>
        <div class="brand-text">
            <h1>SIKAP</h1>
            <p>Sistem Informasi Klasifikasi Pemilu</p>
        </div>
    </div>

    <!-- Lokasi -->
    <div class="location-section">
        <i class="fa-solid fa-location-dot"></i>
        <div class="location-text">
            <h2>Desa Maju Bersama</h2>
            <p>Kecamatan Sejahtera</p>
        </div>
    </div>

    <!-- Menu -->
    <nav class="nav-menu">

        <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-table-columns"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ url('/import') }}" class="nav-item {{ request()->is('import') ? 'active' : '' }}">
            <i class="fa-solid fa-upload"></i>
            <span>Data Penduduk</span>
        </a>

        <a href="{{ route('klasifikasi.index') }}" class="nav-item {{ request()->routeIs('klasifikasi.index') ? 'active' : '' }}">
            <i class="fa-solid fa-microchip"></i>
            <span>Klasifikasi Pemilu</span>
        </a>

        <a href="{{ route('hasil.index') }}" class="nav-item {{ request()->routeIs('hasil.index') ? 'active' : '' }}">
            <i class="fa-solid fa-clipboard-list"></i>
            <span>Hasil Klasifikasi</span>
        </a>

    </nav>

    <!-- Profile -->
    <div class="profile-card">
        <div class="avatar">
            <i class="fa-solid fa-user"></i>
        </div>
        <div class="profile-info">
            <h3>{{ auth()->user()->name }}</h3>
            <p>
                @if(auth()->user()->role == 'pegawai_desa')
                    Pegawai Desa
                @elseif(auth()->user()->role == 'panitia_pemilu')
                    Panitia Pemilu
                @else
                    Pegawai
                @endif
            </p>
        </div>
    </div>

    <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="logout-btn">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
        <span>Keluar</span>
    </button>
    </form>

</div>
