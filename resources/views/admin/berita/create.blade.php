@extends('layouts.admin')

@section('title', 'Tambah Berita Baru')

@section('content')

<div class="content-card" style="max-width: 800px; margin: 0 auto;">
    <div class="card-header-row">
        <h2>Form Tulis Berita</h2>
        <a href="{{ url('/backoffice/berita') }}" style="color: var(--admin-text-muted); text-decoration: none;">← Kembali</a>
    </div>

    @if($errors->any())
        <div style="background-color: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 25px; font-size: 0.9rem;">
            ✗ {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ url('/backoffice/berita/store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="admin-form-group">
            <label for="judul">Judul Berita</label>
            <input type="text" id="judul" name="judul" class="admin-form-control" placeholder="Tuliskan judul berita yang menarik..." value="{{ old('judul') }}" required>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="admin-form-group">
                <label for="tanggal">Tanggal Rilis</label>
                <input type="date" id="tanggal" name="tanggal" class="admin-form-control" value="{{ old('tanggal', date('Y-m-d')) }}" required>
            </div>
            
            <div class="admin-form-group">
                <label for="is_active">Status Publikasi</label>
                <select id="is_active" name="is_active" class="admin-form-control" required>
                    <option value="publish" {{ old('is_active') === 'publish' ? 'selected' : '' }}>Langsung Terbitkan (Publish)</option>
                    <option value="draft" {{ old('is_active') === 'draft' ? 'selected' : '' }}>Simpan sebagai Draft (Draft)</option>
                </select>
            </div>
        </div>

        <div class="admin-form-group">
            <label for="body">Konten / Isi Berita</label>
            <textarea id="body" name="body" class="admin-form-control" rows="12" placeholder="Tulis isi berita selengkapnya disini..." required>{{ old('body') }}</textarea>
        </div>

        <div class="admin-form-group">
            <label for="gambar_berita">Foto Cover Berita</label>
            <input type="file" id="gambar_berita" name="gambar_berita" accept="image/*" class="admin-form-control" required>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="upload-btn-submit">Simpan Berita</button>
        </div>
    </form>
</div>

@endsection
