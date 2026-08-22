@extends('layouts.admin')

@section('title', 'Dashboard Utama - ALzis STURR')
@section('page_title', 'Dashboard & Pusat Kontrol')

@section('header_actions')
<div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
    @if(Auth::user()->isOwner())
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">
        <i data-lucide="users" style="width: 15px; height: 15px;"></i>
        <span>Kelola User</span>
    </a>
    @endif
    <a href="{{ route('admin.accounts.create') }}" class="btn btn-primary btn-sm">
        <i data-lucide="plus" style="width: 15px; height: 15px;"></i>
        <span>+ Tambah Stok Akun</span>
    </a>
</div>
@endsection

@section('content')
<div style="display: flex; flex-direction: column; gap: 24px;">

    <!-- Metrics Cards Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px;">
        
        <!-- Stok Ready -->
        <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 20px;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div style="font-size: 0.75rem; font-weight: 700; color: var(--primary); text-transform: uppercase;">Stok Tersedia (Ready)</div>
                    <div style="font-size: 1.6rem; font-weight: 800; color: #fff; font-family: var(--font-heading); margin-top: 4px;">
                        {{ $availableAccounts }} <span style="font-size: 0.82rem; color: var(--text-dim); font-weight: 500;">/ {{ $totalAccounts }} Akun</span>
                    </div>
                </div>
                <div style="width: 38px; height: 38px; border-radius: var(--radius-sm); background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="check-circle" style="width: 20px; height: 20px;"></i>
                </div>
            </div>
            <div style="margin-top: 12px; padding-top: 10px; border-top: 1px solid rgba(255, 255, 255, 0.05); font-size: 0.78rem; color: var(--text-muted);">
                <span>Est. Nilai:</span>
                <strong style="color: #fff;">Rp {{ number_format($totalStockValue, 0, ',', '.') }}</strong>
            </div>
        </div>

        <!-- Akun Terjual -->
        <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 20px;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div style="font-size: 0.75rem; font-weight: 700; color: #f43f5e; text-transform: uppercase;">Akun Terjual (Sold)</div>
                    <div style="font-size: 1.6rem; font-weight: 800; color: #fff; font-family: var(--font-heading); margin-top: 4px;">
                        {{ $soldAccounts }} <span style="font-size: 0.82rem; color: var(--text-dim); font-weight: 500;">Transaksi</span>
                    </div>
                </div>
                <div style="width: 38px; height: 38px; border-radius: var(--radius-sm); background: rgba(244, 63, 94, 0.12); color: #f43f5e; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="shopping-bag" style="width: 20px; height: 20px;"></i>
                </div>
            </div>
            <div style="margin-top: 12px; padding-top: 10px; border-top: 1px solid rgba(255, 255, 255, 0.05); font-size: 0.78rem; color: var(--text-muted);">
                <span>Omset Sold:</span>
                <strong style="color: #fff;">Rp {{ number_format($totalSoldValue, 0, ',', '.') }}</strong>
            </div>
        </div>

        <!-- Total Pengguna -->
        <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 20px;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div style="font-size: 0.75rem; font-weight: 700; color: var(--accent-blue); text-transform: uppercase;">Pengguna Terdaftar</div>
                    <div style="font-size: 1.6rem; font-weight: 800; color: #fff; font-family: var(--font-heading); margin-top: 4px;">
                        {{ $totalUsers }} <span style="font-size: 0.82rem; color: var(--text-dim); font-weight: 500;">User</span>
                    </div>
                </div>
                <div style="width: 38px; height: 38px; border-radius: var(--radius-sm); background: var(--accent-blue-light); color: var(--accent-blue); display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="users" style="width: 20px; height: 20px;"></i>
                </div>
            </div>
            <div style="margin-top: 12px; padding-top: 10px; border-top: 1px solid rgba(255, 255, 255, 0.05); font-size: 0.78rem; color: var(--text-muted);">
                <strong style="color: var(--gold);">{{ $totalAdmins }} Admin</strong> • {{ $totalCustomers }} Member
            </div>
        </div>

        <!-- Trafik Views & Wishlist -->
        <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 20px;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div style="font-size: 0.75rem; font-weight: 700; color: var(--gold); text-transform: uppercase;">Trafik & Wishlist</div>
                    <div style="font-size: 1.6rem; font-weight: 800; color: #fff; font-family: var(--font-heading); margin-top: 4px;">
                        {{ number_format($totalViews) }} <span style="font-size: 0.82rem; color: var(--text-dim); font-weight: 500;">Views</span>
                    </div>
                </div>
                <div style="width: 38px; height: 38px; border-radius: var(--radius-sm); background: var(--gold-light); color: var(--gold); display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="heart" style="width: 20px; height: 20px;"></i>
                </div>
            </div>
            <div style="margin-top: 12px; padding-top: 10px; border-top: 1px solid rgba(255, 255, 255, 0.05); font-size: 0.78rem; color: var(--text-muted);">
                {{ $totalWishlists }} Akun Disimpan Pembeli
            </div>
        </div>
    </div>

    <!-- Quick Shortcuts -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px;">
        <a href="{{ route('admin.accounts.create') }}" class="btn btn-secondary" style="justify-content: flex-start; padding: 12px 16px;">
            <i data-lucide="plus-circle" style="width: 18px; height: 18px; color: var(--primary);"></i>
            <span>+ Tambah Akun Baru</span>
        </a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary" style="justify-content: flex-start; padding: 12px 16px;">
            <i data-lucide="folder" style="width: 18px; height: 18px; color: var(--accent-blue);"></i>
            <span>Kelola Kategori Game</span>
        </a>
        <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary" style="justify-content: flex-start; padding: 12px 16px;">
            <i data-lucide="settings" style="width: 18px; height: 18px; color: var(--gold);"></i>
            <span>Pengaturan Toko & WA</span>
        </a>
        <a href="{{ route('admin.logs.index') }}" class="btn btn-secondary" style="justify-content: flex-start; padding: 12px 16px;">
            <i data-lucide="shield-check" style="width: 18px; height: 18px; color: #a855f7;"></i>
            <span>Lihat Log Audit</span>
        </a>
    </div>

    <!-- Recent Accounts & Activity Logs Split Grid -->
    <div style="display: grid; grid-template-columns: 1.6fr 1fr; gap: 20px;">
        
        <!-- Recent Accounts Table Card -->
        <div class="data-table-card">
            <div style="padding: 16px 20px; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center;">
                <h3 style="font-size: 1rem; font-weight: 700; color: #fff;">Stok Akun Terbaru</h3>
                <a href="{{ route('admin.accounts.index') }}" style="font-size: 0.8rem; color: var(--primary); font-weight: 600;">Lihat Semua &rarr;</a>
            </div>

            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Kode & Akun</th>
                            <th>Game</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th style="text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestAccounts as $acc)
                            <tr>
                                <td>
                                    <div style="font-weight: 700; color: #fff;">{{ $acc->title }}</div>
                                    <div style="font-size: 0.75rem; color: var(--text-dim); font-family: monospace;">#{{ $acc->code }}</div>
                                </td>
                                <td>
                                    <span class="tag-badge">{{ $acc->category->name }}</span>
                                </td>
                                <td>
                                    <span style="font-weight: 700; color: #fff;">{{ $acc->formatted_effective_price }}</span>
                                </td>
                                <td>
                                    @if($acc->status === 'available')
                                        <span class="tag-badge" style="color: var(--primary); background: var(--primary-light);">Ready</span>
                                    @else
                                        <span class="tag-badge" style="color: var(--danger); background: rgba(244,63,94,0.1);">Sold</span>
                                    @endif
                                </td>
                                <td style="text-align: right;">
                                    <a href="{{ route('admin.accounts.edit', $acc->id) }}" class="btn btn-secondary btn-sm" style="padding: 4px 10px;">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; color: var(--text-dim); padding: 30px;">
                                    Belum ada akun game yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Activity Logs Card -->
        <div class="data-table-card">
            <div style="padding: 16px 20px; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center;">
                <h3 style="font-size: 1rem; font-weight: 700; color: #fff;">Aktivitas & Log Keamanan</h3>
                <a href="{{ route('admin.logs.index') }}" style="font-size: 0.8rem; color: var(--primary); font-weight: 600;">Lihat Semua &rarr;</a>
            </div>

            <div style="padding: 12px 16px; display: flex; flex-direction: column; gap: 10px;">
                @forelse($recentActivityLogs as $log)
                    <div style="padding: 10px; background: var(--bg-surface); border-radius: var(--radius-sm); border: 1px solid var(--border);">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                            <span style="font-size: 0.75rem; font-weight: 700; color: var(--primary);">{{ $log->action }}</span>
                            <span style="font-size: 0.7rem; color: var(--text-dim);">{{ $log->created_at->diffForHumans() }}</span>
                        </div>
                        <p style="font-size: 0.82rem; color: var(--text-muted); line-height: 1.4;">{{ $log->description }}</p>
                        <div style="font-size: 0.72rem; color: var(--text-dim); margin-top: 4px;">Oleh: <strong>{{ $log->user ? $log->user->name : 'System' }}</strong> (IP: {{ $log->ip_address }})</div>
                    </div>
                @empty
                    <div style="text-align: center; color: var(--text-dim); padding: 24px;">Belum ada catatan aktivitas.</div>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection
