@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/berita.css') }}">

<section class="news-page">

    <div class="container">

        <div class="page-title">

            <span class="badge">
                BERITA
            </span>

            <h1>Berita Terbaru</h1>

            <p>
                Dokumentasi berbagai kegiatan Yayasan Guna Widya Paramesthi
                dalam bidang pendidikan, sosial, kemanusiaan, dan pengembangan SDM.
            </p>

        </div>


        <div class="news-grid">
            @forelse($beritas as $b)
                <div class="news-card">
                    <img src="{{ file_exists(public_path('news/' . $b->gambar_berita)) ? asset('news/' . $b->gambar_berita) : asset('images/' . $b->gambar_berita) }}" alt="{{ $b->judul }}" style="height: 200px; width: 100%; object-fit: cover;">
                    <div class="news-content">
                        <span class="category">{{ $b->created_at ? $b->created_at->format('d M Y') : 'Berita' }}</span>
                        <h3>{{ $b->judul }}</h3>
                        <p>{{ Str::limit(strip_tags($b->body), 100) }}</p>
                        <a href="{{ route('berita.show', $b->slug) }}">Detail →</a>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; color: var(--text-muted); font-size: 0.95rem; padding: 40px 20px;">
                    Belum ada berita terbaru saat ini.
                </div>
            @endforelse
        </div>

        <div style="margin-top: 30px; display: flex; justify-content: center;">
            {{ $beritas->links('pagination::bootstrap-4') }}
        </div>

        <a href="{{ route('home') }}#berita" class="back-link">
            ← Kembali ke Beranda
        </a>

    </div>

</section>

@endsection