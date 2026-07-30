<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Yaguwipa</title>
    <!-- Menghubungkan ke file CSS proyek -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <!-- Mengambil font Poppins agar sama persis seperti di desain -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="login-page">

    <div class="login-wrapper">
        <!-- Logo & Header Atas -->
        <div class="login-header">
            <div class="login-logo">
                <!-- Memanggil gambar logo dari public/images/logo.png -->
                <img src="{{ asset('images/logoyaguwipa.png') }}" alt="Logo Yaguwipa" class="logo-img"> 
                <span>Yaguwipa</span>
            </div>
            <h2>Selamat Datang</h2>
            <p>Masuk untuk melanjutkan kebersihan misi kita.</p>
        </div>

        <!-- Kartu Form Login Putih -->
        <div class="login-card">
            @if(session('success'))
                <div style="background-color: #d1fae5; color: #065f46; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 0.875rem;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                
                <!-- Input field: Email atau Username -->
                <div class="form-group">
                    <label for="username">Email atau Username</label>
                    <div class="input-wrapper">
                        <!-- Ikon Surat (SVG) -->
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <input type="text" id="username" name="username" placeholder="nama@email.com" value="{{ old('username') }}" required>
                    </div>
                    @error('username')
                        <div style="color: #ef4444; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input field: Password -->
                <div class="form-group">
                    <div class="label-row">
                        <label for="password">Password</label>
                        <a href="{{ route('password.request') }}" class="forgot-link">Lupa Password?</a>
                    </div>
                    <div class="input-wrapper">
                        <!-- Ikon Gembok (SVG) -->
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                        <!-- Tombol Lihat Password (Ikon Mata) -->
                        <button type="button" class="toggle-password" aria-label="Lihat Password">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Tombol Submit Masuk -->
                <button type="submit" class="btn-submit">
                    Masuk
                    <!-- Ikon Panah Kanan -->
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
            </form>

            <!-- Garis Pembatas Tengah -->
            <div class="divider">
                <span>ATAU MASUK DENGAN</span>
            </div>

            <!-- Tombol Login OAuth Sosial Media (Hanya Google) -->
            <div class="social-login-grid single-provider">
                <!-- Tombol Google -->
                <a href="#" class="btn-social google">
                    <svg viewBox="0 0 24 24">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    Google
                </a>
            </div>
        </div>
 
        <p class="register-footer">Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a></p>
    </div>

    <script>
        document.querySelector('.toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle visual state of the eye button (optional icon path change or opacity change)
            const icon = this.querySelector('svg');
            if (type === 'text') {
                icon.style.color = 'var(--primary)';
            } else {
                icon.style.color = '#64748b';
            }
        });
    </script>
</body>
</html>