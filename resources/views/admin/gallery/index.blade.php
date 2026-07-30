@extends('layouts.admin')

@section('title', 'Kelola Galeri')

@section('content')

<div class="content-card">
    <div class="card-header-row">
        <h2>Daftar Galeri Kegiatan</h2>
        <a href="{{ url('/backoffice/gallery/create') }}" class="admin-btn admin-btn-primary">+ Unggah Foto Baru</a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">
        @forelse($galleries as $g)
            <div style="background: #ffffff; border-radius: 8px; border: 1px solid var(--admin-border); overflow: hidden; display: flex; flex-direction: column;">
                <img src="{{ file_exists(public_path('gallery/' . $g->gambar)) ? asset('gallery/' . $g->gambar) : asset('images/' . $g->gambar) }}" alt="{{ $g->judul }}" style="height: 150px; width: 100%; object-fit: cover;">
                <div style="padding: 15px; display: flex; flex-direction: column; flex-grow: 1; justify-content: space-between;">
                    <strong style="font-size: 0.9rem; line-height: 1.4; color: var(--admin-text-dark); margin-bottom: 10px; display: block;">{{ $g->judul }}</strong>
                    <form action="{{ url('/backoffice/gallery/delete/' . $g->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini dari galeri?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="admin-btn admin-btn-danger" style="width: 100%; justify-content: center; padding: 6px; display: inline-flex; align-items: center; gap: 4px;">
                            <svg viewBox="0 0 24 24" width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; color: var(--admin-text-muted); padding: 40px 20px;">Belum ada foto galeri terdaftar.</div>
        @endforelse
    </div>

    <div style="margin-top: 30px;">
        {{ $galleries->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection
