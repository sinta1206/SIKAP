<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIKAP</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

    <div class="login-container">
        <div class="login-card">
            <h1>Selamat Datang</h1>
            <p class="subtitle">Masuk ke sistem untuk melanjutkan</p>

            @if ($errors->any())
                <div style="color: red; margin-bottom: 15px; font-size: 14px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.process') }}" method="POST">
             @csrf

                <div class="input-group">
                    <label for="username">Username:</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" id="username" placeholder="Masukkan username" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="password">Password:</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="password" placeholder="Masukkan password" required>
                    </div>
                </div>

    <button type="submit" class="btn-login">Masuk</button>
</form>
        </div>
    </div>

    <script src="{{ asset('js/login.js') }}"></script>

</body>
</html>
