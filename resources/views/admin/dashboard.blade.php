@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<!-- Statistics Row -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-info">
            <h3>{{ $newsCount }}</h3>
            <p>Total Berita</p>
            <span>{{ $newsDraftCount }} draft, {{ $newsPublishCount }} dipublikasikan</span>
        </div>
        <div class="stat-icon" style="color: var(--backoffice-primary); display: flex; align-items: center; justify-content: center;">
            <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
            </svg>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-info">
            <h3>{{ $partnersCount }}</h3>
            <p>Partner Terkait</p>
            <span>{{ $partnersApprovedCount }} aktif, {{ $partnersPendingCount }} pending</span>
        </div>
        <div class="stat-icon" style="color: var(--backoffice-accent); display: flex; align-items: center; justify-content: center;">
            <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <h3>{{ $donationsCount }}</h3>
            <p>Transaksi Donasi</p>
            <span>{{ $donationsSuccessCount }} diterima, {{ $donationsPendingCount }} pending</span>
        </div>
        <div class="stat-icon" style="color: #ef4444; display: flex; align-items: center; justify-content: center;">
            <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
            </svg>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <h3>{{ $usersCount }}</h3>
            <p>Total Pengguna</p>
            <span>{{ $usersAdminCount }} Admin aktif</span>
        </div>
        <div class="stat-icon" style="color: #10b981; display: flex; align-items: center; justify-content: center;">
            <svg viewBox="0 0 24 24" width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
        </div>
    </div>
</div>

<!-- Columns Layout -->
<div class="dashboard-columns">
    
    <!-- LEFT: Berita Terbaru Table -->
    <div class="content-card">
        <div class="card-header-row">
            <h2>Berita Terbaru</h2>
            <a href="{{ url('/backoffice/berita') }}" class="admin-btn admin-btn-primary" style="padding: 6px 12px; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 4px; text-decoration: none;">
                <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                Lihat Semua
            </a>
        </div>
        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestBeritas as $b)
                        <tr>
                            <td><strong>{{ $b->judul }}</strong></td>
                            <td>{{ \Carbon\Carbon::parse($b->tanggal)->format('d M Y') }}</td>
                            <td>
                                <span class="badge badge-{{ $b->is_active === 'publish' ? 'success' : 'pending' }}">
                                    {{ $b->is_active === 'publish' ? 'Dipublikasikan' : 'Draft' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align: center; color: var(--backoffice-muted); padding: 20px;">Belum ada berita ditulis.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- RIGHT: Sidebars (Aksi Cepat & Aktivitas Terkini) -->
    <div>
        <!-- Aksi Cepat -->
        <div class="content-card" style="padding: 20px; margin-bottom: 20px;">
            <div class="card-header-row" style="margin-bottom: 15px;">
                <h2>Aksi Cepat</h2>
            </div>
            <div class="action-list">
                <a href="{{ url('/backoffice/berita/create') }}" class="action-item-btn btn-active" style="background: var(--backoffice-accent); color: #ffffff; display: inline-flex; align-items: center; gap: 6px; text-decoration: none;">
                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Tambah Berita
                </a>
                <a href="{{ url('/backoffice/partner') }}" class="action-item-btn" style="display: inline-flex; align-items: center; gap: 6px; text-decoration: none;">
                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; color: var(--backoffice-accent);">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    Kelola Partner
                </a>
                <a href="{{ url('/backoffice/donasi') }}" class="action-item-btn" style="display: inline-flex; align-items: center; gap: 6px; text-decoration: none;">
                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; color: #ef4444;">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                    Kelola Donasi
                </a>
                <a href="{{ url('/backoffice/users') }}" class="action-item-btn" style="display: inline-flex; align-items: center; gap: 6px; text-decoration: none;">
                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; color: #10b981;">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                    </svg>
                    Kelola User
                </a>
            </div>
        </div>

        <!-- Aktivitas Terkini -->
        <div class="content-card" style="padding: 20px;">
            <div class="card-header-row" style="margin-bottom: 15px;">
                <h2>Aktivitas Terkini</h2>
            </div>
            <div class="timeline-list">
                <!-- Recent partners -->
                @foreach($latestPartners as $p)
                    <div class="timeline-item">
                        @if($p->user && $p->user->profile && $p->user->profile !== 'default.png' && file_exists(public_path('images/' . $p->user->profile)))
                            <img src="{{ asset('images/' . $p->user->profile) }}" alt="Avatar" class="timeline-dot" style="object-fit: cover; border: 1.5px solid var(--backoffice-accent); padding: 0;">
                        @else
                            <div class="timeline-dot" style="display: flex; align-items: center; justify-content: center; background: #e0e7ff; color: var(--backoffice-accent);">
                                <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                </svg>
                            </div>
                        @endif
                        <div class="timeline-content">
                            <span class="timeline-title">Pengajuan partner <strong>{{ $p->nama_partner }}</strong> masuk</span>
                            <span class="timeline-time">{{ $p->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @endforeach

                <!-- Recent donations -->
                @foreach($latestDonations as $d)
                    <div class="timeline-item">
                        @if($d->user && $d->user->profile && $d->user->profile !== 'default.png' && file_exists(public_path('images/' . $d->user->profile)))
                            <img src="{{ asset('images/' . $d->user->profile) }}" alt="Avatar" class="timeline-dot" style="object-fit: cover; border: 1.5px solid #ef4444; padding: 0;">
                        @else
                            <div class="timeline-dot" style="display: flex; align-items: center; justify-content: center; background: #fee2e2; color: #ef4444;">
                                <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="timeline-content">
                            <span class="timeline-title">
                                Donasi {{ $d->jenis_donasi }} dari <strong>{{ $d->user ? $d->user->name : 'Anonim' }}</strong> 
                                @if($d->jenis_donasi === 'uang')
                                    (Rp {{ number_format($d->nominal, 0, ',', '.') }})
                                @endif
                            </span>
                            <span class="timeline-time">{{ $d->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @endforeach

                @if($latestPartners->isEmpty() && $latestDonations->isEmpty())
                    <div style="text-align: center; color: var(--backoffice-muted); font-size: 0.85rem; padding: 15px 0;">
                        Belum ada aktivitas terekam.
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>

@endsection
