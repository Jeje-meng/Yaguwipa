@extends('layouts.admin')

@section('title', 'Kelola Berita')

@section('content')

<div class="content-card">
    <div class="card-header-row">
        <h2>Daftar Artikel Berita</h2>
        <a href="{{ url('/backoffice/berita/create') }}" class="admin-btn admin-btn-primary">+ Tambah Berita Baru</a>
    </div>

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul Berita</th>
                    <th>Slug</th>
                    <th>Tanggal Rilis</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($beritas as $b)
                    <tr>
                        <td>
                            @if($b->gambar_berita)
                                <img src="{{ file_exists(public_path('news/' . $b->gambar_berita)) ? asset('news/' . $b->gambar_berita) : asset('images/' . $b->gambar_berita) }}" alt="News" style="height: 50px; width: 80px; object-fit: cover; border-radius: 4px; border: 1px solid #e2e8f0;">
                            @else
                                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--backoffice-muted);">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <path d="M16 8h2M16 12h2M16 16h2M6 8h6v8H6z"></path>
                                </svg>
                            @endif
                        </td>
                        <td><strong>{{ $b->judul }}</strong></td>
                        <td><small style="font-family: monospace; background: #f1f5f9; padding: 2px 5px; border-radius: 4px;">{{ $b->slug }}</small></td>
                        <td>{{ \Carbon\Carbon::parse($b->tanggal)->format('d F Y') }}</td>
                        <td>
                            <span class="badge" style="background: {{ $b->is_active === 'publish' ? '#d1fae5' : '#e2e8f0' }}; color: {{ $b->is_active === 'publish' ? '#065f46' : '#475569' }};">
                                {{ $b->is_active }}
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 8px;">
                                <a href="{{ url('/backoffice/berita/edit/' . $b->id) }}" class="admin-btn admin-btn-primary" style="background: #e2e8f0; color: #1e293b; display: inline-flex; align-items: center; gap: 4px; text-decoration: none;">
                                    <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ url('/backoffice/berita/delete/' . $b->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
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
                        <td colspan="6" style="text-align: center; padding: 40px 20px; color: var(--admin-text-muted);">Belum ada berita terbit.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $beritas->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection
