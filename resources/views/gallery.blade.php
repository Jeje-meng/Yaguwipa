@extends('layouts.app')

@section('content')

<section class="gallery-page">
    <div class="container">
        <div class="gallery-page-header">
            <div class="gallery-header-info">
                <span class="section-badge">Galeri</span>
                <h2>Galeri Yayasan</h2>
                <p>Dokumentasi seluruh kegiatan Yayasan Guna Widya Paramesthi.</p>
            </div>
        </div>

        <div class="gallery-grid-subpage">
            @forelse($galleries as $g)
                <div class="gallery-card">
                    <div class="gallery-img-wrapper">
                        <img src="{{ file_exists(public_path('gallery/' . $g->gambar)) ? asset('gallery/' . $g->gambar) : asset('images/' . $g->gambar) }}" alt="{{ $g->judul }}">
                    </div>
                    <div class="gallery-card-content">
                        <span class="card-badge badge-edu">Kegiatan</span>
                        <h4>{{ $g->judul }}</h4>
                        <p>Dokumentasi foto kegiatan Yayasan Guna Widya Paramesthi.</p>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; color: var(--text-muted); font-size: 0.95rem; padding: 40px 20px;">
                    Belum ada dokumentasi galeri saat ini.
                </div>
            @endforelse
        </div>

        <div style="margin-top: 30px; display: flex; justify-content: center;">
            {{ $galleries->links('pagination::bootstrap-4') }}
        </div>

        <div class="gallery-navigation">
            <a href="{{ route('home') }}#galeri" class="btn-back">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>
</section>

@endsection