@extends('layouts.admin')

@section('title', 'Kelola Pengguna & Role - ALzis STURR Owner Hub')
@section('page_title', 'MANAJEMEN PENGGUNA & HAK AKSES')

@section('content')
<div style="display: flex; flex-direction: column; gap: 24px;">

    <!-- Stat Cards Overview -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)); gap: 16px;">
        <div class="stat-card" style="border-left: 3px solid var(--primary);">
            <div class="stat-title">Total Terdaftar</div>
            <div class="stat-value" style="color: #fff;">{{ number_format($totalUsers) }}</div>
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px;">Akun di Database</div>
        </div>

        <div class="stat-card" style="border-left: 3px solid #f59e0b;">
            <div class="stat-title" style="color: #fbbf24;">Owner Utama</div>
            <div class="stat-value" style="color: #fbbf24;">{{ number_format($totalOwners) }}</div>
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px;">Hak Akses Penuh</div>
        </div>

        <div class="stat-card" style="border-left: 3px solid #00f2fe;">
            <div class="stat-title" style="color: #00f2fe;">Admin Toko</div>
            <div class="stat-value" style="color: #00f2fe;">{{ number_format($totalAdmins) }}</div>
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px;">Pengelola Stok & Konten</div>
        </div>

        <div class="stat-card" style="border-left: 3px solid #c084fc;">
            <div class="stat-title" style="color: #c084fc;">Reseller / Mitra</div>
            <div class="stat-value" style="color: #c084fc;">{{ number_format($totalResellers) }}</div>
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px;">Akun Khusus Reseller</div>
        </div>

        <div class="stat-card" style="border-left: 3px solid #34d399;">
            <div class="stat-title" style="color: #34d399;">Pelanggan</div>
            <div class="stat-value" style="color: #34d399;">{{ number_format($totalCustomers) }}</div>
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px;">Member Pembeli</div>
        </div>

        @if($totalBanned > 0)
        <div class="stat-card" style="border-left: 3px solid var(--danger);">
            <div class="stat-title" style="color: var(--danger);">Akun Diblokir</div>
            <div class="stat-value" style="color: var(--danger);">{{ number_format($totalBanned) }}</div>
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px;">Suspended / Fraud</div>
        </div>
        @endif
    </div>

    <!-- Filter & Search Bar -->
    <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 18px 20px;">
        <form action="{{ route('admin.users.index') }}" method="GET" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center; justify-content: space-between;">
            <div style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center; flex: 1; min-width: 280px;">
                <!-- Search Input -->
                <div style="position: relative; flex: 1; min-width: 200px;">
                    <i data-lucide="search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; color: var(--text-muted);"></i>
                    <input type="text" name="q" value="{{ request('q') }}" class="input-control" placeholder="Cari nama, email, atau no HP..." style="padding-left: 38px; height: 42px;">
                </div>

                <!-- Role Filter -->
                <select name="role" class="input-control" style="width: auto; height: 42px; min-width: 150px;">
                    <option value="all">Semua Role</option>
                    <option value="owner" {{ request('role') == 'owner' ? 'selected' : '' }}>👑 Owner Utama</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>🛡️ Admin Toko</option>
                    <option value="reseller" {{ request('role') == 'reseller' ? 'selected' : '' }}>💎 Reseller / Mitra</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>👤 Pelanggan</option>
                </select>

                <!-- Status Filter -->
                <select name="status" class="input-control" style="width: auto; height: 42px; min-width: 140px;">
                    <option value="all">Semua Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>🟢 Aktif Normal</option>
                    <option value="banned" {{ request('status') == 'banned' ? 'selected' : '' }}>🔴 Diblokir / Banned</option>
                </select>
            </div>

            <div style="display: flex; gap: 8px;">
                <button type="submit" class="btn btn-primary" style="height: 42px; padding: 0 18px;">
                    <i data-lucide="filter" style="width: 16px; height: 16px;"></i>
                    <span>Terapkan Filter</span>
                </button>

                @if(request()->hasAny(['q', 'role', 'status']))
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline" style="height: 42px; padding: 0 14px;">
                    <i data-lucide="x" style="width: 16px; height: 16px;"></i>
                    <span>Reset</span>
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Data Table Card -->
    <div class="data-table-card">
        <div style="padding: 18px 22px; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
            <h3 class="font-gaming" style="font-size: 1.2rem; color: #fff; margin: 0; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="users" style="width: 18px; height: 18px; color: var(--primary);"></i>
                Daftar Seluruh Pengguna & Hak Akses
            </h3>
            <span style="font-size: 0.8rem; color: var(--text-muted);">Menampilkan {{ $users->firstItem() ?? 0 }}-{{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} user</span>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Informasi Akun</th>
                        <th>Kontak / HP</th>
                        <th>Role / Hak Akses</th>
                        <th>Status</th>
                        <th>Wishlist</th>
                        <th>Terdaftar</th>
                        <th style="text-align: right; width: 220px;">Aksi & Pengaturan Owner</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $u)
                    <tr style="{{ $u->is_banned ? 'background: rgba(239, 68, 68, 0.05);' : '' }}">
                        <td style="color: var(--text-muted);">{{ $users->firstItem() + $index }}</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 36px; height: 36px; border-radius: 50%; background: {{ $u->isOwner() ? 'linear-gradient(135deg, #f59e0b, #b45309)' : 'rgba(0, 242, 254, 0.15)' }}; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 800; font-size: 0.85rem; border: 1px solid {{ $u->isOwner() ? '#fbbf24' : 'var(--border-glow)' }};">
                                    {{ strtoupper(substr($u->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div style="font-weight: 700; color: #fff; font-size: 0.95rem;">
                                        {{ $u->name }}
                                        @if($u->id === Auth::id())
                                            <span style="font-size: 0.7rem; background: rgba(0, 242, 254, 0.2); color: #00f2fe; padding: 2px 6px; border-radius: 3px; margin-left: 4px;">Anda</span>
                                        @endif
                                    </div>
                                    <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $u->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($u->phone)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $u->phone) }}" target="_blank" style="color: #34d399; font-size: 0.85rem; display: flex; align-items: center; gap: 4px;">
                                    <i data-lucide="phone" style="width: 13px; height: 13px;"></i>
                                    <span>{{ $u->phone }}</span>
                                </a>
                            @else
                                <span style="color: var(--text-sub); font-size: 0.8rem;">-</span>
                            @endif
                        </td>
                        <td>
                            <!-- Fast Role Switch Form -->
                            @if(Auth::user()->isOwner() && $u->id !== Auth::id())
                            <form action="{{ route('admin.users.role', $u->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                <select name="role" onchange="if(confirm('Ubah role pengguna {{ $u->name }} menjadi ' + this.options[this.selectedIndex].text + '?')) { this.form.submit(); } else { this.value = '{{ $u->role }}'; }" style="background: var(--bg-card); color: #fff; border: 1px solid var(--border-color); border-radius: 4px; padding: 4px 8px; font-size: 0.8rem; font-weight: 600; cursor: pointer;">
                                    <option value="user" {{ $u->role === 'user' ? 'selected' : '' }}>👤 Pelanggan</option>
                                    <option value="reseller" {{ $u->role === 'reseller' ? 'selected' : '' }}>💎 Reseller</option>
                                    <option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>🛡️ Admin Toko</option>
                                    <option value="owner" {{ $u->role === 'owner' ? 'selected' : '' }}>👑 Owner Utama</option>
                                </select>
                            </form>
                            @else
                                {!! $u->role_badge !!}
                            @endif
                        </td>
                        <td>
                            @if($u->is_banned)
                                <span class="badge badge-danger" title="{{ $u->ban_reason }}">
                                    <i data-lucide="ban" style="width: 12px; height: 12px; vertical-align: -1px;"></i> DIBLOKIR
                                </span>
                            @else
                                <span class="badge badge-success">
                                    <i data-lucide="check" style="width: 12px; height: 12px; vertical-align: -1px;"></i> AKTIF
                                </span>
                            @endif
                        </td>
                        <td style="color: var(--text-muted); font-size: 0.85rem;">
                            <span style="color: #ec4899; font-weight: 700;">{{ $u->wishlists_count }}</span> item
                        </td>
                        <td style="color: var(--text-muted); font-size: 0.8rem;">
                            {{ $u->created_at->format('d M Y') }}
                        </td>
                        <td style="text-align: right;">
                            <div style="display: flex; gap: 6px; justify-content: flex-end; align-items: center;">
                                
                                <!-- Reset Password Trigger -->
                                <button type="button" onclick="openResetModal({{ $u->id }}, '{{ $u->name }}')" class="btn btn-outline btn-sm" title="Reset Kata Sandi">
                                    <i data-lucide="key" style="width: 13px; height: 13px;"></i>
                                </button>

                                <!-- Toggle Ban / Suspend (Owner & Admin only, cannot ban owner/self) -->
                                @if(!$u->isOwner() && $u->id !== Auth::id())
                                    <form action="{{ route('admin.users.ban', $u->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @if($u->is_banned)
                                            <button type="submit" class="btn btn-outline btn-sm" style="color: #34d399; border-color: rgba(52, 211, 153, 0.4);" onclick="return confirm('Buka blokir dan aktifkan kembali akun {{ $u->name }}?')" title="Buka Blokir">
                                                <i data-lucide="unlock" style="width: 13px; height: 13px;"></i>
                                                <span>Unban</span>
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-outline btn-sm" style="color: #f87171; border-color: rgba(239, 68, 68, 0.4);" onclick="return confirm('Blokir akun {{ $u->name }}? Pengguna ini tidak akan bisa login!')" title="Blokir Pengguna">
                                                <i data-lucide="ban" style="width: 13px; height: 13px;"></i>
                                                <span>Ban</span>
                                            </button>
                                        @endif
                                    </form>

                                    <!-- Delete User -->
                                    <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('PERINGATAN! Anda yakin ingin menghapus permanen pengguna {{ $u->name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus Pengguna">
                                            <i data-lucide="trash-2" style="width: 13px; height: 13px;"></i>
                                        </button>
                                    </form>
                                @endif

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 40px; color: var(--text-muted);">
                            <i data-lucide="user-x" style="width: 36px; height: 36px; margin: 0 auto 10px; display: block; color: var(--text-sub);"></i>
                            Tidak ada data pengguna yang sesuai dengan kriteria pencarian.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
        <div style="padding: 16px 20px; border-top: 1px solid var(--border-color);">
            {{ $users->links() }}
        </div>
        @endif
    </div>

</div>

<!-- Modal Reset Password -->
<div id="resetPasswordModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div style="background: #0d1322; border: 1px solid var(--border-color); border-radius: var(--radius-md); max-width: 420px; width: 90%; padding: 24px; box-shadow: 0 20px 40px rgba(0,0,0,0.6);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <h3 class="font-gaming" style="font-size: 1.2rem; color: #fff; margin: 0; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="key" style="width: 18px; height: 18px; color: var(--primary);"></i>
                Reset Kata Sandi
            </h3>
            <button type="button" onclick="closeResetModal()" style="background: transparent; border: none; color: var(--text-muted); cursor: pointer;">
                <i data-lucide="x" style="width: 18px; height: 18px;"></i>
            </button>
        </div>

        <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 16px;">
            Masukkan kata sandi baru untuk <strong id="resetUserName" style="color: #fff;"></strong>:
        </p>

        <form id="resetPasswordForm" method="POST" action="">
            @csrf
            <div class="form-group">
                <label class="form-label">Kata Sandi Baru</label>
                <input type="password" name="new_password" class="input-control" placeholder="Minimal 6 karakter" required minlength="6">
            </div>

            <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px;">
                <button type="button" onclick="closeResetModal()" class="btn btn-outline">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Kata Sandi</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openResetModal(userId, userName) {
        document.getElementById('resetUserName').innerText = userName;
        document.getElementById('resetPasswordForm').action = '/admin/users/' + userId + '/password';
        document.getElementById('resetPasswordModal').style.display = 'flex';
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    function closeResetModal() {
        document.getElementById('resetPasswordModal').style.display = 'none';
    }
</script>
@endpush
@endsection
