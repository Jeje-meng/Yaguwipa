@extends('layouts.admin')

@section('title', 'Edit Partner')

@section('content')

<div class="content-card" style="max-width: 700px; margin: 0 auto;">
    <div class="card-header-row">
        <h2>Edit Partner: {{ $partner->nama_partner }}</h2>
        <a href="{{ url('/backoffice/partner') }}" style="color: var(--admin-text-muted); text-decoration: none;">← Kembali</a>
    </div>

    @if($errors->any())
        <div style="background-color: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 25px; font-size: 0.9rem;">
            ✗ {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ url('/backoffice/partner/update/' . $partner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="admin-form-group">
            <label for="nama_partner">Nama Lembaga / Instansi / Komunitas</label>
            <input type="text" id="nama_partner" name="nama_partner" class="admin-form-control" value="{{ old('nama_partner', $partner->nama_partner) }}" required>
        </div>

        <div class="admin-form-group">
            <label>Logo Sekarang</label>
            <div style="margin-bottom: 15px;">
                <img src="{{ file_exists(public_path('partner/' . $partner->logo)) ? asset('partner/' . $partner->logo) : asset('images/' . $partner->logo) }}" alt="Logo" style="height: 100px; width: auto; object-fit: contain; background: #fafafa; border: 1px solid #e2e8f0; padding: 5px; border-radius: 6px;">
            </div>
            <label for="logo">Ganti Logo (Kosongkan jika tidak diubah)</label>
            <input type="file" id="logo" name="logo" accept="image/*" class="admin-form-control">
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="admin-btn admin-btn-success" style="padding: 12px 25px; font-size: 0.95rem; width: 100%; justify-content: center;">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

@endsection
