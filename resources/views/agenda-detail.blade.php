@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/agenda.css') }}">

<section class="agenda-detail-section">
    <div class="container">
        
        @if(session('success'))
            <div style="background-color: #d1fae5; color: #065f46; padding: 15px; border-radius: var(--radius-md); margin-bottom: 25px; font-size: 0.9rem; font-weight: 500;">
                ✓ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div style="background-color: #fee2e2; color: #991b1b; padding: 15px; border-radius: var(--radius-md); margin-bottom: 25px; font-size: 0.9rem; font-weight: 500;">
                ✗ {{ session('error') }}
            </div>
        @endif

        <div class="detail-wrapper">
            <!-- Left: Agenda Content -->
            <div class="detail-content">
                <div class="detail-header">
                    <div class="detail-meta" style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                        <span class="detail-category" style="display: inline-flex; align-items: center; gap: 4px;">
                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            Agenda Yayasan
                        </span>
                        <span>•</span>
                        @if($agenda->tanggal_akhir && !\Carbon\Carbon::parse($agenda->tanggal_akhir)->isSameDay(\Carbon\Carbon::parse($agenda->tanggal)))
                            <span style="display: inline-flex; align-items: center; gap: 4px;">
                                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y') }} - {{ \Carbon\Carbon::parse($agenda->tanggal_akhir)->format('d M Y') }}
                            </span>
                        @else
                            <span style="display: inline-flex; align-items: center; gap: 4px;">
                                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y') }}
                            </span>
                        @endif
                        <span>•</span>
                        <span style="display: inline-flex; align-items: center; gap: 4px;">
                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            {{ $agenda->lokasi }}
                        </span>
                    </div>
                    <h1 class="detail-title">{{ $agenda->judul }}</h1>
                </div>

                @if($agenda->gambar)
                    <img src="{{ file_exists(public_path('gallery/' . $agenda->gambar)) ? asset('gallery/' . $agenda->gambar) : asset('images/' . $agenda->gambar) }}" alt="{{ $agenda->judul }}" class="detail-image">
                @endif

                <div class="detail-body">{!! nl2br(e($agenda->deskripsi)) !!}</div>

                <!-- JOIN / DONATE ACTION CARD -->
                <div class="agenda-action-card" style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 25px; border-radius: 16px; margin-top: 30px; display: flex; flex-direction: column; gap: 15px; box-shadow: var(--shadow-sm); box-sizing: border-box; width: 100%;">
                    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px;">
                        <div style="flex: 1; min-width: 250px;">
                            @if($agenda->is_donasi)
                                <div style="display: flex; align-items: center; gap: 8px; color: #b45309; font-weight: 600; font-size: 0.95rem;">
                                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; color: #b45309;">
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                    </svg>
                                    Agenda Donasi / Berbayar
                                </div>
                                <p style="font-size: 0.85rem; color: var(--text-muted); margin: 4px 0 0 0; line-height: 1.4;">Dukung program kami dengan melakukan donasi untuk berpartisipasi dalam agenda ini.</p>
                            @else
                                <div style="display: flex; align-items: center; gap: 8px; color: #16a34a; font-weight: 600; font-size: 0.95rem;">
                                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; color: #16a34a;">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 14 14"></polyline>
                                    </svg>
                                    Agenda Gratis / Terbuka
                                </div>
                                <p style="font-size: 0.85rem; color: var(--text-muted); margin: 4px 0 0 0; line-height: 1.4;">Agenda ini gratis and terbuka untuk umum. Daftarkan kehadiran Anda sekarang!</p>
                            @endif
                        </div>
                        
                        <div style="flex-shrink: 0;">
                            @auth
                                @if($agenda->peserta()->where('user_id', auth()->id())->exists())
                                    <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                                        <span style="background: #d1fae5; color: #065f46; padding: 10px 18px; border-radius: 30px; font-size: 0.85rem; font-weight: 700; display: inline-flex; align-items: center; gap: 6px;">
                                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg>
                                            Terdaftar Kehadiran @if($agenda->is_donasi) (Via Donasi) @endif
                                        </span>
                                        @if(!$agenda->is_donasi)
                                            <form action="{{ route('agenda.batal-ikut', $agenda->id) }}" method="POST" style="margin: 0; display: inline-block;">
                                                @csrf
                                                <button type="submit" style="background: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; padding: 10px 18px; font-size: 0.85rem; font-weight: 700; border-radius: 30px; display: inline-flex; align-items: center; gap: 6px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#fecaca'" onmouseout="this.style.background='#fee2e2'">
                                                    Batalkan Keikutsertaan
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                @else
                                    @if($agenda->is_donasi)
                                        <a href="{{ url('/?agenda_id=' . $agenda->id . '#donasi') }}" class="btn-submit-donation-main" style="text-decoration: none; padding: 12px 24px; font-size: 0.9rem; font-weight: 700; display: inline-flex; align-items: center; gap: 8px;">
                                            Dukung & Donasi Sekarang
                                        </a>
                                    @else
                                        <form action="{{ route('agenda.ikut', $agenda->id) }}" method="POST" style="margin: 0;">
                                            @csrf
                                            <button type="submit" class="btn-submit-donation-main" style="padding: 12px 24px; font-size: 0.9rem; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; cursor: pointer; border: none;">
                                                Ikuti Agenda
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            @else
                                @if($agenda->is_donasi)
                                    <a href="{{ url('/?agenda_id=' . $agenda->id . '#donasi') }}" class="btn-submit-donation-main" style="text-decoration: none; padding: 12px 24px; font-size: 0.9rem; font-weight: 700; display: inline-flex; align-items: center; gap: 8px;">
                                        Dukung & Donasi Sekarang
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn-submit-donation-main" style="text-decoration: none; padding: 12px 24px; font-size: 0.9rem; font-weight: 700; display: inline-flex; align-items: center; gap: 8px;">
                                        Masuk untuk Ikuti Agenda
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>

                <div style="margin-top: 40px; border-top: 1px solid #e2e8f0; padding-top: 20px; display: flex; justify-content: space-between; align-items: center;">
                    <a href="{{ route('home') }}#agenda" style="color: var(--accent); text-decoration: none; font-weight: 600; font-size: 0.95rem;">← Kembali ke Agenda</a>
                </div>
            </div>

            <!-- Right: Sidebar (Other Agendas) -->
            <div class="detail-sidebar">
                <div class="sidebar-widget">
                    <h4 class="widget-title">Agenda Lainnya</h4>
                    <ul class="recent-list">
                        @forelse($recentAgendas as $recent)
                            <li class="recent-item" style="display: flex; gap: 12px; margin-bottom: 20px; align-items: flex-start;">
                                @if($recent->gambar)
                                    <img src="{{ file_exists(public_path('gallery/' . $recent->gambar)) ? asset('gallery/' . $recent->gambar) : asset('images/' . $recent->gambar) }}" alt="{{ $recent->judul }}" class="recent-thumb" style="width: 70px; height: 50px; object-fit: cover; border-radius: 6px; flex-shrink: 0; border: 1px solid #e2e8f0;">
                                @else
                                    <div class="recent-thumb" style="width: 70px; height: 50px; border-radius: 6px; flex-shrink: 0; background: #f1f5f9; display: flex; align-items: center; justify-content: center; border: 1px solid #e2e8f0;">
                                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--text-muted);">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                    </div>
                                @endif
                                <div class="recent-info" style="display: flex; flex-direction: column; gap: 3px;">
                                    <h5 style="margin: 0; font-size: 0.9rem; font-weight: 600; line-height: 1.4;"><a href="{{ route('agenda.show', $recent->id) }}" style="color: var(--text-dark); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-dark)'">{{ Str::limit($recent->judul, 40) }}</a></h5>
                                    @if($recent->tanggal_akhir && !\Carbon\Carbon::parse($recent->tanggal_akhir)->isSameDay(\Carbon\Carbon::parse($recent->tanggal)))
                                        <span style="font-size: 0.78rem; color: var(--text-muted); display: inline-flex; align-items: center; gap: 4px;">
                                            <svg viewBox="0 0 24 24" width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; vertical-align: middle;">
                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($recent->tanggal)->format('d M Y') }} - {{ \Carbon\Carbon::parse($recent->tanggal_akhir)->format('d M Y') }}
                                        </span>
                                    @else
                                        <span style="font-size: 0.78rem; color: var(--text-muted); display: inline-flex; align-items: center; gap: 4px;">
                                            <svg viewBox="0 0 24 24" width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; vertical-align: middle;">
                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                            </svg>
                                            {{ \Carbon\Carbon::parse($recent->tanggal)->format('d M Y') }}
                                        </span>
                                    @endif
                                    <span style="font-size: 0.78rem; color: var(--text-muted); display: inline-flex; align-items: center; gap: 4px;">
                                        <svg viewBox="0 0 24 24" width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; vertical-align: middle;">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        {{ Str::limit($recent->lokasi, 20) }}
                                    </span>
                                </div>
                            </li>
                        @empty
                            <p style="color: var(--text-muted); font-size: 0.9rem; margin: 0;">Belum ada agenda lainnya.</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
