@extends('layouts.admin')

@section('title', 'Kelola Agenda')

@section('content')

<div class="content-card">
    <div class="card-header-row">
        <h2>Daftar Agenda Yayasan</h2>
        <a href="{{ url('/backoffice/agenda/create') }}" class="admin-btn admin-btn-primary">+ Tambah Agenda Baru</a>
    </div>

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul Agenda</th>
                    <th>Lokasi</th>
                    <th>Tanggal Pelaksanaan</th>
                    <th>Tipe / Peserta</th>
                    <th>Deskripsi Singkat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($agendas as $a)
                    <tr>
                        <td>
                            @if($a->gambar)
                                <img src="{{ file_exists(public_path('gallery/' . $a->gambar)) ? asset('gallery/' . $a->gambar) : asset('images/' . $a->gambar) }}" alt="Cover" style="height: 50px; width: 80px; object-fit: cover; border-radius: 4px; border: 1px solid #e2e8f0;">
                            @else
                                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--backoffice-muted);">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                            @endif
                        </td>
                        <td><strong>{{ $a->judul }}</strong></td>
                        <td>{{ $a->lokasi }}</td>
                        <td>{{ \Carbon\Carbon::parse($a->tanggal)->format('d F Y') }}</td>
                        <td>
                            @if($a->is_donasi)
                                <span class="badge" style="background: #fef3c7; color: #d97706; font-weight: 700; font-size: 0.75rem; padding: 3px 8px; border-radius: 6px;">Donasi / Biaya</span>
                            @else
                                <span class="badge" style="background: #d1fae5; color: #059669; font-weight: 700; font-size: 0.75rem; display: inline-block; margin-bottom: 5px; padding: 3px 8px; border-radius: 6px;">Gratis</span><br>
                                <a href="{{ route('admin.agenda.peserta', $a->id) }}" style="font-size: 0.8rem; color: var(--backoffice-accent); font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                                    <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0; vertical-align: middle;">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                    </svg>
                                    {{ $a->peserta()->count() }} Peserta
                                </a>
                            @endif
                        </td>
                        <td>{{ Str::limit($a->deskripsi, 50) }}</td>
                        <td>
                            <div style="display: flex; gap: 8px;">
                                <a href="{{ url('/backoffice/agenda/edit/' . $a->id) }}" class="admin-btn admin-btn-primary" style="background: #e2e8f0; color: #1e293b; display: inline-flex; align-items: center; gap: 4px; text-decoration: none;">
                                    <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ url('/backoffice/agenda/delete/' . $a->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus agenda ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-btn admin-btn-danger" style="display: inline-flex; align-items: center; gap: 4px;">
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
                        <td colspan="6" style="text-align: center; padding: 40px 20px; color: var(--admin-text-muted);">Belum ada agenda terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $agendas->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection
