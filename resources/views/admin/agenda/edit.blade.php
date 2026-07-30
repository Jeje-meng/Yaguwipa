@extends('layouts.admin')

@section('title', 'Edit Agenda')

@section('content')

<div class="content-card" style="max-width: 700px; margin: 0 auto;">
    <div class="card-header-row">
        <h2>Edit Agenda: {{ $agenda->judul }}</h2>
        <a href="{{ url('/backoffice/agenda') }}" style="color: var(--admin-text-muted); text-decoration: none;">← Kembali</a>
    </div>

    @if($errors->any())
        <div style="background-color: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 25px; font-size: 0.9rem;">
            ✗ {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ url('/backoffice/agenda/update/' . $agenda->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="admin-form-group">
            <label for="judul">Judul Agenda</label>
            <input type="text" id="judul" name="judul" class="admin-form-control" value="{{ old('judul', $agenda->judul) }}" required>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="admin-form-group">
                <label for="tanggal">Tanggal Mulai</label>
                <input type="date" id="tanggal" name="tanggal" class="admin-form-control" value="{{ old('tanggal', $agenda->tanggal) }}" required>
            </div>
            <div class="admin-form-group">
                <label for="tanggal_akhir">Tanggal Akhir (Opsional)</label>
                <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="admin-form-control" value="{{ old('tanggal_akhir', $agenda->tanggal_akhir) }}">
            </div>
        </div>

        <div class="admin-form-group">
            <label for="lokasi">Lokasi / Tempat</label>
            <input type="text" id="lokasi" name="lokasi" class="admin-form-control" value="{{ old('lokasi', $agenda->lokasi) }}" required>
        </div>

        <div class="admin-form-group">
            <label for="deskripsi">Deskripsi Agenda</label>
            <textarea id="deskripsi" name="deskripsi" class="admin-form-control" rows="5" required>{{ old('deskripsi', $agenda->deskripsi) }}</textarea>
        </div>

        <div class="admin-form-group">
            <label for="is_donasi">Jenis Agenda (Keikutsertaan)</label>
            <select id="is_donasi" name="is_donasi" class="admin-form-control" style="width: 100%;">
                <option value="0" {{ old('is_donasi', $agenda->is_donasi) == '0' ? 'selected' : '' }}>Gratis (Siapa pun bisa mendaftar/mengikuti)</option>
                <option value="1" {{ old('is_donasi', $agenda->is_donasi) == '1' ? 'selected' : '' }}>Memerlukan Donasi / Berbayar</option>
            </select>
        </div>

        <div class="admin-form-group">
            <label>Cover Sekarang</label>
            <div style="margin-bottom: 10px;">
                <img src="{{ file_exists(public_path('gallery/' . $agenda->gambar)) ? asset('gallery/' . $agenda->gambar) : asset('images/' . $agenda->gambar) }}" alt="Cover" style="max-height: 150px; border-radius: 6px; border: 1px solid #e2e8f0;">
            </div>
            <label for="gambar">Ganti Foto Cover (Kosongkan jika tidak diubah)</label>
            <input type="file" id="gambar" name="gambar" accept="image/*" class="admin-form-control">
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="upload-btn-submit">Simpan Perubahan</button>
        </div>
    </form>
</div>

@endsection
