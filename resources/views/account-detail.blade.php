@extends('layouts.app')

@section('title', $account->title . ' - ALzis STURR')
@section('meta_description', Str::limit(strip_tags($account->full_specs ?: $account->short_description), 150))

@section('content')
<div class="container" style="padding: 30px 20px 80px;">

    <!-- Breadcrumb -->
    <div style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 20px;">
        <a href="{{ route('home') }}">Beranda</a> / 
        <a href="{{ route('catalog') }}">Katalog</a> / 
        <a href="{{ route('catalog', ['category' => $account->category->slug]) }}">{{ $account->category->name }}</a> / 
        <span style="color: var(--primary);">#{{ $account->code }}</span>
    </div>

    <!-- Product Layout Grid -->
    <div class="detail-layout">
        <!-- Left: Image Gallery -->
        <div class="gallery-container">
            <div class="gallery-main" id="mainGalleryBox">
                <img id="mainGalleryImg" src="{{ $account->thumbnail_url }}" alt="{{ $account->title }}">
                
                @if($account->status === 'available')
                    <span class="badge-status badge-available">
                        <span style="width: 8px; height: 8px; border-radius: 50%; background: #fff; display: inline-block;"></span>
                        Ready Stok
                    </span>
                @else
                    <span class="badge-status badge-sold">
                        <span style="width: 8px; height: 8px; border-radius: 50%; background: #fff; display: inline-block;"></span>
                        Terjual (Sold Out)
                    </span>
                @endif

                <span class="badge-code" style="font-size: 1rem; padding: 6px 14px;">#{{ $account->code }}</span>
            </div>

            <!-- Thumbnails Carousel/Row -->
            <div class="gallery-thumbs">
                <div class="thumb-item active" onclick="switchGallery('{{ $account->thumbnail_url }}', this)">
                    <img src="{{ $account->thumbnail_url }}" alt="Thumbnail Utama">
                </div>
                @foreach($account->images as $img)
                    <div class="thumb-item" onclick="switchGallery('{{ $img->image_url }}', this)">
                        <img src="{{ $img->image_url }}" alt="{{ $img->caption ?: 'Screenshot Akun' }}">
                    </div>
                @endforeach
            </div>

            <!-- Guarantee Box -->
            <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 20px; margin-top: 10px;">
                <h4 class="font-gaming" style="font-size: 1.15rem; color: #fff; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                    <i data-lucide="shield-alert" style="width: 18px; height: 18px; color: var(--primary);"></i>
                    JAMINAN KEAMANAN TRANSAKSI ALZIS STURR
                </h4>
                <div class="guarantee-badges">
                    <div class="guarantee-card">
                        <i data-lucide="lock"></i>
                        <strong>100% Anti Hackback</strong>
                        <div style="font-size: 0.7rem; color: var(--text-sub); margin-top: 2px;">Garansi Seumur Hidup</div>
                    </div>
                    <div class="guarantee-card">
                        <i data-lucide="user-check"></i>
                        <strong>Data Bersih (Unbind)</strong>
                        <div style="font-size: 0.7rem; color: var(--text-sub); margin-top: 2px;">Siap Ganti Email/No HP</div>
                    </div>
                    <div class="guarantee-card">
                        <i data-lucide="check-check"></i>
                        <strong>Panduan Tuntas</strong>
                        <div style="font-size: 0.7rem; color: var(--text-sub); margin-top: 2px;">Dipandu Sampai Login Sukses</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Specs, Pricing, & Direct Buy Actions -->
        <div>
            <div class="detail-info-card">
                <div class="detail-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span class="account-category-name" style="font-size: 0.9rem;">
                            {{ $account->category->name }}
                        </span>
                        <span style="font-size: 0.8rem; color: var(--text-sub); display: inline-flex; align-items: center; gap: 4px;">
                            <i data-lucide="eye" style="width: 14px; height: 14px;"></i> {{ $account->views_count }}x Dilihat
                        </span>
                    </div>
                    <h1 class="detail-title font-gaming">{{ $account->title }}</h1>
                    
                    <!-- Pricing Banner -->
                    <div style="background: rgba(15, 23, 42, 0.8); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 16px 20px; display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                        <div>
                            <div style="font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase;">Harga Net / Promo:</div>
                            <div style="display: flex; align-items: baseline; gap: 10px; margin-top: 2px;">
                                <span class="font-gaming" style="font-size: 2.2rem; font-weight: 800; color: #38bdf8;">
                                    {{ $account->formatted_effective_price }}
                                </span>
                                @if($account->discount_price)
                                    <span style="font-size: 1rem; color: var(--text-sub); text-decoration: line-through;">
                                        {{ $account->formatted_price }}
                                    </span>
                                    <span class="badge-discount-ribbon" style="position: static;">
                                        HEMAT {{ $account->discount_percent }}%
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Wishlist Toggle -->
                        <button class="btn btn-secondary btn-icon btn-toggle-wishlist" data-id="{{ $account->id }}" title="Simpan ke Wishlist">
                            <i data-lucide="heart" style="width: 20px; height: 20px; {{ $account->isWishlistedBy(Auth::user()) ? 'color: #f43f5e;' : '' }}"></i>
                        </button>
                    </div>
                </div>

                <!-- Specs Grid -->
                <div class="specs-grid">
                    <div class="spec-item">
                        <span class="spec-label">Server / Region</span>
                        <span class="spec-val" style="color: #7dd3fc;">{{ $account->server }}</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Status Login / Bind</span>
                        <span class="spec-val" style="color: #d8b4fe;">{{ $account->login_bind }}</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Rank / Tier Saat Ini</span>
                        <span class="spec-val" style="color: #fbbf24;">{{ $account->rank_tier ?: 'Sesuai Deskripsi' }}</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Winrate / Statistik</span>
                        <span class="spec-val">{{ $account->winrate ?: '-' }}</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Total Koleksi Skin</span>
                        <span class="spec-val">{{ $account->skin_count ? $account->skin_count . ' Skin' : '-' }}</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Total Hero Unlocked</span>
                        <span class="spec-val">{{ $account->hero_count ? $account->hero_count . ' Hero' : '-' }}</span>
                    </div>
                </div>

                <!-- Call to Action Box -->
                <div class="cta-box" style="padding: 20px; border-radius: var(--radius-md); background: rgba(15, 23, 42, 0.7); border: 1px solid var(--border-glow); box-shadow: var(--shadow-glow);">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                        <i data-lucide="shopping-cart" style="width: 18px; height: 18px; color: #5865F2;"></i>
                        <strong style="color: #fff; font-size: 0.95rem; font-family: var(--font-gaming); letter-spacing: 0.5px;">Beli Akun Ini Sekarang:</strong>
                    </div>
                    <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 16px; line-height: 1.4;">
                        Buka channel ticket privat di Discord Server ALzis STURR atau hubungi media sosial resmi kami di bawah ini:
                    </p>

                    <div class="cta-buttons" style="display: flex; flex-direction: column; gap: 10px;">
                        @if($account->status === 'available')
                            <a href="{{ $discordUrl }}" target="_blank" class="btn btn-discord" style="padding: 13px 20px; font-size: 0.95rem; font-weight: 700; width: 100%; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 18px rgba(88, 101, 242, 0.4);">
                                <svg style="width: 20px; height: 20px; fill: currentColor; flex-shrink: 0;" viewBox="0 0 24 24"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994.021-.041.001-.09-.041-.106a13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.929 1.793 8.18 1.793 12.061 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.893.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.028zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.956-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.955-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.946 2.418-2.157 2.418z"/></svg>
                                <span>Order via Discord Ticket (Server Resmi)</span>
                            </a>
                        @else
                            <button class="btn btn-secondary" disabled style="padding: 13px 20px; font-size: 0.95rem; width: 100%; opacity: 0.6; cursor: not-allowed; display: flex; align-items: center; justify-content: center; gap: 8px;">
                                <i data-lucide="x-circle" style="width: 20px; height: 20px; color: var(--danger);"></i>
                                <span>Stok Akun Ini Sudah Terjual (Sold Out)</span>
                            </button>
                        @endif

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                            <a href="{{ $igUrl }}" target="_blank" class="btn btn-instagram" style="padding: 10px 14px; font-size: 0.85rem; font-weight: 600; width: 100%; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; gap: 6px; white-space: nowrap;">
                                <svg style="width: 16px; height: 16px; fill: currentColor; flex-shrink: 0;" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                <span>IG &#64;{{ $igUsername }}</span>
                            </a>
                            <a href="{{ $tiktokUrl }}" target="_blank" class="btn btn-tiktok" style="padding: 10px 14px; font-size: 0.85rem; font-weight: 600; width: 100%; border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; gap: 6px; white-space: nowrap;">
                                <svg style="width: 16px; height: 16px; fill: currentColor; flex-shrink: 0;" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1.04-.1z"/></svg>
                                <span>TikTok &#64;{{ $tiktokUsername }}</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Full Description & Specs -->
                <div style="margin-top: 24px;">
                    <h3 class="font-gaming" style="font-size: 1.25rem; color: #fff; margin-bottom: 12px;">
                        RINCIAN SPESIFIKASI LENGKAP
                    </h3>
                    
                    @if($account->short_description)
                        <p style="color: #93c5fd; font-weight: 500; margin-bottom: 14px; background: rgba(59, 130, 246, 0.08); padding: 12px 16px; border-radius: var(--radius-sm); border-left: 3px solid #3b82f6;">
                            {{ $account->short_description }}
                        </p>
                    @endif

                    <div style="background: rgba(15, 23, 42, 0.6); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 20px; font-size: 0.9rem; line-height: 1.8; color: #cbd5e1; white-space: pre-line;">
                        {{ $account->full_specs ?: 'Spesifikasi detail dapat ditanyakan langsung melalui Ticket Discord atau Instagram admin.' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Accounts -->
    @if($relatedAccounts->count() > 0)
    <div style="margin-top: 60px; padding-top: 40px; border-top: 1px solid var(--border-color);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h3 class="font-gaming" style="font-size: 1.8rem; color: #fff;">
                STOK LAINNYA DI KATEGORI <span class="text-gradient-cyan">{{ strtoupper($account->category->name) }}</span>
            </h3>
            <a href="{{ route('catalog', ['category' => $account->category->slug]) }}" style="font-size: 0.85rem; color: var(--primary); font-weight: 600;">Lihat Semua &rarr;</a>
        </div>

        <div class="accounts-grid">
            @foreach($relatedAccounts as $rel)
                <div class="account-card">
                    <div class="account-media">
                        <img src="{{ $rel->thumbnail_url }}" alt="{{ $rel->title }}" class="account-thumb">
                        
                        @if($rel->status === 'available')
                            <span class="badge-status badge-available">
                                <span style="width: 8px; height: 8px; border-radius: 50%; background: #fff; display: inline-block;"></span>
                                Ready
                            </span>
                        @else
                            <span class="badge-status badge-sold">
                                <span style="width: 8px; height: 8px; border-radius: 50%; background: #fff; display: inline-block;"></span>
                                Sold Out
                            </span>
                        @endif

                        <span class="badge-code">#{{ $rel->code }}</span>
                    </div>

                    <div class="account-body">
                        <div class="account-category-name">{{ $rel->category->name }}</div>
                        <h3 class="account-card-title">
                            <a href="{{ route('account.show', $rel->slug) }}">{{ $rel->title }}</a>
                        </h3>

                        <div class="account-tags-row">
                            <span class="tag-badge tag-server">{{ $rel->server }}</span>
                            <span class="tag-badge tag-bind">{{ Str::limit($rel->login_bind, 18) }}</span>
                        </div>

                        <div class="account-pricing">
                            <div class="price-box">
                                <span class="price-main">{{ $rel->formatted_effective_price }}</span>
                            </div>
                            <a href="{{ route('account.show', $rel->slug) }}" class="btn btn-primary btn-sm">
                                <span>Detail</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

</div>

@push('scripts')
<script>
    function switchGallery(imageUrl, element) {
        document.getElementById('mainGalleryImg').src = imageUrl;
        document.querySelectorAll('.thumb-item').forEach(el => el.classList.remove('active'));
        element.classList.add('active');
    }
</script>
@endpush
@endsection
