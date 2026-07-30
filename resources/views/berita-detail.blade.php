@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/berita.css') }}">

<section class="news-detail-section">
    <div class="container">
        <div class="detail-wrapper">
            <!-- Left: Article Content -->
            <div class="detail-content">
                <div class="detail-header">
                    <div class="detail-meta">
                        <span class="detail-category">Info Kegiatan</span>
                        <span>•</span>
                        <span>📅 {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}</span>
                    </div>
                    <h1 class="detail-title">{{ $berita->judul }}</h1>
                </div>

                @if($berita->gambar_berita)
                    <img src="{{ file_exists(public_path('news/' . $berita->gambar_berita)) ? asset('news/' . $berita->gambar_berita) : asset('images/' . $berita->gambar_berita) }}" alt="{{ $berita->judul }}" class="detail-image">
                @endif

                <div class="detail-body">{!! nl2br(e($berita->body)) !!}</div>

                <!-- Share Widget -->
                <div class="share-container" style="margin-top: 40px; border-top: 1px solid #e2e8f0; padding-top: 25px;">
                    <span style="font-weight: 700; font-size: 0.95rem; color: var(--text-primary); display: block; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Bagikan Berita Ini:</span>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <!-- WhatsApp -->
                        <a href="https://api.whatsapp.com/send?text={{ rawurlencode($berita->judul . ' - ' . request()->url()) }}" target="_blank" rel="noopener noreferrer" style="background: #25d366; color: #fff; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; padding: 10px 18px; border-radius: 30px; font-weight: 600; font-size: 0.88rem; box-shadow: 0 4px 6px rgba(37, 211, 102, 0.2); transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984a9.96 9.96 0 0 0 1.333 4.993L2 22l5.13-1.347a9.96 9.96 0 0 0 4.88 1.277h.005c5.505 0 9.988-4.478 9.989-9.984C22 7.478 17.518 2 12.012 2zm5.836 14.199c-.32.9-1.845 1.761-2.53 1.83-.63.063-1.425.09-2.285-.187a10.37 10.37 0 0 1-5.112-3.173 10.06 10.06 0 0 1-2.224-3.864c-.39-1.056.392-1.911.902-2.378.112-.1.226-.2.335-.294.133-.113.265-.133.376-.133h.352c.12 0 .285-.045.446.347.167.404.57 1.393.62 1.493.05.1.08.21.01.34-.07.133-.1.226-.201.347-.1.12-.21.27-.3.373-.1.11-.2.23-.086.43.115.198.51.843 1.093 1.362.753.67 1.383.876 1.579.976.2.1.312.083.43-.05.12-.133.51-.595.648-.8.136-.2.27-.166.45-.1.18.066 1.144.538 1.34.636.198.1.328.148.377.23.05.083.05.48-.11.98z"/>
                            </svg>
                            WhatsApp
                        </a>

                        <!-- Facebook -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ rawurlencode(request()->url()) }}" target="_blank" rel="noopener noreferrer" style="background: #1877f2; color: #fff; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; padding: 10px 18px; border-radius: 30px; font-weight: 600; font-size: 0.88rem; box-shadow: 0 4px 6px rgba(24, 119, 242, 0.2); transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c4.56-.93 8-4.96 8-9.75z"/>
                            </svg>
                            Facebook
                        </a>

                        <!-- Twitter/X -->
                        <a href="https://twitter.com/intent/tweet?text={{ rawurlencode($berita->judul) }}&url={{ rawurlencode(request()->url()) }}" target="_blank" rel="noopener noreferrer" style="background: #000000; color: #fff; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; padding: 10px 18px; border-radius: 30px; font-weight: 600; font-size: 0.88rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24" style="fill: #fff;">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                            Twitter
                        </a>

                        <!-- Copy Link -->
                        <button onclick="copyToClipboard('{{ request()->url() }}')" id="copyBtn" style="background: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; display: inline-flex; align-items: center; gap: 8px; padding: 10px 18px; border-radius: 30px; font-weight: 600; font-size: 0.88rem; cursor: pointer; transition: all 0.2s ease; position: relative;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                            </svg>
                            <span id="copyBtnText">Salin Link</span>
                        </button>
                    </div>
                </div>

                <script>
                    function copyToClipboard(text) {
                        navigator.clipboard.writeText(text).then(function() {
                            const copyBtnText = document.getElementById('copyBtnText');
                            const copyBtn = document.getElementById('copyBtn');
                            
                            copyBtnText.innerText = 'Tautan Disalin!';
                            copyBtn.style.background = '#d1fae5';
                            copyBtn.style.color = '#065f46';
                            copyBtn.style.borderColor = '#34d399';
                            
                            setTimeout(function() {
                                copyBtnText.innerText = 'Salin Link';
                                copyBtn.style.background = '#f1f5f9';
                                copyBtn.style.color = '#334155';
                                copyBtn.style.borderColor = '#cbd5e1';
                            }, 2500);
                        }).catch(function(err) {
                            console.error('Gagal menyalin link: ', err);
                        });
                    }
                </script>

                <div style="margin-top: 30px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
                    <a href="{{ route('berita') }}" style="color: var(--primary); text-decoration: none; font-weight: 600; font-size: 0.95rem;">← Kembali ke List Berita</a>
                </div>
            </div>

            <!-- Right: Sidebar -->
            <div class="detail-sidebar">
                <div class="sidebar-widget">
                    <h4 class="widget-title">Berita Terbaru</h4>
                    <ul class="recent-list">
                        @forelse($recentBeritas as $recent)
                            <li class="recent-item">
                                <img src="{{ file_exists(public_path('news/' . $recent->gambar_berita)) ? asset('news/' . $recent->gambar_berita) : asset('images/' . $recent->gambar_berita) }}" alt="{{ $recent->judul }}" class="recent-thumb">
                                <div class="recent-info">
                                    <h5><a href="{{ route('berita.show', $recent->slug) }}">{{ Str::limit($recent->judul, 45) }}</a></h5>
                                    <span>📅 {{ \Carbon\Carbon::parse($recent->tanggal)->format('d M Y') }}</span>
                                </div>
                            </li>
                        @empty
                            <p style="color: var(--text-muted); font-size: 0.9rem;">Belum ada berita lainnya.</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
