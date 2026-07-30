<style>
    /* Globally prevent horizontal scroll/white gaps on mobile */
    html, body {
        overflow-x: hidden !important;
        width: 100% !important;
    }

    /* Desktop User Dropdown Menu */
    .desktop-user-dropdown {
        position: relative;
    }
    .desktop-user-dropdown .dropdown-menu-wrapper {
        position: absolute;
        top: 100%;
        right: 0;
        margin-top: 12px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
        min-width: 220px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 10000;
        padding: 8px 0;
    }
    .desktop-user-dropdown:hover .dropdown-menu-wrapper {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    .desktop-user-dropdown .dropdown-header {
        padding: 10px 16px;
        display: flex;
        flex-direction: column;
        text-align: left;
    }
    .desktop-user-dropdown .user-name {
        font-weight: 700;
        color: #1e293b;
        font-size: 0.9rem;
    }
    .desktop-user-dropdown .user-role {
        font-size: 0.75rem;
        color: #64748b;
        margin-top: 2px;
    }
    .desktop-user-dropdown .dropdown-divider {
        height: 1px;
        background: #e2e8f0;
        margin: 6px 0;
    }
    .desktop-user-dropdown .dropdown-menu-wrapper a {
        display: block;
        padding: 10px 16px;
        color: #334155 !important;
        font-size: 0.85rem !important;
        font-weight: 500 !important;
        text-decoration: none;
        transition: background 0.2s ease, color 0.2s ease;
        border-bottom: none !important;
        text-align: left;
    }
    .desktop-user-dropdown .dropdown-menu-wrapper a:hover {
        background: #f1f5f9;
        color: var(--primary) !important;
    }
    .desktop-user-dropdown .logout-btn {
        display: block;
        width: 100%;
        padding: 10px 16px;
        text-align: left;
        border: none;
        background: none;
        color: #ef4444;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s ease;
    }
    .desktop-user-dropdown .logout-btn:hover {
        background: #fee2e2;
    }

    /* Guest Actions styling for desktop */
    .desktop-guest-actions a {
        border-bottom: none !important;
    }

    /* Default (Desktop) Hamburger Menu Toggle */
    .mobile-menu-toggle {
        display: none;
    }

    @media (min-width: 769px) {
        .mobile-nav-avatar-li,
        .mobile-nav-action-li {
            display: none !important;
        }
        .desktop-user-dropdown,
        .desktop-guest-actions {
            display: block !important;
        }
    }
    @media (max-width: 768px) {
        .desktop-user-dropdown,
        .desktop-guest-actions {
            display: none !important;
        }
        .mobile-nav-avatar-li,
        .mobile-nav-action-li {
            display: block !important;
        }
        /* Overrides drawer items to not wrap */
        .mobile-nav-action-li a {
            font-size: 0.95rem !important;
            padding: 10px 0 !important;
        }
        /* Responsive Navbar Layout Fix on Mobile */
        .navbar .container {
            flex-direction: row !important;
            justify-content: space-between !important;
            align-items: center !important;
            width: 100% !important;
            max-width: 100% !important;
            padding: 0 20px !important;
            box-sizing: border-box !important;
        }
        .navbar {
            padding: 10px 0 !important;
        }
        .mobile-menu-toggle {
            display: flex !important;
        }
    }
    @media (max-width: 480px) {
        .navbar .logo-text {
            font-size: 11px !important;
        }
        .navbar .logo img {
            height: 32px !important;
        }
    }
</style>

<nav class="navbar {{ request()->routeIs('home') ? 'navbar-home' : 'navbar-page' }}">
    <div class="container">

        <a href="{{ route('home') }}" class="logo" style="display: flex; align-items: center; gap: 10px; text-decoration: none; z-index: 100001;">
            <img src="{{ asset('images/logoyaguwipa.png') }}" alt="Logo YWP" class="logo-img" style="height: 40px; width: auto; object-fit: contain; transition: transform 0.2s ease;">
            <div class="logo-text" style="line-height: 1.2; font-weight: 700; font-size: 14px;">
                Yayasan <br>
                Guna Widya Paramesthi
            </div>
        </a>

        <ul class="nav-menu" id="nav-menu">
            @php
                $navItems = [
                    ['title' => \App\Models\Setting::get('nav_title_1', 'Tentang Kami'), 'link' => \App\Models\Setting::get('nav_link_1', '#tentang_kami')],
                    ['title' => \App\Models\Setting::get('nav_title_2', 'Partner'), 'link' => \App\Models\Setting::get('nav_link_2', '#lembaga_terkait')],
                    ['title' => \App\Models\Setting::get('nav_title_3', 'Galeri'), 'link' => \App\Models\Setting::get('nav_link_3', '#galeri')],
                    ['title' => \App\Models\Setting::get('nav_title_4', 'Berita'), 'link' => \App\Models\Setting::get('nav_link_4', '#berita')],
                    ['title' => \App\Models\Setting::get('nav_title_5', 'Agenda'), 'link' => \App\Models\Setting::get('nav_link_5', '#agenda')],
                    ['title' => \App\Models\Setting::get('nav_title_6', 'Donasi'), 'link' => \App\Models\Setting::get('nav_link_6', '#donasi')],
                ];
            @endphp

            @foreach($navItems as $item)
                @php
                    $link = $item['link'];
                    $url = (str_starts_with($link, '#') ? route('home') : url('')) . $link;
                @endphp
                <li><a href="{{ $url }}">{{ $item['title'] }}</a></li>
            @endforeach

            @auth
                <!-- Desktop Dropdown (Hidden on Mobile) -->
                <li class="desktop-user-dropdown">
                    <a href="#" class="avatar-trigger" style="display: flex; align-items: center; justify-content: center; text-decoration: none; padding: 5px;" onclick="event.preventDefault();">
                        @if(Auth::user()->profile && Auth::user()->profile !== 'default.png')
                            <img src="{{ asset('images/' . Auth::user()->profile) }}" alt="Profil" style="width: 38px; height: 38px; border-radius: 50%; object-fit: cover; border: 2px solid var(--accent); box-shadow: 0 2px 5px rgba(0,0,0,0.1); transition: transform 0.2s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        @else
                            <div class="avatar-initials-sm" style="width: 38px; height: 38px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: var(--accent); color: #fff; font-weight: 700; font-size: 14px;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </a>
                    <div class="dropdown-menu-wrapper">
                        <div class="dropdown-header">
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            <span class="user-role">{{ Auth::user()->role === 'admin' ? 'Administrator' : 'Partner/Donatur' }}</span>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('profile.index') }}">Profil Saya</a>
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ url('/backoffice/dashboard') }}">Dashboard Admin</a>
                        @else
                            <a href="{{ route('partner.index') }}">Partner Saya</a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="logout-btn">Keluar</button>
                        </form>
                    </div>
                </li>

                <!-- Mobile Only Menu Items -->
                <li class="mobile-nav-avatar-li">
                    <div style="display: flex; align-items: center; gap: 12px; padding: 15px 0 5px 0;">
                        @if(Auth::user()->profile && Auth::user()->profile !== 'default.png')
                            <img src="{{ asset('images/' . Auth::user()->profile) }}" alt="Profil" style="width: 46px; height: 46px; border-radius: 50%; object-fit: cover; border: 2px solid var(--accent);">
                        @else
                            <div class="avatar-initials-sm" style="width: 46px; height: 46px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: var(--accent); color: #fff; font-weight: 700; font-size: 1.3rem;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <div style="display: flex; flex-direction: column; text-align: left;">
                            <span style="font-weight: 700; color: #1e293b; font-size: 0.95rem;">{{ Auth::user()->name }}</span>
                            <span style="font-size: 0.78rem; color: #64748b;">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                </li>
                <li class="mobile-nav-action-li">
                    <a href="{{ route('profile.index') }}">Profil Saya</a>
                </li>
                @if(Auth::user()->role === 'admin')
                    <li class="mobile-nav-action-li">
                        <a href="{{ url('/backoffice/dashboard') }}">Dashboard Admin</a>
                    </li>
                @else
                    <li class="mobile-nav-action-li">
                        <a href="{{ route('partner.index') }}">Partner Saya</a>
                    </li>
                @endif
                <li class="mobile-nav-action-li" style="margin-top: 10px;">
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0; width: 100%;">
                        @csrf
                        <button type="submit" class="nav-btn nav-btn-primary" style="cursor: pointer; border: none; background: #ef4444; color: #fff; width: 100%; display: block; text-align: center; padding: 12px; border-radius: 30px; font-weight: 700;">
                            Keluar
                        </button>
                    </form>
                </li>
            @else
                <!-- Guest Desktop Action Buttons -->
                <li class="desktop-guest-actions">
                    <a href="{{ route('login') }}" class="nav-btn nav-btn-secondary" style="font-size: 14px; padding: 8px 20px; text-decoration: none;">Masuk</a>
                </li>
                <li class="desktop-guest-actions">
                    <a href="{{ route('register') }}" class="nav-btn nav-btn-primary" style="font-size: 14px; padding: 8px 20px; text-decoration: none;">Daftar</a>
                </li>

                <!-- Guest Mobile Only Menu Items -->
                <li class="mobile-nav-action-li" style="margin-top: 15px; width: 100%;">
                    <a href="{{ route('login') }}" class="nav-btn nav-btn-secondary" style="display: block; text-align: center; width: 100%; padding: 10px; border-radius: 30px;">
                        Masuk
                    </a>
                </li>
                <li class="mobile-nav-action-li" style="margin-top: 10px; width: 100%;">
                    <a href="{{ route('register') }}" class="nav-btn nav-btn-primary" style="display: block; text-align: center; width: 100%; padding: 10px; border-radius: 30px;">
                        Daftar
                    </a>
                </li>
            @endauth
        </ul>

        <!-- Hamburger Toggle Button -->
        <button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="Toggle navigation" style="background: none; border: none; cursor: pointer; padding: 10px; z-index: 100002; flex-direction: column; gap: 6px; justify-content: center; align-items: center; transition: color 0.3s ease;">
            <span class="hamburger-line" style="display: block; width: 25px; height: 3px; background: currentColor; border-radius: 3px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);"></span>
            <span class="hamburger-line" style="display: block; width: 18px; height: 3px; background: currentColor; border-radius: 3px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); align-self: flex-end;"></span>
            <span class="hamburger-line" style="display: block; width: 25px; height: 3px; background: currentColor; border-radius: 3px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);"></span>
        </button>

    </div>
</nav>

<!-- Backdrop Overlay -->
<div class="nav-backdrop" id="nav-backdrop"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('mobile-menu-toggle');
        const navMenu = document.getElementById('nav-menu');
        const backdrop = document.getElementById('nav-backdrop');

        if (toggleBtn && navMenu && backdrop) {
            function toggleMenu() {
                toggleBtn.classList.toggle('active');
                navMenu.classList.toggle('active');
                backdrop.classList.toggle('active');
                
                // Toggle body scroll
                if (navMenu.classList.contains('active')) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = '';
                }
            }

            toggleBtn.addEventListener('click', toggleMenu);
            backdrop.addEventListener('click', toggleMenu);

            // Close menu when clicking link items in mobile view
            const navLinks = navMenu.querySelectorAll('a');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (navMenu.classList.contains('active')) {
                        toggleMenu();
                    }
                });
            });
        }
    });
</script>