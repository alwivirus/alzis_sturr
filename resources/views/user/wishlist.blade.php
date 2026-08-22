@extends('layouts.app')

@section('title', 'Wishlist Akun Saya - ALzis STURR')

@section('content')
<div class="container" style="padding: 40px 20px 80px; max-width: 1280px;">
    <!-- Wishlist Header -->
    <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; margin-bottom: 30px; border-bottom: 1px solid var(--border-color); padding-bottom: 20px;">
        <div>
            <span class="text-gradient-cyan" style="font-size: 0.85rem; font-weight: 800; letter-spacing: 1px;">KOLEKSI FAVORIT PRIBADI</span>
            <h1 class="font-gaming" style="font-size: 2.2rem; color: #fff; margin-top: 4px;">
                WISHLIST <span class="text-gradient-cyan">AKUN SULTAN SAYA</span>
            </h1>
            <p style="color: var(--text-muted); font-size: 0.95rem; margin-top: 4px;">
                Daftar akun game favorit yang telah Anda simpan agar mudah dipantau dan dibeli sewaktu-waktu.
            </p>
        </div>

        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="background: rgba(15, 23, 42, 0.8); border: 1px solid var(--border-glow); padding: 8px 18px; border-radius: var(--radius-full); font-size: 0.9rem; color: #fff; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="heart" style="width: 18px; height: 18px; color: #f43f5e; fill: #f43f5e;"></i>
                <span>Total Tersimpan: <strong id="wishlist-total-header" style="color: #38bdf8;">{{ $totalCount ?? $wishlists->count() }} Akun</strong></span>
            </div>
            <a href="{{ route('catalog') }}" class="btn btn-secondary btn-sm">
                <i data-lucide="plus" style="width: 16px; height: 16px;"></i>
                <span>Tambah Stok Lain</span>
            </a>
        </div>
    </div>

    @if($wishlists->count() > 0)
        <div class="accounts-grid" id="wishlist-grid">
            @foreach($wishlists as $item)
                @php $acc = $item->gameAccount; @endphp
                @if($acc)
                    <div class="account-card" id="wishlist-card-{{ $acc->id }}" style="transition: all 0.3s ease;">
                        <div class="account-media">
                            <img src="{{ $acc->thumbnail_url }}" alt="{{ $acc->title }}" class="account-thumb" loading="lazy">
                            
                            @if($acc->status === 'available')
                                <span class="badge-status badge-available">
                                    <span style="width: 7px; height: 7px; border-radius: 50%; background: #fff; display: inline-block;"></span>
                                    Ready Stok
                                </span>
                            @else
                                <span class="badge-status badge-sold">
                                    <span style="width: 7px; height: 7px; border-radius: 50%; background: #fff; display: inline-block;"></span>
                                    Terjual (Sold)
                                </span>
                            @endif

                            @if($acc->discount_price)
                                <span class="badge-discount-ribbon">
                                    HEMAT {{ $acc->discount_percent }}%
                                </span>
                            @endif

                            <span class="badge-code">#{{ $acc->code }}</span>
                        </div>

                        <div class="account-body">
                            <div class="account-category-name">{{ $acc->category ? $acc->category->name : 'Game Account' }}</div>
                            <h3 class="account-card-title">
                                <a href="{{ route('account.show', $acc->slug) }}">{{ $acc->title }}</a>
                            </h3>

                            <div class="account-tags-row">
                                <span class="tag-badge tag-server">{{ $acc->server }}</span>
                                <span class="tag-badge tag-bind">{{ Str::limit($acc->login_bind, 18) }}</span>
                            </div>

                            <div class="account-pricing">
                                <div class="price-box">
                                    <span class="price-main">{{ $acc->formatted_effective_price }}</span>
                                    @if($acc->discount_price)
                                        <span class="price-original" style="font-size: 0.75rem; color: var(--text-sub); text-decoration: line-through; display: block;">
                                            {{ $acc->formatted_price }}
                                        </span>
                                    @endif
                                </div>

                                <div class="account-actions">
                                    <button class="btn btn-secondary btn-icon btn-toggle-wishlist" data-id="{{ $acc->id }}" data-remove-card="true" title="Hapus dari Wishlist" style="color: #f43f5e; border-color: rgba(244, 63, 94, 0.4); background: rgba(244, 63, 94, 0.08);">
                                        <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                                    </button>
                                    <a href="{{ route('account.show', $acc->slug) }}" class="btn btn-primary btn-sm">
                                        <span>Detail</span>
                                        <i data-lucide="chevron-right" style="width: 14px; height: 14px;"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div style="display: flex; justify-content: center; margin-top: 40px;">
            {{ $wishlists->links() }}
        </div>
    @else
        <div id="wishlist-empty-box" style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 60px 20px; text-align: center; box-shadow: var(--shadow-card);">
            <div style="width: 76px; height: 76px; border-radius: 50%; background: rgba(0, 242, 254, 0.1); border: 1px solid var(--border-glow); display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px; box-shadow: 0 0 25px rgba(0, 242, 254, 0.2);">
                <i data-lucide="heart" style="width: 38px; height: 38px; color: #f43f5e; opacity: 0.6;"></i>
            </div>
            <h3 class="font-gaming" style="font-size: 1.8rem; color: #fff; margin-bottom: 8px;">Wishlist Anda Masih Kosong</h3>
            <p style="color: var(--text-muted); max-width: 460px; margin: 0 auto 24px; font-size: 0.95rem; line-height: 1.6;">
                Belum ada akun game yang Anda simpan. Tekan ikon hati <i data-lucide="heart" style="width: 14px; height: 14px; color: #f43f5e; display: inline-block; vertical-align: -2px;"></i> pada katalog akun untuk menyimpannya di sini.
            </p>
            <a href="{{ route('catalog') }}" class="btn btn-primary btn-lg" style="display: inline-flex; align-items: center; gap: 8px;">
                <i data-lucide="gamepad-2" style="width: 20px; height: 20px;"></i>
                <span>Jelajahi Katalog Akun Sekarang</span>
            </a>
        </div>
    @endif
</div>
@endsection
