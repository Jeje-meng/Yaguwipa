@extends('layouts.admin')

@section('title', 'Daftar Peserta Agenda')

@section('content')

<div class="content-card">
    <div class="card-header-row">
        <div>
            <h2>Daftar Peserta Agenda: {{ $agenda->judul }}</h2>
            <p style="color: var(--backoffice-muted); font-size: 0.85rem; margin: 4px 0 0 0;">
                Waktu Pelaksanaan: {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y') }}
                @if($agenda->tanggal_akhir)
                    - {{ \Carbon\Carbon::parse($agenda->tanggal_akhir)->format('d M Y') }}
                @endif
            </p>
        </div>
        <a href="{{ url('/backoffice/agenda') }}" style="color: var(--admin-text-muted); text-decoration: none;">← Kembali ke Agenda</a>
    </div>

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>No. Anggota</th>
                    <th>Tipe User</th>
                    <th>Waktu Bergabung</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peserta as $p)
                    <tr>
                        <td style="vertical-align: middle;">
                            @if($p->profile && $p->profile !== 'default.png')
                                <img src="{{ asset('images/' . $p->profile) }}" alt="Profile" style="width: 40px; height: 40px; border-radius: 50%; border: 1px solid var(--admin-border); object-fit: cover;">
                            @else
                                <div class="avatar-initials-table" style="margin: 0;">
                                    {{ strtoupper(substr($p->name, 0, 1)) }}
                                </div>
                            @endif
                        </td>
                        <td><strong>{{ $p->name }}</strong></td>
                        <td>{{ $p->email }}</td>
                        <td>
                            @if($p->nomor_anggota)
                                <span style="font-family: monospace; font-weight: 700; color: var(--admin-primary);">{{ $p->nomor_anggota }}</span>
                            @else
                                <span style="color: var(--admin-text-muted); font-style: italic;">Bukan anggota</span>
                            @endif
                        </td>
                        <td>{{ ucfirst($p->usertype) }}</td>
                        <td>{{ $p->pivot->created_at ? $p->pivot->created_at->format('d M Y - H:i') : '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px 20px; color: var(--admin-text-muted);">Belum ada peserta yang mendaftar untuk agenda ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $peserta->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection
