@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/partner.css') }}">

<section class="partner-portal-section">
    <div class="container">
        <div class="portal-card">
            
            <div class="portal-header">
                <h2 class="portal-title">Kemitraan (Partner)</h2>
                <p style="color: var(--text-muted); margin: 5px 0 0 0; font-size: 0.95rem;">Kelola dan daftarkan logo lembaga/instansi Anda di website Yayasan Guna Widya Paramesthi.</p>
            </div>

            @if(session('success'))
                <div style="background-color: #d1fae5; color: #065f46; padding: 15px; border-radius: 8px; margin-bottom: 25px; font-weight: 500; font-size: 0.9rem;">
                    ✓ {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div style="background-color: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 25px; font-weight: 500; font-size: 0.9rem;">
                    ✗ {{ session('error') }}
                </div>
            @endif
            @if($errors->any())
                <div style="background-color: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 25px; font-size: 0.9rem;">
                    ✗ {{ $errors->first() }}
                </div>
            @endif

            <div class="partner-grid-layout">
                
                <!-- KIRI: DAFTAR PARTNER SAYA -->
                <div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--text-primary); margin-top: 0; margin-bottom: 20px;">Daftar Kemitraan Anda</h3>
                    <div style="overflow-x: auto;">
                        <table class="partner-table">
                            <thead>
                                <tr>
                                    <th>Logo</th>
                                    <th>Nama Lembaga</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($partner as $p)
                                    <tr>
                                        <td>
                                            <img src="{{ file_exists(public_path('partner/' . $p->logo)) ? asset('partner/' . $p->logo) : asset('images/' . $p->logo) }}" alt="Logo" style="height: 40px; width: auto; object-fit: contain; background: #fafafa; border: 1px solid #e2e8f0; padding: 3px; border-radius: 4px;">
                                        </td>
                                        <td><strong>{{ $p->nama_partner }}</strong></td>
                                        <td>
                                            <span class="badge-status badge-{{ $p->status === 'disetujui' ? 'approved' : ($p->status === 'ditolak' ? 'rejected' : 'pending') }}">
                                                {{ $p->status }}
                                            </span>
                                        </td>
                                        <td>{{ $p->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            @if($p->status === 'pending')
                                                <div style="display: flex; gap: 8px;">
                                                    <a href="{{ route('partner.edit', $p->id) }}" class="btn-action btn-edit">✏️ Edit</a>
                                                    <form action="{{ route('partner.delete', $p->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pengajuan partner ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-action btn-cancel">🗑️ Batal</button>
                                                    </form>
                                                </div>
                                            @else
                                                <span style="color: var(--text-muted); font-size: 0.85rem; font-style: italic;">Verified</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center; padding: 40px 20px; color: var(--text-muted);">Belum ada riwayat kemitraan yang dikirim.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- KANAN: FORM TAMBAH PARTNER LANGSUNG -->
                <div>
                    <div style="background: #f8fafc; border: 1px solid var(--accent-light); padding: 30px; border-radius: var(--radius-md);">
                        <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--text-primary); margin-top: 0; margin-bottom: 20px;">Ajukan Partner Baru</h3>
                        
                        <form action="{{ route('partner.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group-portal">
                                <label for="nama_partner">Nama Lembaga / Komunitas</label>
                                <input type="text" id="nama_partner" name="nama_partner" class="form-control-portal" placeholder="Contoh: Universitas Guna Dharma" required>
                            </div>

                            <div class="form-group-portal">
                                <label for="logo">Logo Lembaga (Format Gambar)</label>
                                <input type="file" id="logo" name="logo" accept="image/*" class="form-control-portal" required>
                            </div>

                            <div style="margin-top: 30px;">
                                <button type="submit" class="btn-submit-donation-main" style="width: 100%; font-weight: 700; padding: 15px; font-size: 1rem; border: none; cursor: pointer;">
                                    Ajukan Kemitraan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div style="margin-top: 40px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
                <a href="{{ route('home') }}" style="color: var(--text-muted); text-decoration: none; font-weight: 500; font-size: 0.95rem;">← Kembali ke Beranda</a>
            </div>

        </div>
    </div>
</section>

@endsection
