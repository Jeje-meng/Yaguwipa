<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Yaguwipa</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="login-page">

    <div class="login-wrapper">
        <div class="login-header">
            <div class="login-logo">
                <img src="{{ asset('images/logoyaguwipa.png') }}" alt="Logo Yaguwipa" class="logo-img"> 
                <span>Yaguwipa</span>
            </div>
            <h2>Lupa Password Anda?</h2>
            <p>Masukkan alamat email Anda untuk menerima tautan penyetelan ulang password.</p>
        </div>

        <div class="login-card">
            @if(session('success'))
                <div style="background-color: #d1fae5; color: #065f46; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 0.875rem; line-height: 1.5; text-align: center;">
                    <strong>Berhasil!</strong> {{ session('success') }}
                    
                    @if(session('reset_link_helper'))
                        <div style="margin-top: 15px; border-top: 1px solid #a7f3d0; padding-top: 15px;">
                            <p style="margin-bottom: 10px; font-size: 0.8rem; color: #065f46;"><strong>[MODE PENGEMBANGAN]</strong> Klik tombol di bawah ini untuk mereset password secara langsung:</p>
                            <a href="{{ session('reset_link_helper') }}" class="btn-submit" style="text-decoration: none; display: inline-flex; width: auto; padding: 10px 20px; font-size: 0.85rem; margin-top: 5px; background-color: #059669; justify-content: center; box-shadow: none;">
                                🔑 Reset Password Sekarang
                            </a>
                        </div>
                    @endif
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="email">Alamat Email Terdaftar</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <input type="email" id="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                    </div>
                    @error('email')
                        <div style="color: #ef4444; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">
                    Kirim Link Reset
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
            </form>
        </div>
 
        <p class="register-footer"><a href="{{ route('login') }}" style="color: #64748b; text-decoration: none; font-weight: 600;">← Kembali ke Halaman Login</a></p>
    </div>

</body>
</html>
