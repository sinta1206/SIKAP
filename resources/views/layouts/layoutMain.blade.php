<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIKAP</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

     @stack('styles')

</head>
<body>
    {{-- SIMULASI LOGIN GLOBAL --}}
    @php
        $name = $name ?? session('name') ?? 'Sinta Rahmati';
        $role = $role ?? session('role') ?? 'admin';
    @endphp

    @include('layouts.sidebar')
    @include('layouts.navbar')

    <!-- Content -->
    <div style="margin-left: 320px; margin-top: 75px; padding: 20px;">
        @yield('content')
    </div>

    <!-- JS -->
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="{{ asset('js/navbar.js') }}"></script>

    @stack('scripts')
</body>
</html>
