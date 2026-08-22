@extends('layouts.admin')

@section('title', 'Dashboard Utama - ALzis STURR')
@section('page_title', 'PUSAT KONTROL & DASHBOARD')

@section('header_actions')
<div style="display: flex; gap: 10px; align-items: center;">
    @if(Auth::user()->isOwner())
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline btn-sm" style="color: #38bdf8; border-color: rgba(56, 189, 248, 0.4);">
        <i data-lucide="users" style="width: 15px; height: 15px;"></i>
        <span>Kelola Role</span>
    </a>
    @endif
    <a href="{{ route('admin.accounts.create') }}" class="btn btn-primary btn-sm">
        <i data-lucide="plus-circle" style="width: 15px; height: 15px;"></i>
        <span>+ Tambah Stok Baru</span>
    </a>
</div>
@endsection

@section('content')
<div style="display: flex; flex-direction: column; gap: 24px;">

    <!-- Metrics Cards Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px;">
        
        <!-- Stok Ready -->
        <div class="stat-card" style="border-left: 3px solid #34d399;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-title" style="color: #34d399;">Stok Tersedia (Ready)</div>
                    <div class="stat-value" style="color: #fff;">{{ $availableAccounts }} <span style="font-size: 0.9rem; color: var(--text-muted); font-weight: normal;">/ {{ $totalAccounts }} Akun</span></div>
                </div>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(16, 185, 129, 0.15); display: flex; align-items: center; justify-content: center; color: #34d399;">
                    <i data-lucide="check-circle-2" style="width: 20px; height: 20px;"></i>
                </div>
            </div>
            <div style="font-size: 0.75rem; color: #a7f3d0; margin-top: 8px; font-weight: 600;">
                Est. Nilai: Rp {{ number_format($totalStockValue, 0, ',', '.') }}
            </div>
        </div>

        <!-- Akun Terjual -->
        <div class="stat-card" style="border-left: 3px solid #f87171;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-title" style="color: #f87171;">Akun Terjual (Sold)</div>
                    <div class="stat-value" style="color: #fff;">{{ $soldAccounts }} <span style="font-size: 0.9rem; color: var(--text-muted); font-weight: normal;">Transaksi</span></div>
                </div>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(239, 68, 68, 0.15); display: flex; align-items: center; justify-content: center; color: #f87171;">
                    <i data-lucide="shopping-bag" style="width: 20px; height: 20px;"></i>
                </div>
            </div>
            <div style="font-size: 0.75rem; color: #fca5a5; margin-top: 8px; font-weight: 600;">
                Omset Sold: Rp {{ number_format($totalSoldValue, 0, ',', '.') }}
            </div>
        </div>

        <!-- Total Pengguna -->
        <div class="stat-card" style="border-left: 3px solid #38bdf8;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-title" style="color: #38bdf8;">Pengguna & Mitra</div>
                    <div class="stat-value" style="color: #fff;">{{ $totalUsers }} <span style="font-size: 0.9rem; color: var(--text-muted); font-weight: normal;">Terdaftar</span></div>
                </div>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(56, 189, 248, 0.15); display: flex; align-items: center; justify-content: center; color: #38bdf8;">
                    <i data-lucide="users" style="width: 20px; height: 20px;"></i>
                </div>
            </div>
            <div style="font-size: 0.75rem; color: #7dd3fc; margin-top: 8px;">
                {{ $totalAdmins }} Admin | {{ $totalResellers }} Reseller | {{ $totalCustomers }} User
            </div>
        </div>

        <!-- Trafik Views & Wishlist -->
        <div class="stat-card" style="border-left: 3px solid #fbbf24;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-title" style="color: #fbbf24;">Trafik & Minat Pembeli</div>
                    <div class="stat-value" style="color: #fff;">{{ number_format($totalViews) }} <span style="font-size: 0.9rem; color: var(--text-muted); font-weight: normal;">Views</span></div>
                </div>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(245, 158, 11, 0.15); display: flex; align-items: center; justify-content: center; color: #fbbf24;">
                    <i data-lucide="heart" style="width: 20px; height: 20px;"></i>
                </div>
            </div>
            <div style="font-size: 0.75rem; color: #fde68a; margin-top: 8px;">
                {{ $totalWishlists }} Akun Disimpan ke Wishlist
            </div>
        </div>

    </div>

    <!-- Layout 2 Kolom: Stok Terkini & Live Audit Feed -->
    <div style="display: grid; grid-template-columns: 1.4fr 1fr; gap: 24px; align-items: start;">
        
        <!-- Kolom Kiri: Postingan Stok Terkini -->
        <div class="data-table-card">
            <div style="padding: 18px 22px; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
                <h3 class="font-gaming" style="font-size: 1.2rem; color: #fff; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <i data-lucide="gamepad-2" style="width: 18px; height: 18px; color: var(--primary);"></i>
                    Postingan Stok Terkini
                </h3>
                <a href="{{ route('admin.accounts.index') }}" style="font-size: 0.8rem; color: var(--primary); font-weight: 700;">Lihat Semua &rarr;</a>
            </div>

            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Kode & Game</th>
                            <th>Judul Akun</th>
                            <th>Harga Jual</th>
                            <th>Status</th>
                            <th style="text-align: right;">Aksi</th>
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
                                    <div style="font-size: 0.72rem; color: #d8b4fe;">{{ Str::limit($acc->login_bind, 25) }}</div>
                                </td>
                                <td>
                                    <strong style="color: #38bdf8;">{{ $acc->formatted_effective_price }}</strong>
                                </td>
                                <td>
                                    <form action="{{ route('admin.accounts.toggle-status', $acc->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm {{ $acc->status === 'available' ? 'btn-whatsapp' : 'btn-secondary' }}" style="font-size: 0.7rem; padding: 4px 8px;" title="Klik untuk ubah status">
                                            {{ $acc->status === 'available' ? '🟢 Ready' : '🔴 Sold' }}
                                        </button>
                                    </form>
                                </td>
                                <td style="text-align: right;">
                                    <a href="{{ route('admin.accounts.edit', $acc->id) }}" class="btn btn-secondary btn-sm" style="padding: 4px 8px;" title="Edit Akun">
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

        <!-- Kolom Kanan: Live Security & Activity Timeline -->
        <div style="display: flex; flex-direction: column; gap: 24px;">
            
            <!-- Audit Activity Widget -->
            <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 20px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid var(--border-color);">
                    <h3 class="font-gaming" style="font-size: 1.1rem; color: #fff; margin: 0; display: flex; align-items: center; gap: 8px;">
                        <i data-lucide="shield-alert" style="width: 17px; height: 17px; color: #f59e0b;"></i>
                        Log Aktivitas Terkini
                    </h3>
                    <a href="{{ route('admin.logs.index') }}" style="font-size: 0.75rem; color: #fbbf24; font-weight: 700;">Semua Log &rarr;</a>
                </div>

                <div style="display: flex; flex-direction: column; gap: 12px;">
                    @forelse($recentActivityLogs as $log)
                        <div style="background: rgba(15, 23, 42, 0.6); border: 1px solid var(--border-color); border-radius: var(--radius-sm); padding: 10px 12px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                                <div style="font-size: 0.8rem; font-weight: 700; color: #fff;">
                                    {{ $log->user_name }}
                                    <span style="font-size: 0.68rem; color: {{ in_array($log->user_role, ['owner', 'super_admin']) ? '#fbbf24' : '#38bdf8' }};">
                                        ({{ strtoupper($log->user_role) }})
                                    </span>
                                </div>
                                <span style="font-size: 0.7rem; color: var(--text-sub);">
                                    {{ $log->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <div style="font-size: 0.8rem; color: #cbd5e1; line-height: 1.3;">
                                {{ $log->description }}
                            </div>
                        </div>
                    @empty
                        <div style="text-align: center; color: var(--text-sub); padding: 20px; font-size: 0.85rem;">
                            Belum ada catatan aktivitas admin terbaru.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Top Viewed Accounts -->
            <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 20px;">
                <h3 class="font-gaming" style="font-size: 1.1rem; color: #fff; margin-bottom: 14px; display: flex; align-items: center; gap: 8px;">
                    <i data-lucide="trending-up" style="width: 17px; height: 17px; color: var(--primary);"></i>
                    Akun Paling Banyak Dilihat
                </h3>

                <div style="display: flex; flex-direction: column; gap: 10px;">
                    @foreach($topViewed as $top)
                        <div style="background: rgba(15, 23, 42, 0.7); border: 1px solid var(--border-color); border-radius: var(--radius-sm); padding: 10px 12px; display: flex; align-items: center; gap: 10px;">
                            <img src="{{ $top->thumbnail_url }}" alt="{{ $top->title }}" style="width: 42px; height: 42px; object-fit: cover; border-radius: 6px;">
                            <div style="flex: 1; min-width: 0;">
                                <div style="font-size: 0.72rem; color: var(--primary); font-weight: 700;">#{{ $top->code }} ({{ $top->category->name }})</div>
                                <div style="font-size: 0.82rem; font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $top->title }}</div>
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

    </div>

</div>
@endsection
