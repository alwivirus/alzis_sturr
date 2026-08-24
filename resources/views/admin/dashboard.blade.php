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
<div style="display: flex; flex-direction: column; gap: 20px;">

    <!-- Metrics Cards Grid -->
    <div class="dashboard-stats-grid">
        
        <!-- Stok Ready -->
        <div class="stat-card" style="border-left: 3px solid var(--primary);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-title" style="color: var(--primary);">Stok Tersedia (Ready)</div>
                    <div class="stat-value" style="color: #fff;">
                        {{ $availableAccounts }} <span style="font-size: 0.76rem; color: var(--text-dim); font-weight: 500;">/ {{ $totalAccounts }}</span>
                    </div>
                </div>
                <div style="width: 34px; height: 34px; border-radius: var(--radius-sm); background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i data-lucide="check-circle" style="width: 18px; height: 18px;"></i>
                </div>
            </div>
            <div style="margin-top: 10px; padding-top: 8px; border-top: 1px solid rgba(255, 255, 255, 0.05); font-size: 0.74rem; color: var(--text-muted); overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                <span>Est:</span>
                <strong style="color: #fff;">Rp {{ number_format($totalStockValue, 0, ',', '.') }}</strong>
            </div>
        </div>

        <!-- Akun Terjual -->
        <div class="stat-card" style="border-left: 3px solid #f43f5e;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-title" style="color: #f43f5e;">Akun Terjual (Sold)</div>
                    <div class="stat-value" style="color: #f43f5e;">
                        {{ $soldAccounts }} <span style="font-size: 0.76rem; color: var(--text-dim); font-weight: 500;">Tx</span>
                    </div>
                </div>
                <div style="width: 34px; height: 34px; border-radius: var(--radius-sm); background: rgba(244, 63, 94, 0.12); color: #f43f5e; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i data-lucide="shopping-bag" style="width: 18px; height: 18px;"></i>
                </div>
            </div>
            <div style="margin-top: 10px; padding-top: 8px; border-top: 1px solid rgba(255, 255, 255, 0.05); font-size: 0.74rem; color: var(--text-muted); overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                <span>Omset:</span>
                <strong style="color: #fff;">Rp {{ number_format($totalSoldValue, 0, ',', '.') }}</strong>
            </div>
        </div>

        <!-- Total Pengguna -->
        <div class="stat-card" style="border-left: 3px solid var(--primary);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-title" style="color: var(--primary);">Pengguna Terdaftar</div>
                    <div class="stat-value" style="color: #fff;">
                        {{ $totalUsers }} <span style="font-size: 0.76rem; color: var(--text-dim); font-weight: 500;">User</span>
                    </div>
                </div>
                <div style="width: 34px; height: 34px; border-radius: var(--radius-sm); background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i data-lucide="users" style="width: 18px; height: 18px;"></i>
                </div>
            </div>
            <div style="margin-top: 10px; padding-top: 8px; border-top: 1px solid rgba(255, 255, 255, 0.05); font-size: 0.74rem; color: var(--text-muted); overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                <strong style="color: var(--primary);">{{ $totalPartners }} Partner</strong> • {{ $totalCustomers }} Member
            </div>
        </div>

        <!-- Trafik Views & Wishlist -->
        <div class="stat-card" style="border-left: 3px solid var(--gold);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-title" style="color: var(--gold);">Trafik & Wishlist</div>
                    <div class="stat-value" style="color: #fff;">
                        {{ number_format($totalViews) }} <span style="font-size: 0.76rem; color: var(--text-dim); font-weight: 500;">Views</span>
                    </div>
                </div>
                <div style="width: 34px; height: 34px; border-radius: var(--radius-sm); background: var(--gold-light); color: var(--gold); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i data-lucide="heart" style="width: 18px; height: 18px;"></i>
                </div>
            </div>
            <div style="margin-top: 10px; padding-top: 8px; border-top: 1px solid rgba(255, 255, 255, 0.05); font-size: 0.74rem; color: var(--text-muted); overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                {{ $totalWishlists }} Disimpan • {{ $partnerAccountsCount }} Akun Mitra
            </div>
        </div>
    </div>

    <!-- Quick Shortcuts -->
    <div class="dashboard-shortcuts-grid">
        <a href="{{ route('admin.accounts.create') }}" class="btn btn-secondary" style="justify-content: flex-start; padding: 12px 14px;">
            <i data-lucide="plus-circle" style="width: 16px; height: 16px; color: var(--primary);"></i>
            <span>+ Tambah Akun</span>
        </a>
        <a href="{{ route('admin.accounts.index', ['creator' => 'partner']) }}" class="btn btn-secondary" style="justify-content: flex-start; padding: 12px 14px; border-color: var(--primary-border);">
            <i data-lucide="users" style="width: 16px; height: 16px; color: var(--primary);"></i>
            <span>Akun Partner</span>
        </a>
        <a href="{{ route('admin.users.index', ['role' => 'partner']) }}" class="btn btn-secondary" style="justify-content: flex-start; padding: 12px 14px;">
            <i data-lucide="user-check" style="width: 16px; height: 16px; color: #fbbf24;"></i>
            <span>Mitra Partner</span>
        </a>
        <a href="{{ route('admin.logs.index') }}" class="btn btn-secondary" style="justify-content: flex-start; padding: 12px 14px;">
            <i data-lucide="shield-check" style="width: 16px; height: 16px; color: #a855f7;"></i>
            <span>Log Audit</span>
        </a>
    </div>

    <!-- Recent Accounts & Activity Logs Split Grid -->
    <div class="dashboard-split-grid">
        
        <!-- Recent Accounts Table Card -->
        <div class="data-table-card">
            <div style="padding: 16px 20px; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center;">
                <h3 style="font-size: 1rem; font-weight: 700; color: #fff;">Stok Akun Terbaru (Owner & Partner)</h3>
                <a href="{{ route('admin.accounts.index') }}" style="font-size: 0.8rem; color: var(--primary); font-weight: 600;">Lihat Semua &rarr;</a>
            </div>

            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Kode & Akun</th>
                            <th>Pembuat</th>
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
                                    @if($acc->user && $acc->user->isPartner())
                                        <span style="font-size: 0.72rem; color: var(--primary); background: var(--primary-light); border: 1px solid var(--primary-border); padding: 2px 6px; border-radius: 4px; font-weight: 700;">
                                            🤝 {{ $acc->user->name }}
                                        </span>
                                    @else
                                        <span style="font-size: 0.72rem; color: #fbbf24; background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.3); padding: 2px 6px; border-radius: 4px; font-weight: 700;">
                                            👑 Owner
                                        </span>
                                    @endif
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
                                <td colspan="6" style="text-align: center; color: var(--text-dim); padding: 30px;">
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
