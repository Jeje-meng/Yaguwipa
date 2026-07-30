@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/partner.css') }}">

<section class="partner-portal-section">
    <div class="container">
        <div class="portal-card">
            
            <div class="portal-header" style="display: flex; justify-content: space-between; align-items: center;">
                <h2 class="portal-title">Edit Pengajuan Partner</h2>
                <a href="{{ route('partner.index') }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.9rem;">← Kembali</a>
            </div>

            @if($errors->any())
                <div style="background-color: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 25px; font-size: 0.9rem;">
                    ✗ {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('partner.update', $partner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group-portal">
                    <label for="nama_partner">Nama Lembaga / Instansi / Komunitas</label>
                    <input type="text" id="nama_partner" name="nama_partner" class="form-control-portal" value="{{ old('nama_partner', $partner->nama_partner) }}" required>
                </div>

                <div class="form-group-portal">
                    <label>Logo Sekarang</label>
                    <div style="margin-bottom: 15px;">
                        <img src="{{ file_exists(public_path('partner/' . $partner->logo)) ? asset('partner/' . $partner->logo) : asset('images/' . $partner->logo) }}" alt="Logo" style="height: 100px; width: auto; object-fit: contain; background: #fafafa; border: 1px solid #e2e8f0; padding: 5px; border-radius: 6px;">
                    </div>
                    <label for="logo">Ganti Logo Lembaga (Kosongkan jika tidak diubah)</label>
                    <input type="file" id="logo" name="logo" accept="image/*" class="form-control-portal">
                </div>

                <div style="margin-top: 30px;">
                    <button type="submit" class="btn-submit-donation-main" style="width: 100%; font-weight: 700; padding: 15px; font-size: 1rem; border: none; cursor: pointer;">Simpan Perubahan</button>
                </div>
            </form>

        </div>
    </div>
</section>

@endsection
