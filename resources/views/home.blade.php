@extends('layouts.app')

@section('content')

<!-- ================= HERO ================= -->
<section id="beranda" class="hero" style="background-image: url('{{ asset('images/' . $hero_image) }}');">

    <div class="hero-overlay"></div>

    <div class="container hero-content">

        <div class="hero-text animate-hero-text">

            <h1>
                SELAMAT <span>DATANG DI</span><br>
                <span>YAYASAN GUNA WIDYA</span><br>
                PARAMESTHI
            </h1>

            <p>
                {!! nl2br(e($hero_subtitle)) !!}
            </p>

            <div class="hero-actions">
                <a href="#" class="btn-donasi">
                    Donasi Sekarang
                </a>
            </div>

        </div>

        <div class="hero-image animate-hero-image">
            <div class="hero-image-container">
                <img src="{{ asset('images/logoyaguwipa.png') }}" alt="Logo Yayasan">
            </div>
        </div>

    </div>

</section>
<!-- ================= ABOUT ================= -->

<section id="tentang_kami" class="about">

    <div class="container">

        <!-- Judul -->
        <div class="about-title animate-on-scroll">
            <span class="badge">Tentang Kami</span>
            <h2>Yayasan Guna Widya Paramesthi</h2>
        </div>

        <!-- Card -->
        <div class="about-right">

            <div class="card card-visi animate-on-scroll delay-1">
                <h3>
                    <div class="card-icon-wrapper">
                        @if($visi_logo && file_exists(public_path('images/' . $visi_logo)))
                            <img src="{{ asset('images/' . $visi_logo) }}" alt="Visi">
                        @else
                            <img src="{{ asset('images/visi.png') }}" alt="Visi">
                        @endif
                    </div>
                    <span>VISI</span>
                </h3>
                <p>
                    {!! nl2br(e($visi)) !!}
                </p>
            </div>

            <div class="card card-misi animate-on-scroll delay-2">
                <h3>
                    <div class="card-icon-wrapper">
                        @if($misi_logo && file_exists(public_path('images/' . $misi_logo)))
                            <img src="{{ asset('images/' . $misi_logo) }}" alt="Misi">
                        @else
                            <img src="{{ asset('images/misi.png') }}" alt="Misi">
                        @endif
                    </div>
                    <span>MISI</span>
                </h3>
                <p>
                    {!! nl2br(e($misi)) !!}
                </p>
            </div>

            <div class="card card-tujuan animate-on-scroll delay-3">
                <h3>
                    @if($tujuan_logo && file_exists(public_path('images/' . $tujuan_logo)))
                        <div class="card-icon-wrapper">
                            <img src="{{ asset('images/' . $tujuan_logo) }}" alt="Tujuan">
                        </div>
                    @else
                        <div class="card-icon-wrapper text-icon" style="display: flex; align-items: center; justify-content: center; color: var(--primary);">
                            <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <circle cx="12" cy="12" r="6"></circle>
                                <circle cx="12" cy="12" r="2"></circle>
                            </svg>
                        </div>
                    @endif
                    <span>TUJUAN</span>
                </h3>
                <p>
                    {!! nl2br(e($tujuan)) !!}
                </p>
            </div>

            <div class="card card-logo animate-on-scroll delay-4">
                <h3>
                    @if($arti_logo_logo && file_exists(public_path('images/' . $arti_logo_logo)))
                        <div class="card-icon-wrapper">
                            <img src="{{ asset('images/' . $arti_logo_logo) }}" alt="Arti Logo">
                        </div>
                    @else
                        <div class="card-icon-wrapper text-icon" style="display: flex; align-items: center; justify-content: center; color: #6366f1;">
                            <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"></path>
                            </svg>
                        </div>
                    @endif
                    <span>ARTI LOGO</span>
                </h3>
                <p>
                    {!! nl2br(e($arti_logo)) !!}
                </p>
            </div>

        </div>

    </div>

</section>

