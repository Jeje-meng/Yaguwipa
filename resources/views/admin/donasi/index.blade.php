@extends('layouts.admin')

@section('title', 'Kelola Donasi')

@section('content')

<div class="content-card">
    <div class="card-header-row">
        <h2>Daftar Transaksi Donasi</h2>
    </div>

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Donatur</th>
                    <th>Jenis Donasi</th>
                    <th>Detail Donasi</th>
                    <th>Bukti Transfer / Foto Barang</th>
                    <th>Status</th>
                    <th>Tanggal Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($donations as $d)
                    <tr>
                        <td>
                            @if($d->user)
                                <strong>{{ $d->user->name }}</strong><br>
                                <small style="color: var(--admin-text-muted);">{{ $d->user->email }}</small>
                            @else
                                <span style="color: var(--admin-text-muted);">Guest / Anonim</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge" style="background: {{ $d->jenis_donasi === 'uang' ? '#eff6ff' : '#f0fdf4' }}; color: {{ $d->jenis_donasi === 'uang' ? '#1e40af' : '#166534' }};">
                                {{ strtoupper($d->jenis_donasi) }}
                            </span>
                        </td>
                        <td>
                            @if($d->jenis_donasi === 'uang')
                                <strong style="font-size: 1.05rem; color: var(--admin-primary);">Rp {{ number_format($d->nominal, 0, ',', '.') }}</strong><br>
                                <small style="color: var(--admin-text-muted);">{{ $d->deskripsi }}</small>
                            @else
                                <strong>{{ $d->nama_barang }}</strong><br>
                                <span>Jumlah: <strong>{{ $d->jumlah_barang }}</strong></span><br>
                                <small style="color: var(--admin-text-muted);">{{ $d->deskripsi }}</small>
                            @endif

                            @if($d->agenda)
                                <div style="margin-top: 8px; font-size: 0.8rem; background: #fff8e1; border: 1px solid #ffe082; color: #b78103; padding: 4px 8px; border-radius: 6px; display: inline-flex; align-items: center; gap: 4px; text-align: left; line-height: 1.2;">
                                    <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; color: #b78103;">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    <span>Untuk Agenda: {{ $d->agenda->judul }}</span>
                                </div>
                            @endif
                        </td>
                        <td>
                            @if($d->bukti_transfer)
                                <a href="{{ asset('donations/' . $d->bukti_transfer) }}" target="_blank" style="display: flex; align-items: center; gap: 5px; color: var(--admin-accent); text-decoration: none; font-weight: 600;">
                                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                    Lihat Berkas
                                </a>
                            @else
                                <span style="color: var(--admin-text-muted); font-style: italic;">Belum diupload</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-{{ $d->status === 'diterima' ? 'success' : ($d->status === 'ditolak' ? 'danger' : 'warning') }}">
                                {{ $d->status }}
                            </span>
                        </td>
                        <td>{{ $d->created_at->format('d M Y - H:i') }}</td>
                        <td>
                            @if($d->status === 'pending')
                                <div style="display: flex; gap: 8px;">
                                    <form action="{{ url('/backoffice/donasi/approve/' . $d->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="admin-btn admin-btn-success" style="display: inline-flex; align-items: center; gap: 4px;">
                                            <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg>
                                            Terima
                                        </button>
                                    </form>
                                    <form action="{{ url('/backoffice/donasi/reject/' . $d->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="admin-btn admin-btn-danger" style="display: inline-flex; align-items: center; gap: 4px;">
                                            <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg>
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            @else
                                <span style="color: var(--admin-text-muted); font-size: 0.85rem; font-style: italic;">Selesai</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px 20px; color: var(--admin-text-muted);">Belum ada transaksi donasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $donations->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection
