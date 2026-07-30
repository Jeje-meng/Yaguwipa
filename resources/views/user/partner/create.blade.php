@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/partner.css') }}">

<section class="partner-portal-section">
    <div class="container">
        <div class="portal-card">
            
            <div class="portal-header" style="display: flex; justify-content: space-between; align-items: center;">
                <h2 class="portal-title">Ajukan Kemitraan (Partner)</h2>
                <a href="{{ route('partner.index') }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.9rem;">← Kembali</a>
            </div>

            @if($errors->any())
                <div style="background-color: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 25px; font-size: 0.9rem;">
                    ✗ {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('partner.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group-portal">
                    <label for="nama_partner">Nama Lembaga / Instansi / Komunitas</label>
                    <input type="text" id="nama_partner" name="nama_partner" class="form-control-portal" placeholder="Contoh: Universitas Guna Dharma" value="{{ old('nama_partner') }}" required>
                </div>

                <div class="form-group-portal">
                    <label for="logo">Unggah Logo Lembaga (Format Gambar)</label>
                    <input type="file" id="logo" name="logo" accept="image/*" class="form-control-portal" required>
                </div>

                <div style="margin-top: 30px;">
                    <button type="submit" class="btn-submit-donation-main" style="width: 100%; font-weight: 700; padding: 15px; font-size: 1rem; border: none; cursor: pointer;">Kirim Pengajuan Kemitraan</button>
                </div>
            </form>

        </div>
    </div>
</section>

@endsection
