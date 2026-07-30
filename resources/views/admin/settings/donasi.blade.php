@extends('layouts.admin')

@section('title', 'Pengaturan Donasi & Pembayaran')

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
</style>

<div class="content-card" style="max-width: 800px; margin: 0 auto;">
    <div class="card-header-row">
        <h2>Pengaturan Donasi & Metode Pembayaran</h2>
    </div>

    @if(session('success'))
        <div style="background-color: #d1fae5; color: #065f46; padding: 15px; border-radius: var(--radius-sm); margin-bottom: 25px; font-size: 0.9rem; font-weight: 500;">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background-color: #fee2e2; color: #991b1b; padding: 15px; border-radius: var(--radius-sm); margin-bottom: 25px; font-size: 0.9rem;">
            ✗ {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('admin.settings.donasi.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- SECTION 1: LOKASI DONASI BARANG -->
        <h3 class="section-divider">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: var(--backoffice-primary); flex-shrink: 0;">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
            </svg>
            1. Lokasi Tujuan Donasi Barang (Google Maps)
        </h3>
        <p style="color: var(--backoffice-muted); font-size: 0.85rem; margin-top: -10px; margin-bottom: 20px; line-height: 1.4;">
            Tentukan 3 alamat utama pos penyerahan barang donasi fisik. Masukkan nama lembaga dan link embed Google Maps (URL di dalam attribute <code>src</code> iframe).
        </p>

        <div style="background: #f8fafc; border: 1px solid var(--backoffice-border); padding: 20px; border-radius: var(--radius-sm); margin-bottom: 25px;">
            <h4 style="margin-top:0; margin-bottom: 15px; color: var(--backoffice-primary); display: flex; align-items: center; gap: 6px; font-size: 0.95rem;">
                📍 Lokasi 1 (Default Aktif)
            </h4>
            <div class="admin-form-group">
                <label for="donasi_nama_1">Nama Lembaga/Tujuan 1</label>
                <input type="text" id="donasi_nama_1" name="donasi_nama_1" class="admin-form-control" value="{{ old('donasi_nama_1', $donasi_nama_1) }}" required>
            </div>
            <div class="admin-form-group">
                <label for="donasi_map_1">Google Maps Embed URL 1</label>
                <input type="text" id="donasi_map_1" name="donasi_map_1" class="admin-form-control" value="{{ old('donasi_map_1', $donasi_map_1) }}" required>
            </div>
        </div>

        <div style="background: #f8fafc; border: 1px solid var(--backoffice-border); padding: 20px; border-radius: var(--radius-sm); margin-bottom: 25px;">
            <h4 style="margin-top:0; margin-bottom: 15px; color: var(--backoffice-primary); display: flex; align-items: center; gap: 6px; font-size: 0.95rem;">
                📍 Lokasi 2
            </h4>
            <div class="admin-form-group">
                <label for="donasi_nama_2">Nama Lembaga/Tujuan 2</label>
                <input type="text" id="donasi_nama_2" name="donasi_nama_2" class="admin-form-control" value="{{ old('donasi_nama_2', $donasi_nama_2) }}" required>
            </div>
            <div class="admin-form-group">
                <label for="donasi_map_2">Google Maps Embed URL 2</label>
                <input type="text" id="donasi_map_2" name="donasi_map_2" class="admin-form-control" value="{{ old('donasi_map_2', $donasi_map_2) }}" required>
            </div>
        </div>

        <div style="background: #f8fafc; border: 1px solid var(--backoffice-border); padding: 20px; border-radius: var(--radius-sm); margin-bottom: 25px;">
            <h4 style="margin-top:0; margin-bottom: 15px; color: var(--backoffice-primary); display: flex; align-items: center; gap: 6px; font-size: 0.95rem;">
                📍 Lokasi 3
            </h4>
            <div class="admin-form-group">
                <label for="donasi_nama_3">Nama Lembaga/Tujuan 3</label>
                <input type="text" id="donasi_nama_3" name="donasi_nama_3" class="admin-form-control" value="{{ old('donasi_nama_3', $donasi_nama_3) }}" required>
            </div>
            <div class="admin-form-group">
                <label for="donasi_map_3">Google Maps Embed URL 3</label>
                <input type="text" id="donasi_map_3" name="donasi_map_3" class="admin-form-control" value="{{ old('donasi_map_3', $donasi_map_3) }}" required>
            </div>
        </div>

        <!-- SECTION 2: METODE PEMBAYARAN YAYASAN -->
        <h3 class="section-divider">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: var(--backoffice-primary); flex-shrink: 0;">
                <rect x="2" y="4" width="20" height="16" rx="2" ry="2"></rect>
                <line x1="12" y1="18" x2="12.01" y2="18"></line>
            </svg>
            2. Metode Pembayaran & Rekening
        </h3>

        <div style="background: #f8fafc; border: 1px solid var(--backoffice-border); padding: 20px; border-radius: var(--radius-sm); margin-bottom: 25px;">
            <h4 style="margin-top: 0; margin-bottom: 15px; color: var(--backoffice-primary); font-size: 1rem; display: flex; align-items: center; gap: 6px;">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: var(--backoffice-primary);">
                    <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
                    <line x1="12" y1="18" x2="12.01" y2="18"></line>
                </svg>
                Metode Pembayaran QRIS
            </h4>
            
            <div class="admin-form-group">
                <label for="pay_qris_qr">File Gambar QR Code QRIS (Maks 4MB)</label>
                @if($pay_qris_qr)
                    <div style="margin-bottom: 10px;">
                        <span style="font-size: 0.8rem; color: var(--text-muted); display: block; margin-bottom: 5px;">QRIS Aktif Saat Ini:</span>
                        <img src="{{ asset('images/' . $pay_qris_qr) }}" alt="QRIS QR" style="max-height: 150px; border: 1px solid var(--backoffice-border); padding: 5px; border-radius: var(--radius-sm); background: #fff; display: block;">
                    </div>
                @endif
                <input type="file" id="pay_qris_qr" name="pay_qris_qr" class="admin-form-control-file" accept="image/*">
            </div>
        </div>

        <div style="background: #f8fafc; border: 1px solid var(--backoffice-border); padding: 20px; border-radius: var(--radius-sm); margin-bottom: 25px;">
            <h4 style="margin-top: 0; margin-bottom: 15px; color: var(--backoffice-primary); font-size: 1rem; display: flex; align-items: center; gap: 6px;">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--backoffice-primary);">
                    <path d="M3 22h18"></path>
                    <path d="M6 22V9M10 22V9M14 22V9M18 22V9"></path>
                    <path d="M3 9h18L12 2 3 9z"></path>
                </svg>
                Rekening Bank (Transfer Bank)
            </h4>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 15px;">
                <div class="admin-form-group">
                    <label for="pay_bank_bca">Nomor Rekening BCA</label>
                    <input type="text" id="pay_bank_bca" name="pay_bank_bca" class="admin-form-control" value="{{ old('pay_bank_bca', $pay_bank_bca) }}" required>
                </div>
                <div class="admin-form-group">
                    <label for="pay_bank_mandiri">Nomor Rekening Mandiri</label>
                    <input type="text" id="pay_bank_mandiri" name="pay_bank_mandiri" class="admin-form-control" value="{{ old('pay_bank_mandiri', $pay_bank_mandiri) }}" required>
                </div>
                <div class="admin-form-group">
                    <label for="pay_bank_bni">Nomor Rekening BNI</label>
                    <input type="text" id="pay_bank_bni" name="pay_bank_bni" class="admin-form-control" value="{{ old('pay_bank_bni', $pay_bank_bni) }}" required>
                </div>
                <div class="admin-form-group">
                    <label for="pay_bank_bri">Nomor Rekening BRI</label>
                    <input type="text" id="pay_bank_bri" name="pay_bank_bri" class="admin-form-control" value="{{ old('pay_bank_bri', $pay_bank_bri) }}" required>
                </div>
            </div>
        </div>

        <div style="background: #f8fafc; border: 1px solid var(--backoffice-border); padding: 20px; border-radius: var(--radius-sm); margin-bottom: 25px;">
            <h4 style="margin-top: 0; margin-bottom: 15px; color: var(--backoffice-primary); font-size: 1rem; display: flex; align-items: center; gap: 6px;">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--backoffice-primary);">
                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                    <line x1="1" y1="10" x2="23" y2="10"></line>
                </svg>
                Nomor Akun E-Wallet
            </h4>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 15px;">
                <div class="admin-form-group">
                    <label for="pay_ewallet_gopay">Nomor GoPay</label>
                    <input type="text" id="pay_ewallet_gopay" name="pay_ewallet_gopay" class="admin-form-control" value="{{ old('pay_ewallet_gopay', $pay_ewallet_gopay) }}" required>
                </div>
                <div class="admin-form-group">
                    <label for="pay_ewallet_ovo">Nomor OVO</label>
                    <input type="text" id="pay_ewallet_ovo" name="pay_ewallet_ovo" class="admin-form-control" value="{{ old('pay_ewallet_ovo', $pay_ewallet_ovo) }}" required>
                </div>
                <div class="admin-form-group">
                    <label for="pay_ewallet_dana">Nomor DANA</label>
                    <input type="text" id="pay_ewallet_dana" name="pay_ewallet_dana" class="admin-form-control" value="{{ old('pay_ewallet_dana', $pay_ewallet_dana) }}" required>
                </div>
                <div class="admin-form-group">
                    <label for="pay_ewallet_linkaja">Nomor LinkAja</label>
                    <input type="text" id="pay_ewallet_linkaja" name="pay_ewallet_linkaja" class="admin-form-control" value="{{ old('pay_ewallet_linkaja', $pay_ewallet_linkaja) }}" required>
                </div>
            </div>
        </div>

        <!-- BUTTON SUBMIT -->
        <div style="margin-top: 45px; border-top: 2px solid var(--backoffice-border); padding-top: 25px;">
            <button type="submit" class="admin-btn admin-btn-success" style="padding: 14px 25px; font-size: 1rem; width: 100%; justify-content: center; font-weight: 700; border-radius: var(--radius-md);">
                💾 Simpan Pengaturan Donasi & Pembayaran
            </button>
        </div>
    </form>
</div>

@endsection