<!-- ================= LEMBAGA TERKAIT ================= -->
<section id="lembaga_terkait" class="partner">
    <div class="container">
        <div class="section-title animate-on-scroll">
            <span class="section-badge">Partner Terkait</span>
            <h2>Partner Terkait</h2>
            <p style="margin-bottom: 20px;">
                Berkolaborasi dengan berbagai institusi terkemuka untuk menciptakan dampak sosial yang berkelanjutan and memperluas jangkauan program pendidikan dan kemanusiaan kami.
            </p>
            @auth
                @if(Auth::user()->role !== 'admin')
                    <div>
                        <a href="{{ route('partner.index') }}" class="nav-btn nav-btn-primary" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none; padding: 10px 25px; border-radius: var(--radius-sm); font-size: 0.9rem; font-weight: 600;">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; vertical-align: middle;">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            Kelola & Ajukan Partner Saya
                        </a>
                    </div>
                @endif
            @else
                <div>
                    <a href="{{ route('login') }}" class="nav-btn nav-btn-primary" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none; padding: 10px 25px; border-radius: var(--radius-sm); font-size: 0.9rem; font-weight: 600;">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; vertical-align: middle;">
                            <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path>
                        </svg>
                        Masuk untuk Menjadi Partner
                    </a>
                </div>
            @endauth
        </div>

        <div class="partner-grid">
            @forelse($partners as $idx => $p)
                <div class="partner-card animate-on-scroll delay-{{ ($idx % 4) + 1 }}">
                    <div class="partner-logo-wrapper" style="display: flex; align-items: center; justify-content: center; overflow: hidden; background: #fff; padding: 10px; border-radius: var(--radius-sm); width: 120px; height: 80px; margin: 0 auto 12px auto; border: 1px solid #f1f5f9;">
                        @if($p->logo)
                            <img src="{{ file_exists(public_path('partner/' . $p->logo)) ? asset('partner/' . $p->logo) : asset('images/' . $p->logo) }}" alt="{{ $p->nama_partner }}" style="max-height: 65px; max-width: 100%; object-fit: contain;">
                        @else
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 40px; height: 40px; color: var(--primary);">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                            </svg>
                        @endif
                    </div>
                    <h4>{{ $p->nama_partner }}</h4>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; color: var(--text-muted); font-size: 0.95rem; padding: 20px;">
                    Belum ada partner resmi saat ini.
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ================= GALERI ================= -->
<section id="galeri" class="gallery">
    <div class="container">
        <div class="gallery-header-row animate-on-scroll">
            <div class="gallery-title-wrapper">
                <span class="section-badge">Galeri</span>
                <h2>Galeri Kegiatan</h2>
            </div>
            <a href="{{ route('gallery') }}" class="lihat-semua">
                Lihat Semua <span>→</span>
            </a>
        </div>
        <p class="gallery-subtitle animate-on-scroll delay-1">
            Dokumentasi berbagai kegiatan Yayasan Guna Widya Paramesthi dalam bidang pendidikan, sosial, kemanusiaan, dan pengembangan SDM.
        </p>

        <div class="gallery-grid">
            @forelse($galleries as $idx => $g)
                @php
                    $class = '';
                    if ($idx === 0) $class = 'large';
                    elseif ($idx === 1) $class = 'tall';
                @endphp
                <div class="gallery-item {{ $class }} animate-on-scroll delay-{{ ($idx % 3) + 1 }}">
                    <img src="{{ file_exists(public_path('gallery/' . $g->gambar)) ? asset('gallery/' . $g->gambar) : asset('images/' . $g->gambar) }}" alt="{{ $g->judul }}">
                    <div class="overlay">
                        <span>Kegiatan</span>
                        <h3>{{ $g->judul }}</h3>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; color: var(--text-muted); font-size: 0.95rem; padding: 20px;">
                    Belum ada dokumentasi galeri saat ini.
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- News -->
<section class="news" id="berita">

    <div class="container">

        <div class="news-header animate-on-scroll">

            <div>

                <span class="section-badge">
                    Berita
                </span>

                <h2>Berita Terbaru</h2>

            </div>

            <a href="{{ route('berita') }}" class="lihat-semua">
                Lihat Lebih Banyak Berita
                <span>→</span>
            </a>

        </div>

        <p class="news-subtitle animate-on-scroll delay-1">
            Ikuti perkembangan terbaru kegiatan Yayasan Guna Widya Paramesthi.
        </p>

        <div class="news-grid">
            @forelse($beritas as $idx => $b)
                <div class="news-card animate-on-scroll delay-{{ ($idx % 3) + 1 }}">
                    <img src="{{ file_exists(public_path('news/' . $b->gambar_berita)) ? asset('news/' . $b->gambar_berita) : asset('images/' . $b->gambar_berita) }}" alt="{{ $b->judul }}" style="height: 200px; width: 100%; object-fit: cover;">
                    <div class="news-content">
                        <span>{{ $b->created_at ? $b->created_at->format('d M Y') : 'Berita' }}</span>
                        <h3>{{ $b->judul }}</h3>
                        <p>{{ Str::limit(strip_tags($b->body), 80) }}</p>
                        <a href="{{ route('berita.show', $b->slug) }}">Detail →</a>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; color: var(--text-muted); font-size: 0.95rem; padding: 20px;">
                    Belum ada berita terbaru saat ini.
                </div>
            @endforelse
        </div>

    </div>

