@extends('layouts.app')

@section('title', 'Wishlist Akun Saya - ALZIS STORE')
@section('meta_description', 'Koleksi akun game impian yang Anda favoritkan di ALZIS STORE.')

@section('content')
<div class="container" style="padding: 36px 18px 80px; max-width: 1200px;">
    <!-- Wishlist Header Banner -->
    <div style="background: var(--bg-card); border: 1px solid var(--border-light); border-radius: var(--radius-xl); padding: 28px 32px; margin-bottom: 32px; position: relative; overflow: hidden; box-shadow: var(--shadow-lg);">
        <div style="position: absolute; top: 0; left: 0; right: 0; height: 3px; background: var(--border);, var(--primary), transparent);"></div>
        
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
            <div>
                <span style="font-size: 0.74rem; font-weight: 800; color: var(--danger); letter-spacing: 1px; text-transform: uppercase; display: inline-flex; align-items: center; gap: 4px;">
                    <svg style="width: 14px; height: 14px; fill: currentColor;" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    KOLEKSI FAVORIT PRIBADI
                </span>
                <h1 class="font-heading" style="font-size: 2rem; color: #fff; font-weight: 900; line-height: 1.1; margin-top: 4px; margin-bottom: 4px;">
                    Wishlist Akun Game Saya
                </h1>
                <p style="color: var(--text-muted); font-size: 0.88rem; margin: 0;">
                    Daftar akun game impian yang telah Anda tandai agar mudah dipantau ketersediaannya.
                </p>
            </div>

            <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                <div style="background: var(--bg-surface); border: 1px solid rgba(244, 63, 94, 0.4); padding: 8px 18px; border-radius: var(--radius-full); font-size: 0.88rem; color: #fff; display: flex; align-items: center; gap: 8px;">
                    <svg style="width: 16px; height: 16px; color: var(--danger); fill: var(--danger);" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    <span>Tersimpan: <strong id="wishlist-total-header" style="color: var(--danger);">{{ $totalCount ?? $wishlists->count() }} Akun</strong></span>
                </div>
                <a href="{{ route('catalog') }}" class="btn btn-secondary btn-sm" style="border-radius: var(--radius-full); padding: 8px 18px;">
                    <svg style="width: 14px; height: 14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
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
                    <div class="account-card" id="wishlist-card-{{ $acc->id }}" onclick="if(!event.target.closest('.btn-toggle-wishlist') && !event.target.closest('a')) window.location='{{ route('account.show', $acc->slug) }}';" style="cursor: pointer;">
                        <a href="{{ route('account.show', $acc->slug) }}" class="account-card-overlay-link" aria-label="{{ $acc->title }}"></a>
                        <div class="account-media">
                            <img src="{{ $acc->thumbnail_url }}" alt="{{ $acc->title }}" class="account-thumb" loading="lazy" decoding="async" width="380" height="230">
                            
                            @if($acc->status === 'available')
                                <span class="badge-status badge-available">Ready Stok</span>
                            @else
                                <span class="badge-status badge-sold">Terjual</span>
                            @endif

                            @if($acc->discount_percent > 0)
                                <span class="badge-discount-ribbon">
                                    Hemat {{ $acc->discount_percent }}%
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
                                <span class="tag-badge tag-bind">{{ Str::limit($acc->login_bind, 16) }}</span>
                                @if($acc->rank_tier)
                                    <span class="tag-badge" style="color: var(--gold); border-color: var(--gold-border);">{{ $acc->rank_tier }}</span>
                                @endif
                            </div>

                            <div class="account-pricing">
                                <div class="price-box">
                                    @if($acc->discount_price)
                                        <span class="price-strike">{{ $acc->formatted_price }}</span>
                                    @endif
                                    <span class="price-main">{{ $acc->formatted_effective_price }}</span>
                                </div>

                                <div class="account-actions">
                                    <button type="button" class="btn btn-secondary btn-icon btn-toggle-wishlist" onclick="event.stopPropagation();" data-id="{{ $acc->id }}" data-remove-card="true" title="Hapus dari Wishlist" style="color: var(--danger); border-color: rgba(244, 63, 94, 0.4); background: rgba(244, 63, 94, 0.08); width: 34px; height: 34px;">
                                        <svg style="width: 15px; height: 15px; fill: currentColor;" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                    </button>
                                    <a href="{{ route('account.show', $acc->slug) }}" onclick="event.stopPropagation();" class="btn btn-primary btn-sm">
                                        <span>Detail</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div style="display: flex; justify-content: center; margin-top: 36px;">
            {{ $wishlists->links() }}
        </div>
    @else
        <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-xl); padding: 60px 24px; text-align: center;">
            <div style="width: 64px; height: 64px; border-radius: 50%; background: rgba(244, 63, 94, 0.1); border: 1px solid rgba(244, 63, 94, 0.3); display: inline-flex; align-items: center; justify-content: center; margin-bottom: 18px; color: var(--danger);">
                <svg style="width: 32px; height: 32px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/><line x1="2" y1="2" x2="22" y2="22"/></svg>
            </div>
            <h3 class="font-heading" style="font-size: 1.5rem; color: #fff; margin-bottom: 6px; font-weight: 800;">Belum Ada Akun di Wishlist</h3>
            <p style="color: var(--text-muted); max-width: 440px; margin: 0 auto 20px; font-size: 0.88rem;">
                Anda belum menandai akun game manapun sebagai favorit. Jelajahi katalog dan tekan ikon hati pada akun yang Anda minati!
            </p>
            <a href="{{ route('catalog') }}" class="btn btn-primary" style="border-radius: var(--radius-full); padding: 10px 22px;">
                <span>Jelajahi Katalog Stok</span>
            </a>
        </div>
    @endif
</div>
@endsection
