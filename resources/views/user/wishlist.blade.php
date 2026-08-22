@extends('layouts.app')

@section('title', 'Wishlist Akun Saya - ALzis STURR')

@section('content')
<div class="container" style="padding: 40px 20px 90px; max-width: 1280px;">
    <!-- Wishlist Header Banner -->
    <div style="background: linear-gradient(135deg, rgba(14, 22, 38, 0.9) 0%, rgba(9, 13, 22, 0.95) 100%); border: 1px solid rgba(0, 242, 254, 0.18); border-radius: 20px; padding: 28px 32px; margin-bottom: 36px; position: relative; overflow: hidden; box-shadow: 0 12px 36px -10px rgba(0,0,0,0.7);">
        <div style="position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, #f43f5e, #00f2fe, transparent);"></div>
        
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
            <div>
                <span style="font-size: 0.8rem; font-weight: 800; color: #f43f5e; letter-spacing: 1.2px; text-transform: uppercase;">KOLEKSI FAVORIT PRIBADI</span>
                <h1 class="font-gaming" style="font-size: 2.4rem; color: #fff; line-height: 1.1; margin-top: 4px; margin-bottom: 6px;">
                    WISHLIST <span style="color: #f43f5e;">AKUN SULTAN SAYA</span>
                </h1>
                <p style="color: #94a3b8; font-size: 0.95rem;">
                    Daftar akun game impian yang telah Anda tandai agar mudah dipantau ketersediaannya.
                </p>
            </div>

            <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                <div style="background: rgba(15, 23, 42, 0.9); border: 1px solid rgba(244, 63, 94, 0.4); padding: 8px 18px; border-radius: var(--radius-full); font-size: 0.88rem; color: #fff; display: flex; align-items: center; gap: 8px;">
                    <i data-lucide="heart" style="width: 17px; height: 17px; color: #f43f5e; fill: #f43f5e;"></i>
                    <span>Tersimpan: <strong id="wishlist-total-header" style="color: #f43f5e;">{{ $totalCount ?? $wishlists->count() }} Akun</strong></span>
                </div>
                <a href="{{ route('catalog') }}" class="btn btn-secondary btn-sm" style="border-radius: var(--radius-full); padding: 8px 18px;">
                    <i data-lucide="plus" style="width: 15px; height: 15px;"></i>
                    <span>Cari Akun Lain</span>
                </a>
            </div>
        </div>
    </div>

    @if($wishlists->count() > 0)
        <div class="accounts-grid" id="wishlist-grid" style="margin-bottom: 40px;">
            @foreach($wishlists as $item)
                @php $acc = $item->gameAccount; @endphp
                @if($acc)
                    <div class="account-card" id="wishlist-card-{{ $acc->id }}" style="transition: all 0.3s ease;">
                        <div class="account-media">
                            <img src="{{ $acc->thumbnail_url }}" alt="{{ $acc->title }}" class="account-thumb" loading="lazy">
                            
                            @if($acc->status === 'available')
                                <span class="badge-status badge-available">
                                    <span style="width: 7px; height: 7px; border-radius: 50%; background: #fff; display: inline-block; animation: pulse 1.5s infinite;"></span>
                                    Ready
                                </span>
                            @else
                                <span class="badge-status badge-sold">
                                    <span style="width: 7px; height: 7px; border-radius: 50%; background: #fff; display: inline-block;"></span>
                                    Sold Out
                                </span>
                            @endif

                            @if($acc->discount_percent > 0)
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
                                <span class="tag-badge tag-server">
                                    <i data-lucide="globe" style="width: 11px; height: 11px;"></i>
                                    {{ $acc->server }}
                                </span>
                                <span class="tag-badge tag-bind">
                                    <i data-lucide="lock" style="width: 11px; height: 11px;"></i>
                                    {{ Str::limit($acc->login_bind, 16) }}
                                </span>
                            </div>

                            <div class="account-pricing">
                                <div class="price-box">
                                    @if($acc->discount_price)
                                        <span class="price-strike">{{ $acc->formatted_price }}</span>
                                    @endif
                                    <span class="price-main">{{ $acc->formatted_effective_price }}</span>
                                </div>

                                <div class="account-actions">
                                    <button class="btn btn-secondary btn-icon btn-toggle-wishlist" data-id="{{ $acc->id }}" data-remove-card="true" title="Hapus dari Wishlist" style="color: #f43f5e; border-color: rgba(244, 63, 94, 0.4); background: rgba(244, 63, 94, 0.08); border-radius: 50%; width: 38px; height: 38px;">
                                        <i data-lucide="trash-2" style="width: 15px; height: 15px;"></i>
                                    </button>
                                    <a href="{{ route('account.show', $acc->slug) }}" class="btn btn-primary btn-sm" style="border-radius: var(--radius-full); padding: 7px 16px;">
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
        <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 20px; padding: 70px 24px; text-align: center;">
            <div style="width: 76px; height: 76px; border-radius: 50%; background: rgba(244, 63, 94, 0.1); border: 1px solid rgba(244, 63, 94, 0.3); display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                <i data-lucide="heart-off" style="width: 38px; height: 38px; color: #f43f5e;"></i>
            </div>
            <h3 class="font-gaming" style="font-size: 1.8rem; color: #fff; margin-bottom: 8px;">Belum Ada Akun di Wishlist</h3>
            <p style="color: #94a3b8; max-width: 460px; margin: 0 auto 24px; font-size: 0.95rem;">
                Anda belum menandai akun manapun sebagai favorit. Jelajahi katalog dan tekan ikon hati pada akun yang Anda sukai!
            </p>
            <a href="{{ route('catalog') }}" class="btn btn-primary" style="border-radius: var(--radius-full); padding: 10px 24px;">
                <i data-lucide="gamepad-2" style="width: 16px; height: 16px;"></i>
                <span>Jelajahi Katalog Stok</span>
            </a>
        </div>
    @endif
</div>
@endsection
