@extends('layouts.admin')

@section('title', 'Kelola Partner')

@section('content')

<div class="content-card">
    <div class="card-header-row">
        <h2>Daftar Pengajuan Partner</h2>
        <a href="{{ url('/backoffice/partner/create') }}" class="admin-btn admin-btn-primary">+ Tambah Partner Baru</a>
    </div>

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Nama Partner</th>
                    <th>Pendaftar (Email)</th>
                    <th>Status</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($partner as $p)
                    <tr>
                        <td>
                            @if($p->logo)
                                <img src="{{ file_exists(public_path('partner/' . $p->logo)) ? asset('partner/' . $p->logo) : asset('images/' . $p->logo) }}" alt="Logo" style="height: 40px; width: auto; object-fit: contain; background: #fafafa; border: 1px solid #e2e8f0; padding: 3px; border-radius: 4px;">
                            @else
                                <span style="font-size: 1.5rem;">🏢</span>
                            @endif
                        </td>
                        <td><strong>{{ $p->nama_partner }}</strong></td>
                        <td>
                            @if($p->user)
                                <span>{{ $p->user->name }}</span><br>
                                <small style="color: var(--admin-text-muted);">{{ $p->user->email }}</small>
                            @else
                                <span style="color: var(--admin-text-muted);">User terhapus</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-{{ $p->status === 'disetujui' ? 'success' : ($p->status === 'ditolak' ? 'danger' : 'warning') }}">
                                {{ $p->status }}
                            </span>
                        </td>
                        <td>{{ $p->created_at->format('d M Y - H:i') }}</td>
                        <td>
                            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                @if($p->status === 'pending')
                                    <form action="{{ url('/backoffice/partner/setujui/' . $p->id) }}" method="POST" style="margin: 0;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="admin-btn admin-btn-success" style="padding: 6px 12px; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 4px;">
                                            <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg>
                                            Setujui
                                        </button>
                                    </form>
                                    <form action="{{ url('/backoffice/partner/tolak/' . $p->id) }}" method="POST" style="margin: 0;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="admin-btn admin-btn-danger" style="padding: 6px 12px; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 4px;">
                                            <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg>
                                            Tolak
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ url('/backoffice/partner/edit/' . $p->id) }}" class="admin-btn admin-btn-primary" style="background: #e2e8f0; color: #1e293b; padding: 6px 12px; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 4px; text-decoration: none;">
                                    <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ url('/backoffice/partner/delete/' . $p->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus partner ini?')" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-btn admin-btn-danger" style="padding: 6px 12px; font-size: 0.8rem; background: #ef4444; display: inline-flex; align-items: center; gap: 4px;">
                                        <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px 20px; color: var(--admin-text-muted);">Belum ada pendaftaran partner.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
