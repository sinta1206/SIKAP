<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIKAP</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @stack('styles')
</head>
<body>

@php
    $user = Auth::user();
    $name = $user->username ?? 'User';
    $role = $user->role ?? 'user';
@endphp

@include('layouts.sidebar')
@include('layouts.navbar')

<!-- CONTENT -->
<div style="margin-left: 320px; margin-top: 75px; padding: 20px;">
    @yield('content')
</div>

<!-- ===================== -->
<!-- MODAL PROFIL -->
<!-- ===================== -->
<div id="profileModal" class="profile-modal">

    <div class="profile-box">

        <div class="profile-header">
            <h3><i class="fas fa-user-circle"></i> Profil Pengguna</h3>
            <span class="close-btn" onclick="closeProfile()">&times;</span>
        </div>

        <!-- TAB -->
        <div class="profile-tabs">
            <button class="tab-btn active" onclick="showTab('username')">Username</button>
            <button class="tab-btn" onclick="showTab('password')">Password</button>
        </div>

        <!-- FORM USERNAME -->
        <form method="POST" action="{{ route('profil.username.update') }}" id="usernameTab" class="profile-form">
            @csrf

            <label>Username</label>
            <input type="text" name="username" value="{{ auth()->user()->username }}"required>
            <button type="submit">Simpan Username</button>
        </form>

        <!-- FORM PASSWORD -->
        <form method="POST" action="{{ route('profil.password.update') }}" id="passwordTab" class="profile-form" style="display:none;">
            @csrf

            <label>Password Lama</label>
            <input type="password" name="password_lama" required>

            <label>Password Baru</label>
            <input type="password" name="password" required>

            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required>

            <button type="submit">Simpan Password</button>
        </form>

    </div>

</div>

<!-- JS -->
<script src="{{ asset('js/sidebar.js') }}"></script>
<script src="{{ asset('js/navbar.js') }}"></script>

@stack('scripts')

<!-- PROFILE SCRIPT -->
<script>
    function openProfile() {
        document.getElementById('profileModal').style.display = 'flex';
    }

    function closeProfile() {
        document.getElementById('profileModal').style.display = 'none';
    }

    function showTab(tab) {

        document.getElementById('usernameTab').style.display =
            (tab === 'username') ? 'block' : 'none';

        document.getElementById('passwordTab').style.display =
            (tab === 'password') ? 'block' : 'none';

        // active button
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));

        if (tab === 'username') {
            document.querySelectorAll('.tab-btn')[0].classList.add('active');
        } else {
            document.querySelectorAll('.tab-btn')[1].classList.add('active');
        }
    }

    // klik luar modal
    window.onclick = function(e) {
        const modal = document.getElementById('profileModal');
        if (e.target === modal) {
            closeProfile();
        }
    }
</script>

</body>
</html>
