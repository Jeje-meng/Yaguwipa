@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')

<div class="content-card" style="max-width: 800px; margin: 0 auto;">
    <div class="card-header-row">
        <h2>Edit Berita: {{ $berita->judul }}</h2>
        <a href="{{ url('/backoffice/berita') }}" style="color: var(--admin-text-muted); text-decoration: none;">← Kembali</a>
    </div>

    @if($errors->any())
        <div style="background-color: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 25px; font-size: 0.9rem;">
            ✗ {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ url('/backoffice/berita/update/' . $berita->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="admin-form-group">
            <label for="judul">Judul Berita</label>
            <input type="text" id="judul" name="judul" class="admin-form-control" value="{{ old('judul', $berita->judul) }}" required>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="admin-form-group">
                <label for="tanggal">Tanggal Rilis</label>
                <input type="date" id="tanggal" name="tanggal" class="admin-form-control" value="{{ old('tanggal', $berita->tanggal) }}" required>
            </div>
            
            <div class="admin-form-group">
                <label for="is_active">Status Publikasi</label>
                <select id="is_active" name="is_active" class="admin-form-control" required>
                    <option value="publish" {{ old('is_active', $berita->is_active) === 'publish' ? 'selected' : '' }}>Diterbitkan (Publish)</option>
                    <option value="draft" {{ old('is_active', $berita->is_active) === 'draft' ? 'selected' : '' }}>Simpan Draft (Draft)</option>
                </select>
            </div>
        </div>

        <div class="admin-form-group">
            <label for="body">Konten / Isi Berita</label>
            <textarea id="body" name="body" class="admin-form-control" rows="12" required>{{ old('body', $berita->body) }}</textarea>
        </div>

        <div class="admin-form-group">
            <label>Cover Berita Sekarang</label>
            <div style="margin-bottom: 10px;">
                <img src="{{ file_exists(public_path('news/' . $berita->gambar_berita)) ? asset('news/' . $berita->gambar_berita) : asset('images/' . $berita->gambar_berita) }}" alt="News" style="max-height: 180px; border-radius: 6px; border: 1px solid #e2e8f0;">
            </div>
            <label for="gambar_berita">Ganti Foto Cover (Kosongkan jika tidak diubah)</label>
            <input type="file" id="gambar_berita" name="gambar_berita" accept="image/*" class="admin-form-control">
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="upload-btn-submit">Simpan Perubahan</button>
        </div>
    </form>
</div>

@endsection