</section>

<section class="agenda-page" id="agenda">
    <div class="container">

        <div class="agenda-header animate-on-scroll">
            <div>
                <span class="badge">AGENDA</span>
                <h1>Agenda Yayasan</h1>
                <p>
                    Ikuti berbagai kegiatan, seminar, pelatihan, dan program
                    Yayasan Guna Widya Paramesthi.
                </p>
            </div>
        </div>

        @forelse($agendas as $idx => $a)
            @php
                $colors = ['blue', 'gray', 'purple', 'green', 'orange'];
                $color = $colors[$idx % 5];
                $dateObj = \Carbon\Carbon::parse($a->tanggal);
                $dateEndObj = $a->tanggal_akhir ? \Carbon\Carbon::parse($a->tanggal_akhir) : null;
                $isRange = $dateEndObj && !$dateEndObj->isSameDay($dateObj);
            @endphp
            <div class="agenda-card animate-on-scroll delay-{{ ($idx % 3) + 1 }}">
                <div class="agenda-date {{ $color }}">
                    @if($isRange)
                        @if($dateObj->format('m') === $dateEndObj->format('m'))
                            <span style="font-size: 0.75rem;">{{ strtoupper($dateObj->format('M')) }}</span>
                            <h2 style="font-size: 1.3rem; white-space: nowrap;">{{ $dateObj->format('d') }}-{{ $dateEndObj->format('d') }}</h2>
                        @else
                            <span style="font-size: 0.65rem; white-space: nowrap;">{{ strtoupper($dateObj->format('M')) }}-{{ strtoupper($dateEndObj->format('M')) }}</span>
                            <h2 style="font-size: 1.3rem; white-space: nowrap;">{{ $dateObj->format('d') }}-{{ $dateEndObj->format('d') }}</h2>
                        @endif
                    @else
                        <span>{{ strtoupper($dateObj->format('M')) }}</span>
                        <h2>{{ $dateObj->format('d') }}</h2>
                    @endif
                </div>
                <div class="agenda-info">
                    <h3><a href="{{ route('agenda.show', $a->id) }}" style="color: inherit; text-decoration: none; transition: var(--transition-fast);" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='inherit'">{{ $a->judul }}</a></h3>
                    <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 5px; margin-bottom: 5px;">{{ $a->deskripsi }}</p>
                    <div class="agenda-detail">
                        @if($isRange)
                            <span style="display: inline-flex; align-items: center; gap: 4px; vertical-align: middle; margin-right: 12px;">
                                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; vertical-align: middle; margin-top: -2px;">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                {{ $dateObj->format('d M Y') }} - {{ $dateEndObj->format('d M Y') }}
                            </span>
                        @else
                            <span style="display: inline-flex; align-items: center; gap: 4px; vertical-align: middle; margin-right: 12px;">
                                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; vertical-align: middle; margin-top: -2px;">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                {{ $dateObj->format('d M Y') }}
                            </span>
                        @endif
                        <span style="display: inline-flex; align-items: center; gap: 4px; vertical-align: middle; margin-right: 12px;">
                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; vertical-align: middle; margin-top: -2px;">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            09.00 WIB - Selesai
                        </span>
                        <span style="display: inline-flex; align-items: center; gap: 4px; vertical-align: middle;">
                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; vertical-align: middle; margin-top: -2px;">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            {{ $a->lokasi }}
                        </span>
                    </div>
                </div>
                <a href="{{ route('agenda.show', $a->id) }}" class="agenda-button">
                    Detail
                </a>
            </div>
        @empty
            <div style="text-align: center; color: var(--text-muted); font-size: 0.95rem; padding: 30px;">
                Belum ada agenda terdekat saat ini.
            </div>
        @endforelse

    </div>
</section>


