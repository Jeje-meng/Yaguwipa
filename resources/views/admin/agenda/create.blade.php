@extends('layouts.admin')

@section('title', 'Tambah Agenda Baru')

@section('content')

<div class="content-card" style="max-width: 700px; margin: 0 auto;">
    <div class="card-header-row">
        <h2>Form Tambah Agenda</h2>
        <a href="{{ url('/backoffice/agenda') }}" style="color: var(--admin-text-muted); text-decoration: none;">← Kembali</a>
    </div>

    @if($errors->any())
        <div style="background-color: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 25px; font-size: 0.9rem;">
            ✗ {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ url('/backoffice/agenda/store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="admin-form-group">
            <label for="judul">Judul Agenda</label>
            <input type="text" id="judul" name="judul" class="admin-form-control" placeholder="Contoh: Workshop Digital Marketing" value="{{ old('judul') }}" required>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="admin-form-group">
                <label for="tanggal">Tanggal Mulai</label>
                <input type="date" id="tanggal" name="tanggal" class="admin-form-control" value="{{ old('tanggal') }}" required>
            </div>
            <div class="admin-form-group">
                <label for="tanggal_akhir">Tanggal Akhir (Opsional)</label>
                <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="admin-form-control" value="{{ old('tanggal_akhir') }}">
            </div>
        </div>

        <div class="admin-form-group">
            <label for="lokasi">Lokasi / Tempat</label>
            <input type="text" id="lokasi" name="lokasi" class="admin-form-control" placeholder="Contoh: Ruang Serbaguna Lt. 3 / Zoom Meeting" value="{{ old('lokasi') }}" required>
        </div>

        <div class="admin-form-group">
            <label for="deskripsi">Deskripsi Agenda</label>
            <textarea id="deskripsi" name="deskripsi" class="admin-form-control" rows="5" placeholder="Tuliskan rincian kegiatan..." required>{{ old('deskripsi') }}</textarea>
        </div>

        <div class="admin-form-group">
            <label for="is_donasi">Jenis Agenda (Keikutsertaan)</label>
            <select id="is_donasi" name="is_donasi" class="admin-form-control" style="width: 100%;">
                <option value="0" {{ old('is_donasi') == '0' ? 'selected' : '' }}>Gratis (Siapa pun bisa mendaftar/mengikuti)</option>
                <option value="1" {{ old('is_donasi') == '1' ? 'selected' : '' }}>Memerlukan Donasi / Berbayar</option>
            </select>
        </div>

        <div class="admin-form-group">
            <label for="gambar">Foto Cover Agenda</label>
            <input type="file" id="gambar" name="gambar" accept="image/*" class="admin-form-control" required>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="upload-btn-submit">Simpan & Publikasikan</button>
        </div>
    </form>
</div>

@endsection
