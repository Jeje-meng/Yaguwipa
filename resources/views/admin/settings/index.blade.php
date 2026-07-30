@extends('layouts.admin')

@section('title', 'Kelola Halaman Utama')

@section('content')

<style>
    .section-divider {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--backoffice-primary);
        margin-top: 35px;
        margin-bottom: 20px;
        border-bottom: 2px solid var(--backoffice-border);
        padding-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .preview-container {
        display: flex;
        align-items: center;
        gap: 20px;
        background: #f8fafc;
        padding: 15px;
        border-radius: var(--radius-sm);
        border: 1px dashed var(--backoffice-border);
        margin-bottom: 15px;
    }
    .preview-img {
        height: 60px;
        width: 60px;
        object-fit: contain;
        background: #ffffff;
        border: 1px solid var(--backoffice-border);
        padding: 4px;
        border-radius: 6px;
    }
    .preview-badge-emoji {
        font-size: 2rem;
        background: #ffffff;
        border: 1px solid var(--backoffice-border);
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
    }
</style>

<div class="content-card" style="max-width: 800px; margin: 0 auto;">
    <div class="card-header-row">
        <h2>Pengaturan Konten Halaman Utama (Landing Page)</h2>
    </div>

    @if($errors->any())
        <div style="background-color: #fee2e2; color: #991b1b; padding: 15px; border-radius: var(--radius-sm); margin-bottom: 25px; font-size: 0.9rem;">
            ✗ {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- SECTION 1: HERO -->
        <h3 class="section-divider">1. Bagian Hero (Sambut Belajar)</h3>

        <div class="admin-form-group">
            <label for="hero_subtitle">Deskripsi Hero (Hero Subtitle)</label>
            <textarea id="hero_subtitle" name="hero_subtitle" class="admin-form-control" rows="4" required>{{ old('hero_subtitle', $hero_subtitle) }}</textarea>
        </div>

        <div class="admin-form-group">
            <label>Gambar Cover Hero Saat Ini</label>
            <div style="margin-bottom: 15px;">
                <img src="{{ asset('images/' . $hero_image) }}" alt="Hero Cover" style="max-width: 100%; max-height: 220px; border-radius: var(--radius-sm); border: 1px solid var(--backoffice-border); object-fit: cover;">
            </div>
            <label for="hero_image">Ganti Gambar Cover Hero</label>
            <input type="file" id="hero_image" name="hero_image" accept="image/*" class="admin-form-control">
        </div>


        <!-- SECTION 2: VISI -->
        <h3 class="section-divider">2. Visi Yayasan</h3>

        <div class="admin-form-group">
            <label for="visi">Teks Visi</label>
            <textarea id="visi" name="visi" class="admin-form-control" rows="3" required>{{ old('visi', $visi) }}</textarea>
        </div>

        <div class="admin-form-group">
            <label>Logo Visi Aktif</label>
            <div class="preview-container">
                @if($visi_logo && file_exists(public_path('images/' . $visi_logo)))
                    <img src="{{ asset('images/' . $visi_logo) }}" alt="Visi Logo" class="preview-img">
                @else
                    <img src="{{ asset('images/visi.png') }}" alt="Visi Logo Default" class="preview-img">
                @endif
                <span style="font-size: 0.8rem; color: var(--backoffice-muted);">File: {{ $visi_logo ?? 'visi.png (Bawaan)' }}</span>
            </div>
            <label for="visi_logo">Ganti Logo Visi</label>
            <input type="file" id="visi_logo" name="visi_logo" accept="image/*" class="admin-form-control">
        </div>


        <!-- SECTION 3: MISI -->
        <h3 class="section-divider">3. Misi Yayasan</h3>

        <div class="admin-form-group">
            <label for="misi">Teks Misi (Gunakan enter/baris baru untuk setiap poin misi)</label>
            <textarea id="misi" name="misi" class="admin-form-control" rows="5" required>{{ old('misi', $misi) }}</textarea>
        </div>

        <div class="admin-form-group">
            <label>Logo Misi Aktif</label>
            <div class="preview-container">
                @if($misi_logo && file_exists(public_path('images/' . $misi_logo)))
                    <img src="{{ asset('images/' . $misi_logo) }}" alt="Misi Logo" class="preview-img">
                @else
                    <img src="{{ asset('images/misi.png') }}" alt="Misi Logo Default" class="preview-img">
                @endif
                <span style="font-size: 0.8rem; color: var(--backoffice-muted);">File: {{ $misi_logo ?? 'misi.png (Bawaan)' }}</span>
            </div>
            <label for="misi_logo">Ganti Logo Misi</label>
            <input type="file" id="misi_logo" name="misi_logo" accept="image/*" class="admin-form-control">
        </div>


        <!-- SECTION 4: TUJUAN -->
        <h3 class="section-divider">4. Tujuan Yayasan</h3>

        <div class="admin-form-group">
            <label for="tujuan">Teks Tujuan</label>
            <textarea id="tujuan" name="tujuan" class="admin-form-control" rows="3" required>{{ old('tujuan', $tujuan) }}</textarea>
        </div>

        <div class="admin-form-group">
            <label>Logo/Icon Tujuan Aktif</label>
            <div class="preview-container">
                @if($tujuan_logo && file_exists(public_path('images/' . $tujuan_logo)))
                    <img src="{{ asset('images/' . $tujuan_logo) }}" alt="Tujuan Logo" class="preview-img">
                    <span style="font-size: 0.8rem; color: var(--backoffice-muted);">File: {{ $tujuan_logo }}</span>
                @else
                    <div style="display: flex; align-items: center; justify-content: center; width: 48px; height: 48px; border-radius: 8px; background: #e0e7ff; color: var(--primary);">
                        <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <circle cx="12" cy="12" r="6"></circle>
                            <circle cx="12" cy="12" r="2"></circle>
                        </svg>
                    </div>
                    <span style="font-size: 0.8rem; color: var(--backoffice-muted);">Menggunakan ikon bawaan (Target)</span>
                @endif
            </div>
            <label for="tujuan_logo">Ganti Logo Tujuan (Menggunakan File Gambar)</label>
            <input type="file" id="tujuan_logo" name="tujuan_logo" accept="image/*" class="admin-form-control">
        </div>


        <!-- SECTION 5: ARTI LOGO -->
        <h3 class="section-divider">5. Arti Logo Yayasan</h3>

        <div class="admin-form-group">
            <label for="arti_logo">Teks Arti Logo</label>
            <textarea id="arti_logo" name="arti_logo" class="admin-form-control" rows="3" required>{{ old('arti_logo', $arti_logo) }}</textarea>
        </div>

        <div class="admin-form-group">
            <label>Logo/Icon Arti Logo Aktif</label>
            <div class="preview-container">
                @if($arti_logo_logo && file_exists(public_path('images/' . $arti_logo_logo)))
                    <img src="{{ asset('images/' . $arti_logo_logo) }}" alt="Arti Logo" class="preview-img">
                    <span style="font-size: 0.8rem; color: var(--backoffice-muted);">File: {{ $arti_logo_logo }}</span>
                @else
                    <div style="display: flex; align-items: center; justify-content: center; width: 48px; height: 48px; border-radius: 8px; background: #e0e7ff; color: #6366f1;">
                        <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"></path>
                        </svg>
                    </div>
                    <span style="font-size: 0.8rem; color: var(--backoffice-muted);">Menggunakan ikon bawaan (Bintang)</span>
                @endif
            </div>
            <label for="arti_logo_logo">Ganti Logo Arti Logo (Menggunakan File Gambar)</label>
            <input type="file" id="arti_logo_logo" name="arti_logo_logo" accept="image/*" class="admin-form-control">
        </div>


        <!-- SECTION 6: MENU NAVIGASI (NAVBAR) -->
        <h3 class="section-divider">6. Menu Navigasi (Navbar)</h3>
        <p style="color: var(--backoffice-muted); font-size: 0.88rem; margin-top: -10px; margin-bottom: 25px; line-height: 1.5;">
            Sesuaikan nama menu (Judul) and tujuan tautan (Link) yang tampil pada bilah navigasi utama website. 
            Gunakan format hash seperti <code>#tentang_kami</code> untuk merujuk ke bagian halaman utama, atau path seperti <code>/berita</code> untuk mengarah ke halaman lain.
        </p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 25px;">
            <div style="background: #f8fafc; border: 1px solid var(--backoffice-border); padding: 15px; border-radius: var(--radius-sm);">
                <h4 style="margin-bottom: 12px; color: var(--backoffice-primary); font-size: 0.95rem;">🔗 Menu 1</h4>
                <div class="admin-form-group">
                    <label for="nav_title_1">Judul Menu 1</label>
                    <input type="text" id="nav_title_1" name="nav_title_1" class="admin-form-control" value="{{ old('nav_title_1', $nav_title_1) }}" required>
                </div>
                <div class="admin-form-group">
                    <label for="nav_link_1">Tujuan Link 1</label>
                    <input type="text" id="nav_link_1" name="nav_link_1" class="admin-form-control" value="{{ old('nav_link_1', $nav_link_1) }}" required>
                </div>
            </div>

            <div style="background: #f8fafc; border: 1px solid var(--backoffice-border); padding: 15px; border-radius: var(--radius-sm);">
                <h4 style="margin-bottom: 12px; color: var(--backoffice-primary); font-size: 0.95rem;">🔗 Menu 2</h4>
                <div class="admin-form-group">
                    <label for="nav_title_2">Judul Menu 2</label>
                    <input type="text" id="nav_title_2" name="nav_title_2" class="admin-form-control" value="{{ old('nav_title_2', $nav_title_2) }}" required>
                </div>
                <div class="admin-form-group">
                    <label for="nav_link_2">Tujuan Link 2</label>
                    <input type="text" id="nav_link_2" name="nav_link_2" class="admin-form-control" value="{{ old('nav_link_2', $nav_link_2) }}" required>
                </div>
            </div>

            <div style="background: #f8fafc; border: 1px solid var(--backoffice-border); padding: 15px; border-radius: var(--radius-sm);">
                <h4 style="margin-bottom: 12px; color: var(--backoffice-primary); font-size: 0.95rem;">🔗 Menu 3</h4>
                <div class="admin-form-group">
                    <label for="nav_title_3">Judul Menu 3</label>
                    <input type="text" id="nav_title_3" name="nav_title_3" class="admin-form-control" value="{{ old('nav_title_3', $nav_title_3) }}" required>
                </div>
                <div class="admin-form-group">
                    <label for="nav_link_3">Tujuan Link 3</label>
                    <input type="text" id="nav_link_3" name="nav_link_3" class="admin-form-control" value="{{ old('nav_link_3', $nav_link_3) }}" required>
                </div>
            </div>

            <div style="background: #f8fafc; border: 1px solid var(--backoffice-border); padding: 15px; border-radius: var(--radius-sm);">
                <h4 style="margin-bottom: 12px; color: var(--backoffice-primary); font-size: 0.95rem;">🔗 Menu 4</h4>
                <div class="admin-form-group">
                    <label for="nav_title_4">Judul Menu 4</label>
                    <input type="text" id="nav_title_4" name="nav_title_4" class="admin-form-control" value="{{ old('nav_title_4', $nav_title_4) }}" required>
                </div>
                <div class="admin-form-group">
                    <label for="nav_link_4">Tujuan Link 4</label>
                    <input type="text" id="nav_link_4" name="nav_link_4" class="admin-form-control" value="{{ old('nav_link_4', $nav_link_4) }}" required>
                </div>
            </div>

            <div style="background: #f8fafc; border: 1px solid var(--backoffice-border); padding: 15px; border-radius: var(--radius-sm);">
                <h4 style="margin-bottom: 12px; color: var(--backoffice-primary); font-size: 0.95rem;">🔗 Menu 5</h4>
                <div class="admin-form-group">
                    <label for="nav_title_5">Judul Menu 5</label>
                    <input type="text" id="nav_title_5" name="nav_title_5" class="admin-form-control" value="{{ old('nav_title_5', $nav_title_5) }}" required>
                </div>
                <div class="admin-form-group">
                    <label for="nav_link_5">Tujuan Link 5</label>
                    <input type="text" id="nav_link_5" name="nav_link_5" class="admin-form-control" value="{{ old('nav_link_5', $nav_link_5) }}" required>
                </div>
            </div>

            <div style="background: #f8fafc; border: 1px solid var(--backoffice-border); padding: 15px; border-radius: var(--radius-sm);">
                <h4 style="margin-bottom: 12px; color: var(--backoffice-primary); font-size: 0.95rem;">🔗 Menu 6</h4>
                <div class="admin-form-group">
                    <label for="nav_title_6">Judul Menu 6</label>
                    <input type="text" id="nav_title_6" name="nav_title_6" class="admin-form-control" value="{{ old('nav_title_6', $nav_title_6) }}" required>
                </div>
                <div class="admin-form-group">
                    <label for="nav_link_6">Tujuan Link 6</label>
                    <input type="text" id="nav_link_6" name="nav_link_6" class="admin-form-control" value="{{ old('nav_link_6', $nav_link_6) }}" required>
                </div>
            </div>
        </div>


        <!-- SECTION 7: KONTAK & MEDIA SOSIAL -->
        <h3 class="section-divider">7. Informasi Kontak & Media Sosial</h3>
        
        <div class="admin-form-group">
            <label for="contact_alamat">Alamat Instansi</label>
            <input type="text" id="contact_alamat" name="contact_alamat" class="admin-form-control" value="{{ old('contact_alamat', $contact_alamat) }}" required>
        </div>

        <div class="admin-form-group">
            <label for="contact_telp">No Telepon</label>
            <input type="text" id="contact_telp" name="contact_telp" class="admin-form-control" value="{{ old('contact_telp', $contact_telp) }}" required>
        </div>

        <div class="admin-form-group">
            <label for="contact_email">Alamat Email Resmi</label>
            <input type="email" id="contact_email" name="contact_email" class="admin-form-control" value="{{ old('contact_email', $contact_email) }}" required>
        </div>

        <div class="admin-form-group">
            <label for="contact_ig">Link Instagram Resmi</label>
            <input type="text" id="contact_ig" name="contact_ig" class="admin-form-control" value="{{ old('contact_ig', $contact_ig) }}" required>
        </div>

        <div class="admin-form-group">
            <label for="contact_fb">Link Facebook Resmi</label>
            <input type="text" id="contact_fb" name="contact_fb" class="admin-form-control" value="{{ old('contact_fb', $contact_fb) }}" required>
        </div>

        <div class="admin-form-group">
            <label for="contact_map">Link Google Maps Embed (Alamat Yayasan)</label>
            <input type="text" id="contact_map" name="contact_map" class="admin-form-control" value="{{ old('contact_map', $contact_map) }}" required>
        </div>

        <!-- BUTTON SUBMIT -->
        <div style="margin-top: 45px; border-top: 2px solid var(--backoffice-border); padding-top: 25px;">
            <button type="submit" class="admin-btn admin-btn-success" style="padding: 14px 25px; font-size: 1rem; width: 100%; justify-content: center; font-weight: 700; border-radius: var(--radius-md);">
                💾 Simpan Konten Halaman Utama
            </button>
        </div>
    </form>
</div>

@endsection