<!-- ================= DONASI ================= -->
<section id="donasi" class="donation-section">
    <div class="container">
        
        <!-- Bagian Atas: Banner Info -->
        <div class="donation-hero animate-on-scroll">
            <div class="donation-hero-text">
                <span class="badge-kebaikan">Mulai Berbagi Kebaikan</span>
                <h1>Kontribusi Anda,<br><span class="text-blue">Harapan Mereka</span></h1>
                <p>
                    Setiap donasi yang Anda berikan, baik berupa dana maupun barang, adalah langkah nyata untuk menciptakan perubahan positif. Bersama, kita wujudkan transparansi radikal dan kasih sayang aktif.
                </p>
                <div class="secure-badge" style="display: inline-flex; align-items: center; gap: 6px; color: #27ae60; font-weight: 600; font-size: 14px;">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; color: #27ae60; vertical-align: middle;">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                    Donasi Aman dan Terpercaya
                </div>
            </div>
            <div class="donation-hero-image">
                <img src="{{ asset('images/foto_cg.jpeg') }}" alt="Berbagi Kebahagiaan Yaguwipa">
            </div>
        </div>

        <!-- Bagian Bawah: Grid Form & Dampak Nyata -->
        <div class="donation-grid">
            
            <!-- SISI KIRI: FORM CONTAINER -->
            <div class="donation-form-container animate-on-scroll">
                @if(session('success'))
                    <div style="background-color: #d1fae5; color: #065f46; padding: 15px; border-radius: var(--radius-md); margin-bottom: 20px; font-size: 0.9rem; font-weight: 500;">
                        ✓ {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div style="background-color: #fee2e2; color: #991b1b; padding: 15px; border-radius: var(--radius-md); margin-bottom: 20px; font-size: 0.9rem; font-weight: 500;">
                        ✗ {{ $errors->first() }}
                    </div>
                @endif

                @guest
                    <div class="donation-login-warning" style="text-align: center; padding: 40px 20px; background: #ffffff; border-radius: var(--radius-md); box-shadow: var(--shadow-md); border: 1px solid var(--accent-light); display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--primary); margin-bottom: 15px; flex-shrink: 0;">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <h3 style="font-weight: 600; margin-bottom: 10px; color: var(--text-primary);">Mulai Kebaikan Anda</h3>
                        <p style="color: var(--text-muted); margin-bottom: 20px; font-size: 0.9rem; line-height: 1.5;">Untuk mengirimkan donasi uang atau sumbangan barang, silakan masuk ke akun Anda terlebih dahulu.</p>
                        <a href="{{ route('login') }}" class="btn-submit-donation-main" style="display: inline-block; text-decoration: none; text-align: center; padding: 12px 30px; font-weight: 600;">Masuk Sekarang</a>
                    </div>
                @else
                    @if(request()->has('agenda_id'))
                        @php
                            $targetAgenda = \App\Models\Agenda::find(request('agenda_id'));
                        @endphp
                        @if($targetAgenda)
                            <div style="background-color: #fef3c7; border: 1px solid #f59e0b; color: #b45309; padding: 15px; border-radius: var(--radius-md); margin-bottom: 20px; font-size: 0.88rem; display: flex; align-items: center; gap: 10px; text-align: left; line-height: 1.5;">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="16" x2="12" y2="12"></line>
                                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                </svg>
                                <div>
                                    Anda sedang melakukan donasi untuk agenda: <strong>{{ $targetAgenda->judul }}</strong>. Keikutsertaan Anda akan tercatat secara otomatis setelah donasi disetujui admin.
                                </div>
                            </div>
                        @endif
                    @endif

                    <!-- Tab Switcher -->
                    <div class="tab-switcher">
                        <button class="tab-btn active" onclick="switchForm('uang')">Donasi Uang</button>
                        <button class="tab-btn" onclick="switchForm('barang')">Sumbangan Barang</button>
                    </div>

                    <!-- FORM 1: DONASI UANG (Tampil secara default) -->
                    <form id="form-donasi-uang" action="{{ route('donasi.uang.submit') }}" method="POST" class="donation-form">
                        @csrf
                        @if(request()->has('agenda_id'))
                            <input type="hidden" name="agenda_id" value="{{ request('agenda_id') }}">
                        @endif
                        <div class="form-group">
                            <label class="form-label">Frekuensi Donasi</label>
                            <div class="radio-toggle-group">
                                <label class="toggle-option">
                                    <input type="radio" name="frekuensi" value="sekali" checked>
                                    <span>Sekali</span>
                                </label>
                                <label class="toggle-option">
                                    <input type="radio" name="frekuensi" value="rutin">
                                    <span>Rutin Bulanan</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Pilih Nominal</label>
                            <div class="nominal-grid">
                                <label class="nominal-option">
                                    <input type="radio" name="nominal" value="50000" checked>
                                    <span>Rp 50K</span>
                                </label>
                                <label class="nominal-option">
                                    <input type="radio" name="nominal" value="100000">
                                    <span>Rp 100K</span>
                                </label>
                                <label class="nominal-option">
                                    <input type="radio" name="nominal" value="250000">
                                    <span>Rp 250K</span>
                                </label>
                                <label class="nominal-option">
                                    <input type="radio" name="nominal" value="500000">
                                    <span>Rp 500K</span>
                                </label>
                            </div>
                            <div class="custom-nominal-wrapper">
                                <span class="currency-prefix">Rp</span>
                                <input type="number" name="custom_nominal" placeholder="Nominal Lainnya" class="form-control-custom">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Metode Pembayaran</label>
                            <div class="payment-grid">
                                <label class="payment-option">
                                    <input type="radio" name="payment_method" value="qris" checked>
                                    <div class="payment-card-content" style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                                            <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
                                            <line x1="12" y1="18" x2="12.01" y2="18"></line>
                                        </svg>
                                        <span>QRIS</span>
                                    </div>
                                </label>
                                <label class="payment-option">
                                    <input type="radio" name="payment_method" value="bank_transfer">
                                    <div class="payment-card-content" style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                                            <path d="M3 22h18"></path>
                                            <path d="M6 22V9M10 22V9M14 22V9M18 22V9"></path>
                                            <path d="M3 9h18L12 2 3 9z"></path>
                                        </svg>
                                        <span>BANK TRANSFER</span>
                                    </div>
                                </label>
                                <label class="payment-option">
                                    <input type="radio" name="payment_method" value="e_wallet">
                                    <div class="payment-card-content" style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                            <line x1="1" y1="10" x2="23" y2="10"></line>
                                        </svg>
                                        <span>E-WALLET</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn-submit-donation-main">Lanjutkan Pembayaran</button>
                    </form>

                    <!-- FORM 2: SUMBANGAN BARANG (Sembunyikan via CSS/JS secara default) -->
                    <form id="form-donasi-barang" action="{{ route('donasi.barang.submit') }}" method="POST" enctype="multipart/form-data" class="donation-form d-none">
                        @csrf
                        @if(request()->has('agenda_id'))
                            <input type="hidden" name="agenda_id" value="{{ request('agenda_id') }}">
                        @endif
                        <div class="form-group">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" placeholder="Masukkan nama barang (contoh: Buku Pelajaran, Pakaian)" class="form-control-input" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Jumlah Barang</label>
                            <input type="number" name="jumlah_barang" placeholder="Jumlah barang (contoh: 15)" class="form-control-input" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Foto Barang</label>
                            <div class="file-upload-wrapper">
                                <input type="file" name="foto_barang" accept="image/*" class="form-control-file" required>
                                <div class="upload-placeholder" style="display: flex; align-items: center; gap: 8px; justify-content: center;">
                                    <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; vertical-align: middle;">
                                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                        <circle cx="12" cy="13" r="4"></circle>
                                    </svg>
                                    <span>Upload Foto Barang Di Sini</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" style="margin-bottom: 12px; display: block;">Dikirim Kemana (Pilih Lokasi Tujuan di Map)</label>
                            <input type="hidden" name="tujuan_lembaga" id="tujuan_lembaga" value="{{ $donasi_nama_1 }}" required>
                            
                            <!-- Location Option Tabs -->
                            <div class="map-location-tabs" style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 15px; width: 100%;">
                                <button type="button" class="map-tab active" onclick="changeMapDestination('{{ addslashes($donasi_nama_1) }}', '{{ $donasi_map_1 }}', this)" style="display: flex; align-items: center; gap: 10px; width: 100%; padding: 12px 16px; border-radius: var(--radius-sm); border: 2px solid var(--primary); background: #f0f4ff; color: var(--primary); font-weight: 600; text-align: left; cursor: pointer; transition: all 0.2s ease; font-family: inherit;">
                                    @if(Str::contains(strtolower($donasi_nama_1), 'indoapps'))
                                        <img src="{{ asset('images/logo_indoapps.png') }}" alt="Logo IndoApps" style="height: 20px; width: auto; object-fit: contain;">
                                    @else
                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 4px; flex-shrink: 0; vertical-align: middle;">
                                            <path d="M22 10v6M2 10l10-5 10 5M2 10v6M12 5v17M4 17h16M7 22v-5M17 22v-5"></path>
                                        </svg>
                                    @endif
                                    {{ $donasi_nama_1 }}
                                </button>
                                <button type="button" class="map-tab" onclick="changeMapDestination('{{ addslashes($donasi_nama_2) }}', '{{ $donasi_map_2 }}', this)" style="display: inline-flex; align-items: center; gap: 10px; width: 100%; padding: 12px 16px; border-radius: var(--radius-sm); border: 1px solid #d1d5db; background: #ffffff; color: var(--text-dark); font-weight: 500; text-align: left; cursor: pointer; transition: all 0.2s ease; font-family: inherit;">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 4px; flex-shrink: 0; vertical-align: middle;">
                                        <rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect>
                                        <line x1="9" y1="22" x2="9" y2="16"></line>
                                        <line x1="15" y1="22" x2="15" y2="16"></line>
                                        <line x1="9" y1="16" x2="15" y2="16"></line>
                                        <path d="M8 6h2M14 6h2M8 10h2M14 10h2"></path>
                                    </svg>
                                    {{ $donasi_nama_2 }}
                                </button>
                                <button type="button" class="map-tab" onclick="changeMapDestination('{{ addslashes($donasi_nama_3) }}', '{{ $donasi_map_3 }}', this)" style="display: inline-flex; align-items: center; gap: 10px; width: 100%; padding: 12px 16px; border-radius: var(--radius-sm); border: 1px solid #d1d5db; background: #ffffff; color: var(--text-dark); font-weight: 500; text-align: left; cursor: pointer; transition: all 0.2s ease; font-family: inherit;">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 4px; flex-shrink: 0; vertical-align: middle;">
                                        <path d="M4 20V10a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"></path>
                                        <path d="M9 6V4a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2"></path>
                                        <path d="M8 22V12h8v10"></path>
                                    </svg>
                                    {{ $donasi_nama_3 }}
                                </button>
                            </div>
                            
                            <!-- The single Google Maps container -->
                            <div class="single-map-container" style="border: 1px solid #d1d5db; border-radius: 14px; overflow: hidden; background: #ffffff; padding: 6px; box-shadow: var(--shadow-sm); width: 100%; min-height: 232px; display: flex; flex-direction: column; justify-content: center;">
                                
                                <iframe 
                                    id="single_donation_map"
                                    src="{{ $donasi_map_1 }}" 
                                    width="100%" 
                                    height="220" 
                                    style="border:0; border-radius: 10px; display: {{ (Str::contains($donasi_map_1, 'maps/embed') || Str::contains($donasi_map_1, 'embed?pb') || Str::contains($donasi_map_1, 'maps/d/embed')) ? 'block' : 'none' }};" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>

                                <div id="map_link_fallback" style="display: {{ (Str::contains($donasi_map_1, 'maps/embed') || Str::contains($donasi_map_1, 'embed?pb') || Str::contains($donasi_map_1, 'maps/d/embed')) ? 'none' : 'flex' }}; flex-direction: column; align-items: center; justify-content: center; padding: 30px 20px; text-align: center; gap: 12px; background: #f8fafc; border-radius: 10px;">
                                    <svg viewBox="0 0 24 24" width="44" height="44" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--primary); margin: 0 auto; flex-shrink: 0;">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                    <h4 style="font-weight: 700; color: var(--text-dark); margin: 0;" id="fallback_location_title">{{ $donasi_nama_1 }}</h4>
                                    <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0; line-height: 1.4; max-width: 90%;">Link yang dimasukkan adalah link navigasi Google Maps. Silakan klik tombol di bawah untuk membuka peta dan rute secara langsung.</p>
                                    <a id="fallback_map_btn" href="{{ $donasi_map_1 }}" target="_blank" class="nav-btn nav-btn-primary" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; background: var(--primary); color: #fff; border: none; box-shadow: 0 4px 10px rgba(30,64,175,0.25); justify-content: center;">
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; vertical-align: middle;">
                                            <polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"></polygon>
                                            <line x1="9" y1="3" x2="9" y2="18"></line>
                                            <line x1="15" y1="6" x2="15" y2="21"></line>
                                        </svg>
                                        Buka Rute di Google Maps
                                    </a>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Catatan Tambahan</label>
                            <textarea name="deskripsi" placeholder="Tulis rincian atau kondisi barang (contoh: 1 kardus buku tulis baru)" class="form-control-input" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn-submit-donation-main">Konfirmasi Pengiriman Barang</button>
                    </form>
                @endguest
            </div>

            <!-- SISI KANAN: DAMPAK NYATA -->
            <div class="donation-impact-container animate-on-scroll delay-1">
                <h3>Dampak Nyata</h3>
                <p class="impact-subtitle">Lihat bagaimana nominal donasi anda dirupakan menjadi bantuan konkret di lapangan</p>
                
                <div class="donor-history-list">
                    @forelse($donationsHistory as $donor)
                        @if($donor->jenis_donasi === 'uang')
                            <!-- Data Riwayat Donasi Uang -->
                            <div class="donor-item card-money" style="display: flex; gap: 15px; align-items: center; padding: 15px; border-radius: 12px; border: 1px solid #e2e8f0; background: #ffffff; margin-bottom: 15px;">
                                @if($donor->user && $donor->user->profile && $donor->user->profile !== 'default.png')
                                    <img src="{{ asset('images/' . $donor->user->profile) }}" alt="Avatar" style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover; flex-shrink: 0; border: 2px solid #e0f2fe;">
                                @else
                                    <div style="width: 44px; height: 44px; border-radius: 50%; background: #eff6ff; color: #1e40af; display: flex; align-items: center; justify-content: center; font-size: 1.05rem; font-weight: 700; flex-shrink: 0; border: 2px solid #e0f2fe;">
                                        {{ strtoupper(substr($donor->user ? $donor->user->name : 'A', 0, 1)) }}
                                    </div>
                                @endif
                                <div class="donor-details" style="flex: 1; min-width: 0; text-align: left;">
                                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px; width: 100%;">
                                        <h4 style="margin: 0; font-size: 0.9rem; font-weight: 700; color: var(--text-dark); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $donor->user ? $donor->user->name : 'Anonim' }}</h4>
                                        <div class="donor-badge money" style="margin: 0; flex-shrink: 0;">Uang</div>
                                    </div>
                                    <p class="donor-amount" style="margin: 3px 0; font-size: 1.05rem; font-weight: 800; color: var(--primary); text-align: left;">Rp {{ number_format($donor->nominal, 0, ',', '.') }}</p>
                                    <span class="donor-meta" style="display: inline-flex; align-items: center; gap: 4px; font-size: 0.76rem; color: var(--text-muted); text-align: left;">
                                        <svg viewBox="0 0 24 24" width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                        {{ $donor->created_at->format('d M Y') }} • {{ Str::limit($donor->deskripsi, 30) }}
                                    </span>
                                </div>
                            </div>
                        @else
                            <!-- Data Riwayat Donasi Barang -->
                            <div class="donor-item card-goods" style="display: flex; gap: 15px; align-items: center; padding: 15px; border-radius: 12px; border: 1px solid #e2e8f0; background: #ffffff; margin-bottom: 15px;">
                                @if($donor->user && $donor->user->profile && $donor->user->profile !== 'default.png')
                                    <img src="{{ asset('images/' . $donor->user->profile) }}" alt="Avatar" style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover; flex-shrink: 0; border: 2px solid #fef3c7;">
                                @else
                                    <div style="width: 44px; height: 44px; border-radius: 50%; background: #fffbeb; color: #b45309; display: flex; align-items: center; justify-content: center; font-size: 1.05rem; font-weight: 700; flex-shrink: 0; border: 2px solid #fef3c7;">
                                        {{ strtoupper(substr($donor->user ? $donor->user->name : 'A', 0, 1)) }}
                                    </div>
                                @endif
                                <div class="donor-details" style="flex: 1; min-width: 0; text-align: left;">
                                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px; width: 100%;">
                                        <h4 style="margin: 0; font-size: 0.9rem; font-weight: 700; color: var(--text-dark); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $donor->user ? $donor->user->name : 'Anonim' }}</h4>
                                        <div class="donor-badge goods" style="margin: 0; flex-shrink: 0;">Barang</div>
                                    </div>
                                    <p class="donor-goods-title" style="display: inline-flex; align-items: center; gap: 4px; margin: 3px 0; font-weight: 700; color: #b45309; font-size: 0.85rem; text-align: left;">
                                        <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #b45309; flex-shrink: 0;">
                                            <polygon points="12 22.08 12 12 3 6.92 3 17 12 22.08"></polygon>
                                            <polygon points="12 22.08 21 17 21 6.92 12 12 12 22.08"></polygon>
                                            <polygon points="12 12 21 6.92 12 1.84 3 6.92 12 12"></polygon>
                                        </svg>
                                        {{ $donor->nama_barang }} (x{{ $donor->jumlah_barang }})
                                    </p>
                                    <div style="display: flex; flex-direction: column; gap: 2px; text-align: left;">
                                        <span class="donor-meta" style="display: inline-flex; align-items: center; gap: 4px; font-size: 0.74rem; color: var(--text-muted);">
                                            <svg viewBox="0 0 24 24" width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                            </svg>
                                            {{ Str::limit($donor->deskripsi, 25) }}
                                        </span>
                                        <span class="donor-meta" style="display: inline-flex; align-items: center; gap: 4px; font-size: 0.74rem; color: var(--text-muted);">
                                            <svg viewBox="0 0 24 24" width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                            </svg>
                                            {{ $donor->created_at->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>
                                @if($donor->bukti_transfer)
                                    <div class="donor-goods-thumb" style="width: 48px; height: 48px; flex-shrink: 0; border-radius: 6px; overflow: hidden; border: 1px solid #e2e8f0; display: block; margin: 0;">
                                        <img src="{{ asset('donations/' . $donor->bukti_transfer) }}" alt="Foto Barang" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                @endif
                            </div>
                        @endif
                    @empty
                        <div style="text-align: center; padding: 30px; color: var(--text-muted); font-size: 0.95rem;">
                            Tidak ada riwayat donasi terverifikasi saat ini.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Script Sederhana untuk Switch Form -->
<script>
    function switchForm(type) {
        const formUang = document.getElementById('form-donasi-uang');
        const formBarang = document.getElementById('form-donasi-barang');
        const buttons = document.querySelectorAll('.tab-btn');

        buttons.forEach(btn => btn.classList.remove('active'));

        if(type === 'uang') {
            formUang.classList.remove('d-none');
            formBarang.classList.add('d-none');
            event.target.classList.add('active');
        } else {
            formUang.classList.add('d-none');
            formBarang.classList.remove('d-none');
            event.target.classList.add('active');
        }
    }

    function changeMapDestination(destination, mapUrl, element) {
        document.getElementById('tujuan_lembaga').value = destination;
        
        // Detect if the url is a valid embed link
        const isEmbed = mapUrl.includes('maps/embed') || mapUrl.includes('embed?pb') || mapUrl.includes('maps/d/embed');
        
        const iframe = document.getElementById('single_donation_map');
        const fallback = document.getElementById('map_link_fallback');
        const fallbackTitle = document.getElementById('fallback_location_title');
        const fallbackBtn = document.getElementById('fallback_map_btn');
        
        if (isEmbed) {
            iframe.src = mapUrl;
            iframe.style.display = 'block';
            fallback.style.display = 'none';
        } else {
            iframe.style.display = 'none';
            fallback.style.display = 'flex';
            fallbackTitle.textContent = destination;
            fallbackBtn.href = mapUrl;
        }
        
        const tabs = document.querySelectorAll('.map-tab');
        tabs.forEach(tab => {
            tab.classList.remove('active');
            tab.style.borderColor = '#d1d5db';
            tab.style.borderWidth = '1px';
            tab.style.background = '#ffffff';
            tab.style.color = 'var(--text-dark)';
            tab.style.fontWeight = '500';
        });
        
        element.classList.add('active');
        element.style.borderColor = 'var(--primary)';
        element.style.borderWidth = '2px';
        element.style.background = '#f0f4ff';
        element.style.color = 'var(--primary)';
        element.style.fontWeight = '600';
    }
</script>

<script>

window.addEventListener("scroll", function(){

    const navbar = document.querySelector(".navbar");

    if(window.scrollY > 80){

        navbar.classList.add("scrolled");

    }else{

        navbar.classList.remove("scrolled");

    }

});

</script>

@endsection
