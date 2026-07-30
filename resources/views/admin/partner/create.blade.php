@extends('layouts.admin')

@section('title', 'Tambah Partner Baru')

@section('content')

<div class="content-card" style="max-width: 700px; margin: 0 auto;">
    <div class="card-header-row">
        <h2>Form Tambah Partner</h2>
        <a href="{{ url('/backoffice/partner') }}" style="color: var(--admin-text-muted); text-decoration: none;">← Kembali</a>
    </div>

    @if($errors->any())
        <div style="background-color: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 25px; font-size: 0.9rem;">
            ✗ {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ url('/backoffice/partner/store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="admin-form-group">
            <label for="nama_partner">Nama Lembaga / Instansi / Komunitas</label>
            <input type="text" id="nama_partner" name="nama_partner" class="admin-form-control" placeholder="Contoh: Universitas Guna Dharma" value="{{ old('nama_partner') }}" required>
        </div>

        <div class="admin-form-group">
            <label for="logo">Logo Lembaga (Format Gambar)</label>
            <input type="file" id="logo" name="logo" accept="image/*" class="admin-form-control" required>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="admin-btn admin-btn-success" style="padding: 12px 25px; font-size: 0.95rem; width: 100%; justify-content: center;">
                Simpan & Tambahkan Partner
            </button>
        </div>
    </form>
</div>

@endsection
