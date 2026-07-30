<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backoffice Panel - Yaguwipa</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        .sidebar-menu li.active a svg {
            color: #ffffff !important;
        }
        .sidebar-menu li a:hover svg {
            color: #ffffff !important;
        }
    </style>
</head>
<body class="admin-body">

    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <a href="{{ url('/backoffice/dashboard') }}" class="sidebar-brand" style="text-decoration: none; display: flex; align-items: center; gap: 10px;">
            <img src="{{ asset('images/logoyaguwipa.png') }}" alt="Logo YWP" style="height: 38px; width: auto; object-fit: contain; flex-shrink: 0; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));">
            <div style="line-height: 1.2; text-align: left;">
                <span style="font-weight: 800; font-size: 0.95rem; display: block; color: #ffffff;">YAGUWIPA</span>
                <span style="font-size: 0.65rem; color: #94a3b8; font-weight: 600; letter-spacing: 0.5px;">BACKOFFICE PANEL</span>
            </div>
        </a>
        
        <!-- UTAMA GROUP -->
        <div class="sidebar-group-label">Utama</div>
        <ul class="sidebar-menu">
            <li class="{{ request()->is('backoffice/dashboard*') ? 'active' : '' }}">
                <a href="{{ url('/backoffice/dashboard') }}" style="display: flex; align-items: center;">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px; color: #94a3b8; transition: color 0.2s;">
                        <rect x="3" y="3" width="7" height="9"></rect>
                        <rect x="14" y="3" width="7" height="5"></rect>
                        <rect x="14" y="12" width="7" height="9"></rect>
                        <rect x="3" y="16" width="7" height="5"></rect>
                    </svg>
                    Dashboard
                </a>
            </li>
        </ul>

        <!-- MODUL UTAMA GROUP -->
        <div class="sidebar-group-label">Modul Utama</div>
        <ul class="sidebar-menu">
            <li class="{{ request()->is('backoffice/partner*') ? 'active' : '' }}">
                <a href="{{ url('/backoffice/partner') }}" style="display: flex; align-items: center; justify-content: space-between; width: 100%; box-sizing: border-box; text-decoration: none;">
                    <div style="display: flex; align-items: center;">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px; color: #94a3b8; transition: color 0.2s;">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        Kelola Partner
                    </div>
                    @if($pendingPartnersCount > 0)
                        <span style="background: var(--backoffice-danger); color: white; border-radius: 9999px; font-size: 0.72rem; display: inline-flex; align-items: center; justify-content: center; min-width: 18px; height: 18px; padding: 0 5px; font-weight: 700; line-height: 1; flex-shrink: 0; box-sizing: border-box;">
                            {{ $pendingPartnersCount }}
                        </span>
                    @endif
                </a>
            </li>
             <li class="{{ request()->is('backoffice/donasi*') ? 'active' : '' }}">
                <a href="{{ url('/backoffice/donasi') }}" style="display: flex; align-items: center; justify-content: space-between; width: 100%; box-sizing: border-box; text-decoration: none;">
                    <div style="display: flex; align-items: center;">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px; color: #94a3b8; transition: color 0.2s;">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                        Kelola Donasi
                    </div>
                    @if($pendingDonationsCount > 0)
                        <span style="background: var(--backoffice-danger); color: white; border-radius: 9999px; font-size: 0.72rem; display: inline-flex; align-items: center; justify-content: center; min-width: 18px; height: 18px; padding: 0 5px; font-weight: 700; line-height: 1; flex-shrink: 0; box-sizing: border-box;">
                            {{ $pendingDonationsCount }}
                        </span>
                    @endif
                </a>
            </li>
            <li class="{{ request()->is('backoffice/agenda*') ? 'active' : '' }}">
                <a href="{{ url('/backoffice/agenda') }}" style="display: flex; align-items: center;">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px; color: #94a3b8; transition: color 0.2s;">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    Kelola Agenda
                </a>
            </li>
            <li class="{{ request()->is('backoffice/berita*') ? 'active' : '' }}">
                <a href="{{ url('/backoffice/berita') }}" style="display: flex; align-items: center;">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px; color: #94a3b8; transition: color 0.2s;">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <path d="M16 8h2M16 12h2M16 16h2M6 8h6v8H6z"></path>
                    </svg>
                    Kelola Berita
                </a>
            </li>
            <li class="{{ request()->is('backoffice/settings') ? 'active' : '' }}">
                <a href="{{ url('/backoffice/settings') }}" style="display: flex; align-items: center;">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px; color: #94a3b8; transition: color 0.2s;">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                    </svg>
                    Kelola Halaman Utama
                </a>
            </li>
        </ul>

        <!-- KONTEN TAMBAHAN GROUP -->
        <div class="sidebar-group-label">Konten Tambahan</div>
        <ul class="sidebar-menu">
            <li class="{{ request()->is('backoffice/gallery*') ? 'active' : '' }}">
                <a href="{{ url('/backoffice/gallery') }}" style="display: flex; align-items: center;">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px; color: #94a3b8; transition: color 0.2s;">
                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                        <circle cx="12" cy="13" r="4"></circle>
                    </svg>
                    Kelola Galeri
                </a>
            </li>
        </ul>

        <!-- PENGATURAN SYSTEM GROUP -->
        <div class="sidebar-group-label">Pengaturan System</div>
        <ul class="sidebar-menu">
            <li class="{{ request()->is('backoffice/users*') ? 'active' : '' }}">
                <a href="{{ url('/backoffice/users') }}" style="display: flex; align-items: center;">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px; color: #94a3b8; transition: color 0.2s;">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Kelola User
                </a>
            </li>
            <li class="{{ request()->is('backoffice/settings/donasi*') ? 'active' : '' }}">
                <a href="{{ url('/backoffice/settings/donasi') }}" style="display: flex; align-items: center;">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px; color: #94a3b8; transition: color 0.2s;">
                        <rect x="2" y="4" width="20" height="16" rx="2" ry="2"></rect>
                        <line x1="12" y1="18" x2="12.01" y2="18"></line>
                    </svg>
                    Pengaturan Donasi
                </a>
            </li>
        </ul>

        <!-- Sidebar Footer logout -->
        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; font-weight: 600; font-family: inherit; font-size: 0.88rem; display: flex; align-items: center; gap: 10px; width: 100%; padding: 8px 10px; transition: all 0.2s ease; border-radius: var(--radius-sm);">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #ef4444; flex-shrink: 0;">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="admin-main">
        <!-- Top Navbar -->
        <header class="admin-header">
            <h1 style="display: flex; align-items: center; gap: 15px; margin: 0; font-size: 1.5rem; position: relative;">
                <button type="button" id="hamburgerMenuBtn" title="Menu Navigasi" class="back-dashboard-btn" style="background: #ffffff; width: 38px; height: 38px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; font-size: 1.25rem; border: 1px solid #e2e8f0; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 1px 3px rgba(0,0,0,0.05);" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#ffffff'">☰</button>
                
                <!-- Hamburger Dropdown Menu -->
                <div id="hamburgerDropdown" style="display: none; position: absolute; top: 48px; left: 0; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05); z-index: 1000; width: 220px; padding: 6px; box-sizing: border-box; flex-direction: column; gap: 4px;">
                    <a href="{{ url('/backoffice/dashboard') }}" style="display: flex; align-items: center; gap: 10px; padding: 10px 12px; font-size: 0.88rem; color: #1e293b; text-decoration: none; border-radius: 6px; font-weight: 600; transition: background 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">
                        Kembali ke Dashboard
                    </a>
                    <a href="{{ url('/') }}" style="display: flex; align-items: center; gap: 10px; padding: 10px 12px; font-size: 0.88rem; color: #1e293b; text-decoration: none; border-radius: 6px; font-weight: 600; transition: background 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">
                        Kembali ke Beranda Utama
                    </a>
                </div>
                @yield('title', 'Dashboard')
            </h1>
            <div style="display: flex; align-items: center; gap: 20px;">
                <!-- Notification Icon & Dropdown -->
                <div style="display: flex; align-items: center; cursor: pointer; position: relative;" id="notificationContainer">
                    <div id="notificationBellBtn" style="display: flex; align-items: center; position: relative; padding: 4px;" title="Notifikasi Menunggu Verifikasi">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--backoffice-muted);">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9zm-9.73 13a3 3 0 0 0 5.46 0"></path>
                        </svg>
                        @if($totalPendingCount > 0)
                            <span style="position: absolute; top: -2px; right: -2px; background: var(--backoffice-danger); color: white; border-radius: 50%; width: 15px; height: 15px; font-size: 0.65rem; font-weight: 700; display: flex; align-items: center; justify-content: center; border: 1.5px solid #ffffff;">
                                {{ $totalPendingCount }}
                            </span>
                        @endif
                    </div>
                    
                    <!-- Dropdown List -->
                    <div id="notificationDropdown" style="display: none; position: absolute; top: 35px; right: 0; background: #ffffff; border: 1px solid var(--backoffice-border); border-radius: 10px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.1); width: 340px; z-index: 1050; padding: 8px 0; box-sizing: border-box;">
                        <div style="padding: 10px 16px; border-bottom: 1px solid var(--backoffice-border); font-weight: 700; font-size: 0.88rem; color: var(--backoffice-primary); display: flex; justify-content: space-between; align-items: center;">
                            <span>Notifikasi Masuk (Pending)</span>
                            <span style="background: #fee2e2; color: #ef4444; font-size: 0.72rem; padding: 2px 6px; border-radius: 9999px; font-weight: 700;">
                                {{ $totalPendingCount }} Baru
                            </span>
                        </div>
                        
                        <div style="max-height: 280px; overflow-y: auto;">
                            <!-- Pendaftaran Partner -->
                            @if($pendingPartnersCount > 0)
                                <div style="background: #f8fafc; padding: 6px 16px; font-size: 0.7rem; font-weight: 700; color: #64748b; text-transform: uppercase; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                                    <span>Pendaftaran Mitra</span>
                                    <span style="background: #e2e8f0; color: #475569; padding: 1px 5px; border-radius: 4px; font-size: 0.65rem;">{{ $pendingPartnersCount }} pending</span>
                                </div>
                                @foreach($latestPendingPartners as $pp)
                                    <a href="{{ url('/backoffice/partner') }}" style="display: flex; gap: 10px; padding: 12px 16px; border-bottom: 1px solid #f1f5f9; text-decoration: none; color: inherit; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                        @if($pp->user && $pp->user->profile && $pp->user->profile !== 'default.png' && file_exists(public_path('images/' . $pp->user->profile)))
                                            <img src="{{ asset('images/' . $pp->user->profile) }}" alt="Profile" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; flex-shrink: 0; border: 1.5px solid #d97706;">
                                        @else
                                            <div style="background: #fef3c7; color: #d97706; border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="9" cy="7" r="4"></circle>
                                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div style="flex: 1; min-width: 0; text-align: left;">
                                            <div style="font-size: 0.82rem; font-weight: 700; color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                {{ $pp->nama_partner }}
                                            </div>
                                            <div style="font-size: 0.76rem; color: #475569; margin-top: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                Pengaju: {{ $pp->user ? $pp->user->name : 'Anonim' }}
                                            </div>
                                            <div style="font-size: 0.68rem; color: #94a3b8; margin-top: 4px;">
                                                {{ $pp->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @endif

                            <!-- Transaksi Donasi -->
                            @if($pendingDonationsCount > 0)
                                <div style="background: #f8fafc; padding: 6px 16px; font-size: 0.7rem; font-weight: 700; color: #64748b; text-transform: uppercase; border-bottom: 1px solid #e2e8f0; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                                    <span>Donasi Masuk</span>
                                    <span style="background: #e2e8f0; color: #475569; padding: 1px 5px; border-radius: 4px; font-size: 0.65rem;">{{ $pendingDonationsCount }} pending</span>
                                </div>
                                @foreach($latestPendingDonations as $pd)
                                    <a href="{{ url('/backoffice/donasi') }}" style="display: flex; gap: 10px; padding: 12px 16px; border-bottom: 1px solid #f1f5f9; text-decoration: none; color: inherit; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                        @if($pd->user && $pd->user->profile && $pd->user->profile !== 'default.png' && file_exists(public_path('images/' . $pd->user->profile)))
                                            <img src="{{ asset('images/' . $pd->user->profile) }}" alt="Profile" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; flex-shrink: 0; border: 1.5px solid #1e40af;">
                                        @else
                                            <div style="background: #eff6ff; color: #1e40af; border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div style="flex: 1; min-width: 0; text-align: left;">
                                            <div style="font-size: 0.82rem; font-weight: 700; color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                {{ $pd->user ? $pd->user->name : 'Anonim' }}
                                            </div>
                                            <div style="font-size: 0.76rem; color: #475569; margin-top: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                @if($pd->jenis_donasi === 'uang')
                                                    Donasi Uang: Rp {{ number_format($pd->nominal, 0, ',', '.') }}
                                                @else
                                                    Donasi Barang: {{ $pd->nama_barang }} (x{{ $pd->jumlah_barang }})
                                                @endif
                                            </div>
                                            <div style="font-size: 0.68rem; color: #94a3b8; margin-top: 4px;">
                                                {{ $pd->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @endif

                            @if($totalPendingCount == 0)
                                <div style="padding: 25px 16px; text-align: center; color: var(--backoffice-muted); font-size: 0.82rem;">
                                    Belum ada notifikasi pending masuk.
                                </div>
                            @endif
                        </div>
                        
                        <div style="padding: 8px 16px 2px 16px; text-align: center; border-top: 1px solid var(--backoffice-border); display: flex; justify-content: space-around; align-items: center;">
                            <a href="{{ url('/backoffice/partner') }}" style="font-size: 0.82rem; font-weight: 600; color: var(--backoffice-accent); text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                                Kelola Partner
                            </a>
                            <a href="{{ url('/backoffice/donasi') }}" style="font-size: 0.82rem; font-weight: 600; color: var(--backoffice-accent); text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                                Kelola Donasi
                            </a>
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('profile.index') }}" style="display: flex; align-items: center; gap: 12px; border-left: 1px solid var(--backoffice-border); padding-left: 20px; text-decoration: none; color: inherit;">
                    @if(Auth::user()->profile && Auth::user()->profile !== 'default.png')
                        <img src="{{ asset('images/' . Auth::user()->profile) }}" alt="Profile" style="width: 38px; height: 38px; border-radius: 50%; object-fit: cover; border: 2px solid var(--backoffice-accent);">
                    @else
                        <div class="avatar-initials-admin">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <div style="line-height: 1.2;">
                        <div style="font-weight: 700; font-size: 0.88rem; color: var(--backoffice-primary);">{{ Auth::user()->name }}</div>
                        <div style="font-size: 0.72rem; color: var(--backoffice-muted); font-weight: 600;">{{ ucfirst(Auth::user()->role) }}</div>
                    </div>
                </a>
            </div>
        </header>

        <!-- Flash messages -->
        @if(session('success'))
            <div style="background-color: #d1fae5; color: #065f46; padding: 15px; border-radius: var(--radius-sm); margin-bottom: 25px; font-weight: 500; font-size: 0.88rem; border-left: 4px solid var(--backoffice-success);">
                ✓ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div style="background-color: #fee2e2; color: #991b1b; padding: 15px; border-radius: var(--radius-sm); margin-bottom: 25px; font-weight: 500; font-size: 0.88rem; border-left: 4px solid var(--backoffice-danger);">
                ✗ {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

     <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('hamburgerMenuBtn');
            const dropdown = document.getElementById('hamburgerDropdown');
            
            if (btn && dropdown) {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isHidden = dropdown.style.display === 'none' || !dropdown.style.display;
                    dropdown.style.display = isHidden ? 'flex' : 'none';
                    // Hide notification dropdown if open
                    if (notifDropdown) notifDropdown.style.display = 'none';
                });
                
                document.addEventListener('click', function(e) {
                    if (!dropdown.contains(e.target) && e.target !== btn) {
                        dropdown.style.display = 'none';
                    }
                });
            }

            // Notification dropdown toggle
            const notifBellBtn = document.getElementById('notificationBellBtn');
            const notifDropdown = document.getElementById('notificationDropdown');
            if (notifBellBtn && notifDropdown) {
                notifBellBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isHidden = notifDropdown.style.display === 'none' || !notifDropdown.style.display;
                    notifDropdown.style.display = isHidden ? 'block' : 'none';
                    // Hide hamburger dropdown if open
                    if (dropdown) dropdown.style.display = 'none';
                });
                
                document.addEventListener('click', function(e) {
                    if (!notifDropdown.contains(e.target) && !notifBellBtn.contains(e.target)) {
                        notifDropdown.style.display = 'none';
                    }
                });
            }
        });
    </script>
</body>
</html>
