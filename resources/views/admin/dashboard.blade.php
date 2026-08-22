@extends('layouts.admin')

@section('title', 'Dashboard - ALzis STURR Admin')
@section('page_title', 'RINGKASAN DASHBOARD TOKO')

@section('header_actions')
<a href="{{ route('admin.accounts.create') }}" class="btn btn-primary btn-sm">
    <i data-lucide="plus-circle" style="width: 16px; height: 16px;"></i>
    <span>+ Tambah Stok Akun Baru</span>
</a>
@endsection

@section('content')

<!-- Metrics Cards Grid -->
<div class="admin-stats-grid">
    <div class="admin-stat-card">
        <div style="font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase;">Total Akun di Sistem</div>
        <div class="stat-number" style="font-size: 2.4rem; color: #fff;">{{ $totalAccounts }}</div>
        <div style="font-size: 0.75rem; color: var(--primary); margin-top: 4px;">Semua postingan akun</div>
    </div>

    <div class="admin-stat-card">
        <div style="font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase;">Stok Ready (Tersedia)</div>
        <div class="stat-number" style="font-size: 2.4rem; color: var(--success);">{{ $availableAccounts }}</div>
        <div style="font-size: 0.75rem; color: #34d399; margin-top: 4px;">🟢 Siap dibeli customer</div>
    </div>

    <div class="admin-stat-card">
        <div style="font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase;">Akun Terjual (Sold)</div>
        <div class="stat-number" style="font-size: 2.4rem; color: var(--danger);">{{ $soldAccounts }}</div>
        <div style="font-size: 0.75rem; color: #f87171; margin-top: 4px;">🔴 Transaksi sukses</div>
    </div>

    <div class="admin-stat-card">
        <div style="font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase;">Total Dilihat Customer</div>
        <div class="stat-number" style="font-size: 2.4rem; color: var(--accent-gold);">{{ $totalViews }}x</div>
        <div style="font-size: 0.75rem; color: #fbbf24; margin-top: 4px;">Trafik tayangan akun</div>
    </div>
</div>

<!-- Layout: Latest Accounts Table & Top Viewed -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
    
    <!-- Latest Stock Posts -->
    <div class="data-table-card">
        <div style="padding: 20px; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
            <h3 class="font-gaming" style="font-size: 1.3rem; color: #fff;">Postingan Stok Terkini</h3>
            <a href="{{ route('admin.accounts.index') }}" style="font-size: 0.8rem; color: var(--primary);">Lihat Semua &rarr;</a>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Kode & Game</th>
                        <th>Judul & Bind</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestAccounts as $acc)
                        <tr>
                            <td>
                                <div style="font-family: var(--font-gaming); font-weight: 700; color: var(--primary);">#{{ $acc->code }}</div>
                                <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $acc->category->name }}</div>
                            </td>
                            <td>
                                <div style="font-weight: 600; color: #fff; max-width: 220px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $acc->title }}
                                </div>
                                <div style="font-size: 0.75rem; color: #d8b4fe;">{{ Str::limit($acc->login_bind, 22) }}</div>
                            </td>
                            <td>
                                <strong style="color: #38bdf8;">{{ $acc->formatted_effective_price }}</strong>
                            </td>
                            <td>
                                <form action="{{ route('admin.accounts.toggle-status', $acc->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $acc->status === 'available' ? 'btn-whatsapp' : 'btn-secondary' }}" style="font-size: 0.7rem; padding: 4px 8px;" title="Klik untuk switch status">
                                        {{ $acc->status === 'available' ? '🟢 Ready' : '🔴 Sold' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('admin.accounts.edit', $acc->id) }}" class="btn btn-secondary btn-sm" style="padding: 4px 8px;">
                                    <i data-lucide="edit-3" style="width: 14px; height: 14px;"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: var(--text-sub); padding: 30px;">Belum ada stok akun terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Top Viewed / Popular -->
    <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 24px;">
        <h3 class="font-gaming" style="font-size: 1.3rem; color: #fff; margin-bottom: 18px; display: flex; align-items: center; gap: 8px;">
            <i data-lucide="trending-up" style="width: 18px; height: 18px; color: var(--primary);"></i>
            Akun Paling Banyak Dilihat
        </h3>

        <div style="display: flex; flex-direction: column; gap: 14px;">
            @foreach($topViewed as $top)
                <div style="background: rgba(15, 23, 42, 0.7); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 12px; display: flex; align-items: center; gap: 12px;">
                    <img src="{{ $top->thumbnail_url }}" alt="{{ $top->title }}" style="width: 48px; height: 48px; object-fit: cover; border-radius: var(--radius-sm);">
                    <div style="flex: 1; min-width: 0;">
                        <div style="font-size: 0.75rem; color: var(--primary); font-weight: 700;">#{{ $top->code }} ({{ $top->category->name }})</div>
                        <div style="font-size: 0.85rem; font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $top->title }}</div>
                        <div style="font-size: 0.75rem; color: #38bdf8; font-weight: 700;">{{ $top->formatted_effective_price }}</div>
                    </div>
                    <div style="font-size: 0.8rem; color: var(--accent-gold); font-weight: 700; text-align: right;">
                        {{ $top->views_count }}x
                        <div style="font-size: 0.65rem; color: var(--text-sub);">Views</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

@endsection
