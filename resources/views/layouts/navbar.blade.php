<header class="navbar-container">

    {{-- <div class="nav-content-left">
        <div class="close-btn">
            <i class="fa-solid fa-xmark"></i>
        </div> --}}

        <div class="header-text">
            <h1 class="main-title">Sistem Informasi Klasifikasi Anggota Pemilu</h1>
            <p class="sub-title">
                Desa Maju Bersama ·
                @if($role == 'admin')
                    Admin Panel
                @elseif($role == 'panitia')
                    Panel Panitia
                @endif
            </p>
        </div>
    </div>

    <div class="nav-content-right">
        <button class="logout-action" onclick="handleLogout()">
            <span>Keluar</span>
            <i class="fa-solid fa-right-from-bracket"></i>
        </button>
    </div>

</header>
