@extends('layouts.admin')

@section('title', 'Kelola User')

@section('content')

<div class="content-card">
    <div class="card-header-row">
        <h2>Daftar Anggota / Pengguna Terdaftar</h2>
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
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                    <tr>
                        <td style="vertical-align: middle;">
                            @if($u->profile && $u->profile !== 'default.png')
                                <img src="{{ asset('images/' . $u->profile) }}" alt="Profile" style="width: 40px; height: 40px; border-radius: 50%; border: 1px solid var(--admin-border); object-fit: cover;">
                            @else
                                <div class="avatar-initials-table" style="margin: 0;">
                                    {{ strtoupper(substr($u->name, 0, 1)) }}
                                </div>
                            @endif
                        </td>
                        <td><strong>{{ $u->name }}</strong></td>
                        <td>{{ $u->email }}</td>
                        <td>
                            @if($u->nomor_anggota)
                                <span style="font-family: monospace; font-weight: 700; color: var(--admin-primary);">{{ $u->nomor_anggota }}</span>
                            @else
                                <span style="color: var(--admin-text-muted); font-style: italic;">Bukan anggota</span>
                            @endif
                        </td>
                        <td>{{ ucfirst($u->usertype) }}</td>
                        <td>
                            <span class="badge" style="background: {{ $u->role === 'admin' ? '#fee2e2' : '#eff6ff' }}; color: {{ $u->role === 'admin' ? '#991b1b' : '#1e40af' }}; font-weight: 700;">
                                {{ strtoupper($u->role) }}
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 8px;">
                                @if(Auth::id() !== $u->id)
                                    <form action="{{ route('admin.users.toggle', $u->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="admin-btn admin-btn-primary" style="background: #e2e8f0; color: #1e293b; display: inline-flex; align-items: center; gap: 6px;">
                                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                                                <polyline points="23 4 23 10 17 10"></polyline>
                                                <polyline points="1 20 1 14 7 14"></polyline>
                                                <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
                                            </svg>
                                            Ubah ke {{ $u->role === 'admin' ? 'User' : 'Admin' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.users.delete', $u->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini beserta seluruh data terkait?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="admin-btn admin-btn-danger" style="display: inline-flex; align-items: center; gap: 6px;">
                                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                @else
                                    <span style="color: var(--admin-text-muted); font-style: italic; font-size: 0.85rem;">Akun Anda</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px 20px; color: var(--admin-text-muted);">Belum ada user terdaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection
