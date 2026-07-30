@extends('layouts.admin')

@section('title', 'Unggah Foto Galeri')

@section('content')

<div class="content-card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header-row">
        <h2>Unggah Foto Kegiatan</h2>
        <a href="{{ url('/backoffice/gallery') }}" style="color: var(--admin-text-muted); text-decoration: none;">← Kembali</a>
    </div>

    @if($errors->any())
        <div style="background-color: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 25px; font-size: 0.9rem;">
            ✗ {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ url('/backoffice/gallery/store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="admin-form-group">
            <label for="judul">Judul Kegiatan / Keterangan</label>
            <input type="text" id="judul" name="judul" class="admin-form-control" placeholder="Contoh: Bakti Sosial Kebersihan Pantai" value="{{ old('judul') }}" required>
        </div>

        <div class="admin-form-group">
            <label for="gambar">Pilih Foto</label>
            <input type="file" id="gambar" name="gambar" accept="image/*" class="admin-form-control" required>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="upload-btn-submit">Unggah Foto</button>
        </div>
    </form>
</div>

@endsection
