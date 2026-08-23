@extends('layouts.partner')

@section('title', 'Dashboard Partner - ALzis STURR')
@section('page_title', 'Dashboard Mitra Partner')

@section('header_actions')
<div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
    <a href="{{ route('partner.accounts.create') }}" class="btn btn-primary btn-sm">
        <i data-lucide="plus" style="width: 15px; height: 15px;"></i>
        <span>+ Post Akun Game Baru</span>
    </a>
</div>
@endsection

@section('content')
<div style="display: flex; flex-direction: column; gap: 24px;">

    <!-- Welcome Banner for Partner -->
    <div style="background: linear-gradient(135deg, rgba(0, 242, 254, 0.12) 0%, rgba(2, 132, 199, 0.12) 100%); border: 1px solid rgba(0, 242, 254, 0.3); border-radius: 14px; padding: 22px 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
        <div>
            <span style="font-size: 0.75rem; font-weight: 800; color: var(--primary); text-transform: uppercase; letter-spacing: 0.5px;">Selamat Datang di Portal Mitra</span>
            <h3 style="font-size: 1.4rem; font-weight: 800; color: #fff; margin-top: 4px; font-family: var(--font-heading);">
                Halo, {{ Auth::user()->name }}! 👋
            </h3>
            <p style="font-size: 0.86rem; color: var(--text-muted); margin-top: 4px; max-width: 650px;">
                Anda dapat menambahkan stok akun game baru, memperbarui spesifikasi, mengatur status ketersediaan stok, dan memantau performa penjualan akun Anda di sini.
            </p>
        </div>
        <div>
            <a href="{{ route('partner.accounts.create') }}" class="btn btn-primary" style="padding: 10px 20px;">
                <i data-lucide="plus-circle" style="width: 16px; height: 16px;"></i>
                <span>Mulai Posting Akun</span>
            </a>
        </div>
    </div>

    <!-- Metrics Cards Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px;">
        
        <!-- Total Akun Saya -->
        <div class="stat-card" style="border-left: 3px solid var(--primary);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-title" style="color: var(--primary);">Total Akun Saya</div>
                    <div class="stat-value" style="color: #fff;">{{ number_format($myAccountsCount) }}</div>
                </div>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(0, 242, 254, 0.15); color: var(--primary); display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="gamepad-2" style="width: 18px; height: 18px;"></i>
                </div>
            </div>
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 6px;">
                Total diposting oleh Anda
            </div>
        </div>

        <!-- Stok Ready -->
        <div class="stat-card" style="border-left: 3px solid #10b981;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-title" style="color: #34d399;">Stok Tersedia (Ready)</div>
                    <div class="stat-value" style="color: #34d399;">{{ number_format($myAvailableCount) }}</div>
                </div>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(16, 185, 129, 0.15); color: #34d399; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="check-circle" style="width: 18px; height: 18px;"></i>
                </div>
            </div>
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 6px;">
                Est. Nilai: <strong style="color: #fff;">Rp {{ number_format($myStockValue, 0, ',', '.') }}</strong>
            </div>
        </div>

        <!-- Akun Terjual -->
        <div class="stat-card" style="border-left: 3px solid #f43f5e;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-title" style="color: #fb7185;">Akun Terjual (Sold)</div>
                    <div class="stat-value" style="color: #fb7185;">{{ number_format($mySoldCount) }}</div>
                </div>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(244, 63, 94, 0.15); color: #fb7185; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="shopping-bag" style="width: 18px; height: 18px;"></i>
                </div>
            </div>
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 6px;">
                Total Sold: <strong style="color: #fff;">Rp {{ number_format($mySoldValue, 0, ',', '.') }}</strong>
            </div>
        </div>

        <!-- Total Views & Wishlist -->
        <div class="stat-card" style="border-left: 3px solid #fbbf24;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-title" style="color: #fbbf24;">Trafik & Wishlist</div>
                    <div class="stat-value" style="color: #fbbf24;">{{ number_format($myTotalViews) }}</div>
                </div>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(251, 191, 36, 0.15); color: #fbbf24; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="eye" style="width: 18px; height: 18px;"></i>
                </div>
            </div>
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 6px;">
                Disukai: <strong style="color: #fff;">{{ number_format($myWishlistsCount) }}</strong> pengguna
            </div>
        </div>

    </div>

    <!-- Quick Shortcuts -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px;">
        <a href="{{ route('partner.accounts.create') }}" class="btn btn-outline" style="justify-content: flex-start; padding: 14px 16px; background: rgba(0, 242, 254, 0.05) !important; border-color: rgba(0, 242, 254, 0.3) !important;">
            <i data-lucide="plus-circle" style="width: 18px; height: 18px; color: var(--primary);"></i>
            <span style="color: #fff;">+ Post Akun Baru</span>
        </a>
        <a href="{{ route('partner.accounts.index') }}" class="btn btn-outline" style="justify-content: flex-start; padding: 14px 16px;">
            <i data-lucide="list" style="width: 18px; height: 18px; color: #38bdf8;"></i>
            <span>Kelola Daftar Akun</span>
        </a>
        <a href="{{ route('profile') }}" class="btn btn-outline" style="justify-content: flex-start; padding: 14px 16px;">
            <i data-lucide="user-check" style="width: 18px; height: 18px; color: #fbbf24;"></i>
            <span>Edit Profil Partner</span>
        </a>
        <a href="{{ route('home') }}" target="_blank" class="btn btn-outline" style="justify-content: flex-start; padding: 14px 16px;">
            <i data-lucide="external-link" style="width: 18px; height: 18px; color: #34d399;"></i>
            <span>Lihat Etalase Toko</span>
        </a>
    </div>

    <!-- Recent Accounts Table Card -->
    <div class="data-table-card">
        <div style="padding: 16px 20px; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center;">
            <h3 style="font-size: 1.05rem; font-weight: 700; color: #fff; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="clock" style="width: 18px; height: 18px; color: var(--primary);"></i>
                Postingan Akun Terbaru Anda
            </h3>
            <a href="{{ route('partner.accounts.index') }}" style="font-size: 0.82rem; color: var(--primary); font-weight: 700; text-decoration: none;">
                Lihat Semua &rarr;
            </a>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Foto & Kode</th>
                        <th>Judul Postingan</th>
                        <th>Game</th>
                        <th>Harga</th>
                        <th>Status Stok</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentAccounts as $acc)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <img src="{{ $acc->thumbnail_url }}" alt="{{ $acc->title }}" style="width: 44px; height: 44px; object-fit: cover; border-radius: 6px; background: #000; border: 1px solid var(--border);">
                                    <div>
                                        <span style="font-family: monospace; font-weight: 800; color: #fff; font-size: 0.85rem;">#{{ $acc->code }}</span>
                                        @if($acc->is_featured)
                                            <div style="font-size: 0.68rem; color: var(--gold); font-weight: 700;">★ SULTAN</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div style="font-weight: 700; color: #fff; max-width: 280px; line-height: 1.3;">
                                    <a href="{{ route('account.show', $acc->slug) }}" target="_blank" style="color: #fff; text-decoration: none;">
                                        {{ $acc->title }}
                                    </a>
                                </div>
                                <div style="font-size: 0.74rem; color: var(--text-muted); margin-top: 2px;">
                                    {{ $acc->server }} • {{ $acc->login_bind }}
                                </div>
                            </td>
                            <td>
                                <span class="badge" style="background: rgba(0, 242, 254, 0.12); color: var(--primary); border: 1px solid rgba(0, 242, 254, 0.3);">
                                    {{ $acc->category->name }}
                                </span>
                            </td>
                            <td>
                                <div style="font-family: var(--font-heading); font-size: 1rem; font-weight: 800; color: #fff;">
                                    {{ $acc->formatted_effective_price }}
                                </div>
                            </td>
                            <td>
                                <form action="{{ route('partner.accounts.toggle-status', $acc->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm" style="font-size: 0.72rem; padding: 3px 8px; {{ $acc->status === 'available' ? 'background: rgba(16,185,129,0.15); color: #34d399; border: 1px solid rgba(16,185,129,0.3);' : 'background: rgba(244,63,94,0.15); color: #fb7185; border: 1px solid rgba(244,63,94,0.3);' }}" title="Klik untuk switch status">
                                        {{ $acc->status === 'available' ? '🟢 Ready' : '🔴 Sold' }}
                                    </button>
                                </form>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: inline-flex; gap: 6px;">
                                    <a href="{{ route('partner.accounts.edit', $acc->id) }}" class="btn btn-outline btn-sm" style="padding: 4px 8px;" title="Edit Akun">
                                        <i data-lucide="edit-3" style="width: 14px; height: 14px;"></i>
                                    </a>
                                    <a href="{{ route('account.show', $acc->slug) }}" target="_blank" class="btn btn-outline btn-sm" style="padding: 4px 8px;" title="Lihat di Toko">
                                        <i data-lucide="external-link" style="width: 14px; height: 14px;"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: var(--text-dim); padding: 36px;">
                                <i data-lucide="package-open" style="width: 36px; height: 36px; margin: 0 auto 10px; display: block; opacity: 0.5;"></i>
                                Anda belum memiliki postingan akun game. <br>
                                <a href="{{ route('partner.accounts.create') }}" style="color: var(--primary); font-weight: 700; text-decoration: underline; margin-top: 6px; display: inline-block;">+ Posting Akun Pertama Sekarang</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
