@extends('layouts.admin')

@section('title', 'Kelola Pengguna & Role - ALzis STURR Owner Hub')
@section('page_title', 'MANAJEMEN PENGGUNA & HAK AKSES')

@section('content')
<div style="display: flex; flex-direction: column; gap: 24px;">

    <!-- Stat Cards Overview -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(175px, 1fr)); gap: 16px;">
        <!-- Total Users -->
        <div class="stat-card" style="border-left: 3px solid var(--primary);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-title" style="color: var(--primary);">Total Terdaftar</div>
                    <div class="stat-value" style="color: #fff;">{{ number_format($totalUsers) }}</div>
                </div>
                <div style="width: 34px; height: 34px; border-radius: 8px; background: rgba(245, 158, 11, 0.12); color: var(--primary); display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="users" style="width: 18px; height: 18px;"></i>
                </div>
            </div>
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 6px;">Akun di Database</div>
        </div>

        <!-- Owner Utama -->
        <div class="stat-card" style="border-left: 3px solid #f59e0b;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-title" style="color: #fbbf24;">Owner Utama</div>
                    <div class="stat-value" style="color: #fbbf24;">{{ number_format($totalOwners) }}</div>
                </div>
                <div style="width: 34px; height: 34px; border-radius: 8px; background: rgba(245, 158, 11, 0.15); color: #fbbf24; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="crown" style="width: 18px; height: 18px;"></i>
                </div>
            </div>
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 6px;">Hak Akses Penuh Toko</div>
        </div>

        <!-- Mitra Partner -->
        <div class="stat-card" style="border-left: 3px solid var(--primary);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-title" style="color: var(--primary);">Mitra Partner</div>
                    <div class="stat-value" style="color: var(--primary);">{{ number_format($totalPartners) }}</div>
                </div>
                <div style="width: 34px; height: 34px; border-radius: 8px; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="users" style="width: 18px; height: 18px;"></i>
                </div>
            </div>
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 6px;">Bisa Post & Kelola Akun</div>
        </div>

        <!-- Pelanggan -->
        <div class="stat-card" style="border-left: 3px solid #34d399;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-title" style="color: #34d399;">Pelanggan</div>
                    <div class="stat-value" style="color: #34d399;">{{ number_format($totalCustomers) }}</div>
                </div>
                <div style="width: 34px; height: 34px; border-radius: 8px; background: rgba(52, 211, 153, 0.15); color: #34d399; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="user-check" style="width: 18px; height: 18px;"></i>
                </div>
            </div>
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 6px;">Member Pembeli</div>
        </div>

        @if($totalBanned > 0)
        <!-- Banned Users -->
        <div class="stat-card" style="border-left: 3px solid var(--danger);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-title" style="color: var(--danger);">Akun Diblokir</div>
                    <div class="stat-value" style="color: var(--danger);">{{ number_format($totalBanned) }}</div>
                </div>
                <div style="width: 34px; height: 34px; border-radius: 8px; background: rgba(244, 63, 94, 0.15); color: var(--danger); display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="ban" style="width: 18px; height: 18px;"></i>
                </div>
            </div>
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 6px;">Suspended / Fraud</div>
        </div>
        @endif
    </div>

    <!-- Filter & Search Bar -->
    <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 18px 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.3);">
        <form action="{{ route('admin.users.index') }}" method="GET" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center; justify-content: space-between;">
            <div style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center; flex: 1; min-width: 280px;">
                <!-- Search Input -->
                <div style="position: relative; flex: 1; min-width: 200px;">
                    <i data-lucide="search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; color: var(--text-muted);"></i>
                    <input type="text" name="q" value="{{ request('q') }}" class="input-control" placeholder="Cari nama, email, atau no HP..." style="padding-left: 38px; height: 42px;">
                </div>

                <!-- Role Filter -->
                <select name="role" class="input-control" style="width: auto; height: 42px; min-width: 160px;">
                    <option value="all">Semua Role</option>
                    <option value="owner" {{ request('role') == 'owner' ? 'selected' : '' }}>👑 Owner Utama</option>
                    <option value="partner" {{ request('role') == 'partner' ? 'selected' : '' }}>🤝 Mitra Partner</option>
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
        <div style="padding: 18px 22px; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
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
                        <th style="width: 45px; text-align: center;">No</th>
                        <th>Informasi Akun</th>
                        <th>Kontak & WhatsApp</th>
                        <th>Role & Hak Akses</th>
                        <th>Stok Diposting</th>
                        <th>Status</th>
                        <th>Wishlist</th>
                        <th>Terdaftar</th>
                        <th style="text-align: right; width: 190px;">Aksi Owner</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $u)
                    <tr style="{{ $u->is_banned ? 'background: rgba(239, 68, 68, 0.05);' : '' }}">
                        <td style="color: var(--text-muted); text-align: center; font-weight: 700; font-size: 0.82rem;">{{ $users->firstItem() + $index }}</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 38px; height: 38px; border-radius: 50%; background: {{ $u->isOwner() ? 'linear-gradient(135deg, #f59e0b, #b45309)' : ($u->isPartner() ? 'linear-gradient(135deg, #f59e0b, #f59e0b)' : 'rgba(255, 255, 255, 0.08)') }}; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 800; font-size: 0.88rem; border: 1px solid {{ $u->isOwner() ? '#fbbf24' : ($u->isPartner() ? 'var(--primary)' : 'rgba(255,255,255,0.15)') }}; flex-shrink: 0;">
                                    {{ strtoupper(substr($u->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div style="font-weight: 700; color: #fff; font-size: 0.92rem; display: flex; align-items: center; gap: 6px;">
                                        <span>{{ $u->name }}</span>
                                        @if($u->id === Auth::id())
                                            <span style="font-size: 0.65rem; background: var(--primary-light); color: var(--primary); padding: 2px 6px; border-radius: 4px; border: 1px solid var(--primary-border); font-weight: 800;">Anda</span>
                                        @endif
                                    </div>
                                    <div style="font-size: 0.78rem; color: var(--text-muted); margin-top: 1px;">{{ $u->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($u->phone)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $u->phone) }}" target="_blank" style="color: #34d399; font-size: 0.82rem; font-weight: 600; display: inline-flex; align-items: center; gap: 5px; background: rgba(52, 211, 153, 0.1); border: 1px solid rgba(52, 211, 153, 0.3); padding: 3px 8px; border-radius: 6px;" title="Hubungi via WhatsApp">
                                    <i data-lucide="phone" style="width: 12px; height: 12px;"></i>
                                    <span>{{ $u->phone }}</span>
                                </a>
                            @else
                                <span style="color: var(--text-dim); font-size: 0.8rem;">-</span>
                            @endif
                        </td>
                        <td>
                            <!-- Fast Role Switch Form -->
                            @if(Auth::user()->isOwner() && $u->id !== Auth::id())
                            <form action="{{ route('admin.users.role', $u->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                <select name="role" onchange="if(confirm('Ubah role pengguna {{ $u->name }} menjadi ' + this.options[this.selectedIndex].text + '?')) { this.form.submit(); } else { this.value = '{{ $u->role }}'; }" class="input-control" style="padding: 4px 8px; font-size: 0.78rem; font-weight: 700; height: 32px; width: auto; border-radius: 6px; cursor: pointer;">
                                    <option value="user" {{ $u->role === 'user' ? 'selected' : '' }}>👤 Pelanggan</option>
                                    <option value="partner" {{ $u->role === 'partner' ? 'selected' : '' }}>🤝 Mitra Partner</option>
                                    <option value="owner" {{ $u->role === 'owner' ? 'selected' : '' }}>👑 Owner Utama</option>
                                </select>
                            </form>
                            @else
                                {!! $u->role_badge !!}
                            @endif
                        </td>
                        <td>
                            @if($u->game_accounts_count > 0)
                                <a href="{{ route('admin.accounts.index', ['creator' => $u->id]) }}" style="display: inline-flex; align-items: center; gap: 4px; color: var(--primary); background: var(--primary-light); border: 1px solid var(--primary-border); padding: 2px 7px; border-radius: 6px; font-size: 0.78rem; font-weight: 700; text-decoration: none;" title="Lihat postingan akun oleh pengguna ini">
                                    <i data-lucide="gamepad-2" style="width: 12px; height: 12px;"></i>
                                    <span>{{ $u->game_accounts_count }} Akun</span>
                                </a>
                            @else
                                <span style="color: var(--text-dim); font-size: 0.78rem;">0 Akun</span>
                            @endif
                        </td>
                        <td>
                            @if($u->is_banned)
                                <span class="badge badge-danger" title="{{ $u->ban_reason }}">
                                    <i data-lucide="ban" style="width: 12px; height: 12px;"></i> DIBLOKIR
                                </span>
                            @else
                                <span class="badge badge-success">
                                    <i data-lucide="check" style="width: 12px; height: 12px;"></i> AKTIF
                                </span>
                            @endif
                        </td>
                        <td>
                            <span style="display: inline-flex; align-items: center; gap: 4px; color: #ec4899; background: rgba(236, 72, 153, 0.1); border: 1px solid rgba(236, 72, 153, 0.25); padding: 2px 7px; border-radius: 6px; font-size: 0.78rem; font-weight: 700;">
                                <i data-lucide="heart" style="width: 11px; height: 11px; fill: #ec4899;"></i>
                                <span>{{ $u->wishlists_count }} item</span>
                            </span>
                        </td>
                        <td style="color: var(--text-muted); font-size: 0.8rem; white-space: nowrap;">
                            {{ $u->created_at->format('d M Y') }}
                        </td>
                        <td style="text-align: right;">
                            <div style="display: flex; gap: 6px; justify-content: flex-end; align-items: center;">
                                
                                <!-- Reset Password Trigger -->
                                <button type="button" onclick="openResetModal({{ $u->id }}, '{{ $u->name }}')" class="btn btn-outline btn-sm" style="padding: 5px 8px;" title="Reset Kata Sandi">
                                    <i data-lucide="key" style="width: 13px; height: 13px; color: #fbbf24;"></i>
                                </button>

                                <!-- Toggle Ban / Suspend (Owner & Admin only, cannot ban owner/self) -->
                                @if(!$u->isOwner() && $u->id !== Auth::id())
                                    <form action="{{ route('admin.users.ban', $u->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @if($u->is_banned)
                                            <button type="submit" class="btn btn-outline btn-sm" style="padding: 5px 8px; color: #34d399; border-color: rgba(52, 211, 153, 0.4);" onclick="return confirm('Buka blokir dan aktifkan kembali akun {{ $u->name }}?')" title="Buka Blokir">
                                                <i data-lucide="unlock" style="width: 13px; height: 13px;"></i>
                                                <span style="font-size: 0.75rem;">Unban</span>
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-danger-outline btn-sm" style="padding: 5px 8px;" onclick="return confirm('Blokir akun {{ $u->name }}? Pengguna ini tidak akan bisa login!')" title="Blokir Pengguna">
                                                <i data-lucide="ban" style="width: 13px; height: 13px;"></i>
                                                <span style="font-size: 0.75rem;">Ban</span>
                                            </button>
                                        @endif
                                    </form>

                                    <!-- Delete User -->
                                    <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('PERINGATAN! Anda yakin ingin menghapus permanen pengguna {{ $u->name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" style="padding: 5px 8px;" title="Hapus Pengguna">
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
                            <i data-lucide="user-x" style="width: 36px; height: 36px; margin: 0 auto 10px; display: block; color: var(--text-dim);"></i>
                            Tidak ada data pengguna yang sesuai dengan kriteria pencarian.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
        <div style="padding: 16px 20px; border-top: 1px solid var(--border-color); display: flex; justify-content: center;">
            {{ $users->links() }}
        </div>
        @endif
    </div>

</div>

<!-- Modal Reset Password -->
<div id="resetPasswordModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(8px);">
    <div style="background: #0d1322; border: 1px solid rgba(245, 158, 11, 0.3); border-radius: var(--radius-lg); max-width: 420px; width: 90%; padding: 26px; box-shadow: 0 20px 50px rgba(0,0,0,0.8);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid rgba(255,255,255,0.08);">
            <h3 class="font-gaming" style="font-size: 1.15rem; color: #fff; margin: 0; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="key" style="width: 18px; height: 18px; color: var(--primary);"></i>
                Reset Kata Sandi
            </h3>
            <button type="button" onclick="closeResetModal()" style="background: transparent; border: none; color: var(--text-muted); cursor: pointer; padding: 4px;">
                <i data-lucide="x" style="width: 18px; height: 18px;"></i>
            </button>
        </div>

        <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 16px;">
            Masukkan kata sandi baru untuk <strong id="resetUserName" style="color: #fff;"></strong>:
        </p>

        <form id="resetPasswordForm" method="POST" action="">
            @csrf
            <div style="margin-bottom: 18px;">
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Kata Sandi Baru</label>
                <input type="password" name="new_password" class="input-control" placeholder="Minimal 6 karakter" required minlength="6" style="height: 42px;">
            </div>

            <div style="display: flex; gap: 10px; justify-content: flex-end;">
                <button type="button" onclick="closeResetModal()" class="btn btn-outline" style="padding: 8px 16px;">Batal</button>
                <button type="submit" class="btn btn-primary" style="padding: 8px 18px;">Simpan Kata Sandi</button>
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
