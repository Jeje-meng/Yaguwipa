<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Yaguwipa</title>
    <!-- Menghubungkan ke file CSS proyek -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <!-- Mengambil font Poppins agar konsisten dengan halaman login -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="login-page">

    <div class="login-wrapper">
        <!-- Logo & Header Atas -->
        <div class="login-header">
            <div class="login-logo">
                <img src="{{ asset('images/logoyaguwipa.png') }}" alt="Logo Yaguwipa" class="logo-img"> 
                <span>Yaguwipa</span>
            </div>
            <h2>Daftar Akun</h2>
            <p>Mulai langkahmu untuk bergabung bersama kami.</p>
        </div>

        <!-- Kartu Form Register Putih -->
        <div class="login-card">
            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                
                <!-- 1. Input field: Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrapper">
                        <!-- Ikon Surat (SVG) -->
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <input type="email" id="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                        <div style="color: #ef4444; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- 2. Input field: Username -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-wrapper">
                        <!-- Ikon Pengguna / User (SVG) -->
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <input type="text" id="username" name="username" placeholder="username_kamu" value="{{ old('username') }}" required>
                    </div>
                    @error('username')
                        <div style="color: #ef4444; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- 3. Input field: Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <!-- Ikon Gembok (SVG) -->
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                    </div>
                    @error('password')
                        <div style="color: #ef4444; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- 4. Input field: Konfirmasi Password -->
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <div class="input-wrapper">
                        <!-- Ikon Centang Gembok / Proteksi Ganda (SVG) -->
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
                    </div>
                </div>

                <!-- Tombol Submit Daftar -->
                <button type="submit" class="btn-submit">
                    Daftar Sekarang
                    <!-- Ikon Panah Kanan -->
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
            </form>
        </div>

        <!-- Teks Tautan Kembali ke Login -->
        <p class="register-footer">Sudah punya akun? <a href="{{ route('login') }}">Masuk Sekarang</a></p>
    </div>

</body>
</html>