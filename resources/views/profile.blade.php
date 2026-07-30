@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<section class="profile-section">
    <div class="container">
        
        <div class="profile-grid-layout">
            
            <!-- LEFT COLUMN: Profile Overview -->
            <div class="profile-card-left" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                @if($user->profile && $user->profile !== 'default.png')
                    <img src="{{ asset('images/' . $user->profile) }}" alt="Profile Avatar" class="profile-avatar-large">
                @else
                    <div class="avatar-initials-lg">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
                <h3 class="profile-name">{{ $user->name }}</h3>
                <div class="profile-email">{{ $user->email }}</div>
                <div style="display: flex; flex-direction: column; gap: 10px; align-items: center;">
                    <div>
                        <span class="profile-badge-role">{{ ucfirst($user->role) }}</span>
                    </div>
                    <div>
                        <span style="font-size: 0.8rem; color: var(--text-muted); font-weight: 500;">
                            Tipe Anggota: <strong>{{ ucfirst($user->usertype) }}</strong>
                        </span>
                    </div>
                </div>
                @if($user->profile && $user->profile !== 'default.png')
                    <form action="{{ route('profile.delete-photo') }}" method="POST" style="margin-top: 20px;">
                        @csrf
                        <button type="submit" style="background: none; border: 1px solid #ef4444; color: #ef4444; padding: 6px 14px; border-radius: 8px; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: all 0.2s ease; font-family: inherit;" onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='none'">
                            🗑️ Hapus Foto Profil
                        </button>
                    </form>
                @endif
            </div>

            <!-- RIGHT COLUMN: Profile Settings Form -->
            <div class="profile-card-right">
                <h2 class="form-title">Edit Profil Saya</h2>

                @if(session('success'))
                    <div style="background-color: #d1fae5; color: #065f46; padding: 15px; border-radius: 8px; margin-bottom: 25px; font-weight: 500; font-size: 0.9rem;">
                        ✓ {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div style="background-color: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 25px; font-size: 0.9rem;">
                        ✗ {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group-profile">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="form-control-profile" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="form-group-profile">
                        <label for="profile_image">Foto Profil Baru (Format Gambar)</label>
                        <input type="file" id="profile_image" name="profile_image" accept="image/*" class="form-control-profile">
                        <span style="font-size: 0.75rem; color: var(--text-muted); display: block; margin-top: 5px;">Biarkan kosong jika tidak ingin mengubah foto profil.</span>
                    </div>

                    <div class="form-group-profile">
                        <label for="alamat">Alamat Lengkap</label>
                        <textarea id="alamat" name="alamat" class="form-control-profile" rows="3" placeholder="Masukkan alamat lengkap Anda">{{ old('alamat', $user->alamat) }}</textarea>
                    </div>

                    <h3 style="font-size: 1.1rem; font-weight: 700; color: var(--text-primary); margin-top: 35px; margin-bottom: 20px; border-bottom: 1px solid #e2e8f0; padding-bottom: 8px;">
                        Ganti Password (Opsional)
                    </h3>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group-profile">
                            <label for="password">Password Baru</label>
                            <input type="password" id="password" name="password" class="form-control-profile" placeholder="Minimal 6 karakter">
                        </div>
                        <div class="form-group-profile">
                            <label for="password_confirmation">Konfirmasi Password Baru</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control-profile" placeholder="Ulangi password baru">
                        </div>
                    </div>

                    <div style="margin-top: 35px; border-top: 1px solid #e2e8f0; padding-top: 25px; display: flex; justify-content: space-between; align-items: center;">
                        @if($user->role === 'admin')
                            <a href="{{ url('/backoffice/dashboard') }}" style="color: var(--text-muted); text-decoration: none; font-weight: 500; font-size: 0.9rem;">← Dashboard Admin</a>
                        @else
                            <a href="{{ route('home') }}" style="color: var(--text-muted); text-decoration: none; font-weight: 500; font-size: 0.9rem;">← Kembali ke Beranda</a>
                        @endif
                        
                        <button type="submit" class="btn-submit-donation-main" style="padding: 12px 25px; font-weight: 700; font-size: 0.95rem; border: none; cursor: pointer; border-radius: 8px;">
                            💾 Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

        </div>

        <!-- SECTION RIWAYAT DONASI SAYA -->
        <div style="background: #ffffff; border-radius: var(--radius-md); box-shadow: var(--shadow-lg); padding: 40px; border: 1px solid var(--accent-light); margin-top: 30px;">
            <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--text-primary); margin-top: 0; margin-bottom: 20px; border-bottom: 2px solid var(--accent-light); padding-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #ef4444; flex-shrink: 0;">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
                Riwayat Donasi Saya
            </h3>

            @if($myDonations->isEmpty())
                <div style="text-align: center; padding: 40px 20px; color: var(--text-muted); font-size: 0.95rem;">
                    Anda belum pernah melakukan permohonan donasi di platform kami.
                </div>
            @else
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                        <thead>
                            <tr style="border-bottom: 2px solid #e2e8f0; color: var(--text-primary); font-weight: 700;">
                                <th style="padding: 12px 10px;">ID Donasi</th>
                                <th style="padding: 12px 10px;">Jenis</th>
                                <th style="padding: 12px 10px;">Detail / Nominal</th>
                                <th style="padding: 12px 10px;">Status</th>
                                <th style="padding: 12px 10px;">Tanggal</th>
                                <th style="padding: 12px 10px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($myDonations as $donation)
                                <tr style="border-bottom: 1px solid #e2e8f0; transition: background 0.15s ease;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='transparent'">
                                    <td style="padding: 15px 10px; font-weight: 600; color: var(--text-primary);">
                                        #DON-{{ str_pad($donation->id, 5, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td style="padding: 15px 10px;">
                                        @if($donation->jenis_donasi === 'uang')
                                            <span style="background: #e0f2fe; color: #0369a1; padding: 3px 8px; border-radius: 6px; font-size: 0.75rem; font-weight: 700;">Uang</span>
                                        @else
                                            <span style="background: #fef3c7; color: #b45309; padding: 3px 8px; border-radius: 6px; font-size: 0.75rem; font-weight: 700;">Barang</span>
                                        @endif
                                    </td>
                                    <td style="padding: 15px 10px; font-weight: 500;">
                                        @if($donation->jenis_donasi === 'uang')
                                            Rp {{ number_format($donation->nominal, 0, ',', '.') }}
                                        @else
                                            <span style="display: inline-flex; align-items: center; gap: 4px; vertical-align: middle;">
                                                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #b45309; flex-shrink: 0; vertical-align: middle; margin-top: -2px;">
                                                    <line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line>
                                                    <polygon points="12 22.08 12 12 3 6.92 3 17 12 22.08"></polygon>
                                                    <polygon points="12 22.08 21 17 21 6.92 12 12 12 22.08"></polygon>
                                                    <polygon points="12 12 21 6.92 12 1.84 3 6.92 12 12"></polygon>
                                                    <line x1="12" y1="5.14" x2="12" y2="12"></line>
                                                </svg>
                                                {{ $donation->nama_barang }} (x{{ $donation->jumlah_barang }})
                                            </span>
                                        @endif
                                        <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 3px; font-weight: 400;">
                                            {{ $donation->deskripsi }}
                                        </div>
                                    </td>
                                    <td style="padding: 15px 10px;">
                                        @if($donation->status === 'pending')
                                            <span class="badge-pending">Menunggu Verifikasi</span>
                                        @elseif($donation->status === 'diterima')
                                            <span style="background: #d1fae5; color: #065f46; padding: 3px 10px; border-radius: var(--radius-full); font-size: 0.78rem; font-weight: 600;">Diterima / Terverifikasi</span>
                                        @else
                                            <span style="background: #fee2e2; color: #991b1b; padding: 3px 10px; border-radius: var(--radius-full); font-size: 0.78rem; font-weight: 600;">Ditolak</span>
                                        @endif
                                    </td>
                                    <td style="padding: 15px 10px; color: var(--text-muted); font-size: 0.8rem;">
                                        {{ $donation->created_at->format('d M Y, H:i') }}
                                    </td>
                                    <td style="padding: 15px 10px; text-align: center;">
                                        <div style="display: flex; gap: 8px; justify-content: center; align-items: center;">
                                            @if($donation->status === 'pending')
                                                @if($donation->jenis_donasi === 'uang')
                                                    <a href="{{ route('donasi.payment', $donation->id) }}" style="background: var(--primary); color: #fff; padding: 6px 12px; border-radius: 6px; font-size: 0.8rem; font-weight: 600; text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='var(--primary-dark)'" onmouseout="this.style.background='var(--primary)'">
                                                        Selesaikan Pembayaran
                                                    </a>
                                                @endif
                                                
                                                <form id="cancel-form-{{ $donation->id }}" action="{{ route('donasi.payment.cancel', $donation->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="redirect_to" value="profile">
                                                    <button type="button" onclick="showCancelConfirmation(document.getElementById('cancel-form-{{ $donation->id }}'))" style="background: #ef4444; color: #fff; border: none; padding: 6px 12px; border-radius: 6px; font-size: 0.8rem; font-weight: 600; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='#dc2626'" onmouseout="this.style.background='#ef4444'">
                                                        Batalkan
                                                    </button>
                                                </form>
                                            @else
                                                <span style="color: var(--text-muted); font-size: 0.8rem; font-weight: 500;">Selesai</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- SECTION AGENDA YANG SAYA IKUTI -->
        <div style="background: #ffffff; border-radius: var(--radius-md); box-shadow: var(--shadow-lg); padding: 40px; border: 1px solid var(--accent-light); margin-top: 30px;">
            <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--text-primary); margin-top: 0; margin-bottom: 20px; border-bottom: 2px solid var(--accent-light); padding-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: var(--primary); flex-shrink: 0;">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                Agenda yang Saya Ikuti
            </h3>

            @if($myAgendas->isEmpty())
                <div style="text-align: center; padding: 40px 20px; color: var(--text-muted); font-size: 0.95rem;">
                    Anda belum mendaftar untuk mengikuti agenda kegiatan apa pun.
                </div>
            @else
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                        <thead>
                            <tr style="border-bottom: 2px solid #e2e8f0; color: var(--text-primary); font-weight: 700;">
                                <th style="padding: 12px 10px;">Agenda</th>
                                <th style="padding: 12px 10px;">Tanggal Pelaksanaan</th>
                                <th style="padding: 12px 10px;">Lokasi</th>
                                <th style="padding: 12px 10px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($myAgendas as $agenda)
                                <tr style="border-bottom: 1px solid #e2e8f0; transition: background 0.15s ease;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='transparent'">
                                    <td style="padding: 15px 10px; font-weight: 600; color: var(--text-primary);">
                                        <a href="{{ route('agenda.show', $agenda->id) }}" style="color: var(--text-primary); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-primary)'">
                                            {{ $agenda->judul }}
                                        </a>
                                    </td>
                                    <td style="padding: 15px 10px; color: var(--text-dark);">
                                        @if($agenda->tanggal_akhir && !\Carbon\Carbon::parse($agenda->tanggal_akhir)->isSameDay(\Carbon\Carbon::parse($agenda->tanggal)))
                                            {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y') }} - {{ \Carbon\Carbon::parse($agenda->tanggal_akhir)->format('d M Y') }}
                                        @else
                                            {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y') }}
                                        @endif
                                    </td>
                                    <td style="padding: 15px 10px; color: var(--text-muted);">
                                        {{ $agenda->lokasi }}
                                    </td>
                                    <td style="padding: 15px 10px; text-align: center;">
                                        <form action="{{ route('agenda.batal-ikut', $agenda->id) }}" method="POST" style="margin: 0; display: inline-block;">
                                            @csrf
                                            <button type="submit" style="background: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; padding: 6px 12px; font-size: 0.8rem; font-weight: 700; border-radius: 6px; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#fecaca'" onmouseout="this.style.background='#fee2e2'">
                                                Batalkan Kehadiran
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>
</section>

@endsection
