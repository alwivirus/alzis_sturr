@extends('layouts.app')

@section('title', 'ALZIS STORE - Pusat Jual Beli Akun Game Sultan Terpercaya')
@section('meta_description', 'Beli akun Mobile Legends, Free Fire, Genshin Impact, PUBGM & Valorant murah, aman, dan bergaransi 100% Anti Hackback di ALZIS STORE.')

@push('styles')
<link rel="preload" as="image" href="{{ asset('images/slides/slide-valorant.jpg') }}" fetchpriority="high">
@endpush

@section('content')

<!-- Hero Banner Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-banner-card">
            
            <!-- Sliding Background Wallpaper -->
            <div class="hero-slider-container" id="heroSliderContainer">
                <div class="hero-slide active" style="background-image: url('{{ asset('images/slides/slide-valorant.jpg') }}');" data-game="Valorant"></div>
                <div class="hero-slide" data-bg="{{ asset('images/slides/slide-mlbb.jpg') }}" data-game="Mobile Legends"></div>
                <div class="hero-slide" data-bg="{{ asset('images/slides/slide-ff.jpg') }}" data-game="Free Fire"></div>
                <div class="hero-slide" data-bg="{{ asset('images/slides/slide-pubg.jpg') }}" data-game="PUBG Mobile"></div>
            </div>

            <!-- Dark Gradient Cyber Overlay -->
            <div class="hero-slider-overlay"></div>

            <!-- Foreground Content Layer -->
            <div class="hero-content-layer">
                <div class="hero-tag">
                    <svg style="width: 15px; height: 15px; color: var(--primary); flex-shrink: 0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
                    <span>GARANSI 100% ANTI HACKBACK SEUMUR HIDUP</span>
                </div>

                <h1 class="hero-title">
                    Pusat Jual Beli Akun Game Sultan <span class="text-gradient">#1 Terpercaya</span>
                </h1>

                <p class="hero-subtitle">
                    Marketplace & rekber resmi akun Mobile Legends, Free Fire, Genshin Impact, PUBGM, & Valorant. Data bersih (all unbind), transaksi instan 5 menit langsung dipandu Admin.
                </p>

                <!-- Search Bar -->
                <div class="hero-search-wrapper">
                    <svg style="width: 16px; height: 16px; color: var(--text-dim); margin-left: 2px; flex-shrink: 0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <form action="{{ route('catalog') }}" method="GET" style="display: flex; flex: 1; align-items: center; gap: 6px; min-width: 0;">
                        <input type="text" name="q" placeholder="Cari nama akun, skin, hero, rank..." style="min-width: 0; flex: 1; font-size: 0.82rem;">
                        <button type="submit" class="btn btn-primary btn-sm" style="white-space: nowrap; flex-shrink: 0; padding: 6px 12px; height: 36px; font-size: 0.76rem; border-radius: 8px; gap: 4px;">
                            <span>Cari Stok</span>
                            <svg style="width: 13px; height: 13px; flex-shrink: 0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Slider Indicator Bars -->
            <div class="hero-slider-indicators">
                <div class="slider-dot active" onclick="jumpToSlide(0)" title="Valorant"></div>
                <div class="slider-dot" onclick="jumpToSlide(1)" title="Mobile Legends"></div>
                <div class="slider-dot" onclick="jumpToSlide(2)" title="Free Fire"></div>
                <div class="slider-dot" onclick="jumpToSlide(3)" title="PUBG Mobile"></div>
            </div>

        </div>
    </div>
</section>

<!-- Trust Counters / Quick Highlights Bar -->
<section style="padding: 0 0 24px;">
    <div class="container">
        <div class="trust-highlights-grid">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 42px; height: 42px; border-radius: var(--radius-sm); background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg style="width: 22px; height: 22px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
                </div>
                <div>
                    <div style="font-size: 0.95rem; font-weight: 800; color: #fff;">100% Anti Hackback</div>
                    <div style="font-size: 0.75rem; color: var(--text-muted);">Garansi Resmi Seumur Hidup</div>
                </div>
            </div>

            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 42px; height: 42px; border-radius: var(--radius-sm); background: rgba(139, 92, 246, 0.12); color: var(--accent-purple); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg style="width: 22px; height: 22px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                </div>
                <div>
                    <div style="font-size: 0.95rem; font-weight: 800; color: #fff;">Proses 5 Menit</div>
                    <div style="font-size: 0.75rem; color: var(--text-muted);">Serah Terima Data Kilat</div>
                </div>
            </div>

            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 42px; height: 42px; border-radius: var(--radius-sm); background: var(--gold-light); color: var(--gold); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg style="width: 22px; height: 22px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 3h12l4 6-10 12L2 9z"/></svg>
                </div>
                <div>
                    <div style="font-size: 0.95rem; font-weight: 800; color: #fff;">Tangan Pertama</div>
                    <div style="font-size: 0.75rem; color: var(--text-muted);">Harga Bersaing & Legal</div>
                </div>
            </div>

            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 42px; height: 42px; border-radius: var(--radius-sm); background: rgba(16, 185, 129, 0.12); color: var(--success); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg style="width: 22px; height: 22px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/></svg>
                </div>
                <div>
                    <div style="font-size: 0.95rem; font-weight: 800; color: #fff;">Admin Standby 24/7</div>
                    <div style="font-size: 0.75rem; color: var(--text-muted);">Dipandu Sampai Berhasil</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Game Category Selection Bar -->
<section style="padding: 10px 0 28px;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
            <div>
                <span style="font-size: 0.72rem; font-weight: 800; color: var(--primary); text-transform: uppercase; letter-spacing: 0.6px;">PILIHAN GAME</span>
                <h3 class="font-heading" style="font-size: 1.25rem; color: #fff; font-weight: 800; margin-top: 2px;">
                    Jelajahi Kategori Game
                </h3>
            </div>
            <a href="{{ route('catalog') }}" style="font-size: 0.82rem; color: var(--primary); font-weight: 700; display: inline-flex; align-items: center; gap: 4px;">
                <span>Lihat Semua Katalog</span>
                <svg style="width: 14px; height: 14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
        </div>

        <div class="category-pills">
            <a href="{{ route('catalog') }}" class="category-pill active">
                <svg style="width: 15px; height: 15px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                <span>Semua Game</span>
                <span class="category-pill-count">{{ $readyAccounts }} Ready</span>
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('catalog', ['category' => $cat->slug]) }}" class="category-pill">
                    <span>{{ $cat->name }}</span>
                    <span class="category-pill-count">{{ $cat->availableAccountsCount() }}</span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured / Sultan Accounts Section -->
@if($featuredAccounts->count() > 0)
<section style="padding: 20px 0 44px;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
            <div>
                <span style="font-size: 0.72rem; font-weight: 800; color: var(--gold); text-transform: uppercase; letter-spacing: 0.6px; display: inline-flex; align-items: center; gap: 4px;">
                    <svg style="width: 13px; height: 13px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    KOLEKSI SULTAN PILIHAN
                </span>
                <h2 class="font-heading" style="font-size: 1.65rem; color: #fff; font-weight: 900; margin-top: 2px;">
                    Akun Sultan & Koleksi Langka
                </h2>
            </div>
            <a href="{{ route('catalog') }}" class="btn btn-secondary btn-sm">
                <span>Lihat Semua Sultan</span>
                <svg style="width: 14px; height: 14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>

        <div class="accounts-grid">
            @foreach($featuredAccounts as $acc)
                <div class="account-card" onclick="if(!event.target.closest('.btn-toggle-wishlist') && !event.target.closest('a')) window.location='{{ route('account.show', $acc->slug) }}';" style="cursor: pointer;">
                    <a href="{{ route('account.show', $acc->slug) }}" class="account-card-overlay-link" aria-label="{{ $acc->title }}"></a>
                    <div class="account-media">
                        <img src="{{ $acc->thumbnail_url }}" alt="{{ $acc->title }}" class="account-thumb" loading="lazy" decoding="async" width="380" height="230">
                        
                        @if($acc->status === 'available')
                            <span class="badge-status badge-available">Ready Stok</span>
                        @else
                            <span class="badge-status badge-sold">Terjual</span>
                        @endif

                        <span class="badge-code">#{{ $acc->code }}</span>

                        @if($acc->discount_percent > 0)
                            <span class="badge-discount-ribbon">Hemat {{ $acc->discount_percent }}%</span>
                        @endif
                    </div>

                    <div class="account-body">
                        <div class="account-category-name">{{ $acc->category->name }}</div>
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
                                @php $isW = Auth::check() && $acc->isWishlistedBy(Auth::user()); @endphp
                                <button type="button" class="btn btn-secondary btn-icon btn-toggle-wishlist" onclick="event.stopPropagation();" data-id="{{ $acc->id }}" title="Wishlist" style="width: 34px; height: 34px; {{ $isW ? 'color: var(--danger);' : '' }}">
                                    <svg style="width: 15px; height: 15px; {{ $isW ? 'fill: var(--danger);' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                                </button>
                                <a href="{{ route('account.show', $acc->slug) }}" onclick="event.stopPropagation();" class="btn btn-primary btn-sm">
                                    <span>Detail</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Latest Accounts Catalog -->
<section style="padding: 20px 0 60px;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
            <div>
                <span style="font-size: 0.72rem; font-weight: 800; color: var(--primary); text-transform: uppercase; letter-spacing: 0.6px; display: inline-flex; align-items: center; gap: 4px;">
                    <svg style="width: 13px; height: 13px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 3z"/></svg>
                    STOK TERBARU HARI INI
                </span>
                <h2 class="font-heading" style="font-size: 1.65rem; color: #fff; font-weight: 900; margin-top: 2px;">
                    Katalog Akun Siap Takeover
                </h2>
            </div>
            <a href="{{ route('catalog') }}" class="btn btn-secondary btn-sm">
                <span>Buka Katalog Lengkap</span>
                <svg style="width: 14px; height: 14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>

        <div class="accounts-grid">
            @forelse($latestAccounts as $acc)
                <div class="account-card" onclick="if(!event.target.closest('.btn-toggle-wishlist') && !event.target.closest('a')) window.location='{{ route('account.show', $acc->slug) }}';" style="cursor: pointer;">
                    <a href="{{ route('account.show', $acc->slug) }}" class="account-card-overlay-link" aria-label="{{ $acc->title }}"></a>
                    <div class="account-media">
                        <img src="{{ $acc->thumbnail_url }}" alt="{{ $acc->title }}" class="account-thumb" loading="lazy" decoding="async" width="380" height="230">
                        
                        @if($acc->status === 'available')
                            <span class="badge-status badge-available">Ready Stok</span>
                        @else
                            <span class="badge-status badge-sold">Terjual</span>
                        @endif

                        <span class="badge-code">#{{ $acc->code }}</span>

                        @if($acc->discount_percent > 0)
                            <span class="badge-discount-ribbon">Hemat {{ $acc->discount_percent }}%</span>
                        @endif
                    </div>

                    <div class="account-body">
                        <div class="account-category-name">{{ $acc->category->name }}</div>
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
                                @php $isW = Auth::check() && $acc->isWishlistedBy(Auth::user()); @endphp
                                <button type="button" class="btn btn-secondary btn-icon btn-toggle-wishlist" onclick="event.stopPropagation();" data-id="{{ $acc->id }}" title="Wishlist" style="width: 34px; height: 34px; {{ $isW ? 'color: var(--danger);' : '' }}">
                                    <svg style="width: 15px; height: 15px; {{ $isW ? 'fill: var(--danger);' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                                </button>
                                <a href="{{ route('account.show', $acc->slug) }}" onclick="event.stopPropagation();" class="btn btn-primary btn-sm">
                                    <span>Detail</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; color: var(--text-dim); padding: 50px 20px; background: var(--bg-card); border-radius: var(--radius-lg); border: 1px solid var(--border);">
                    <svg style="width: 40px; height: 40px; margin: 0 auto 12px; color: var(--text-dim);" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/></svg>
                    <p style="font-size: 1.05rem; color: #fff; font-weight: 700;">Belum ada stok akun yang tersedia saat ini.</p>
                    <p style="font-size: 0.85rem; color: var(--text-muted); margin-top: 4px;">Silakan hubungi Admin untuk request akun game impian Anda.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Trust & Security Highlights Section (Photo 2 Fixed with Premium SVG Icons) -->
<section style="padding: 48px 0 54px; border-top: 1px solid var(--border); background: var(--bg-surface);">
    <div class="container">
        <div style="text-align: center; max-width: 600px; margin: 0 auto 36px;">
            <span style="font-size: 0.72rem; font-weight: 800; color: var(--primary); text-transform: uppercase; letter-spacing: 0.8px;">STANDAR LAYANAN RESMI</span>
            <h3 class="font-heading" style="font-size: 1.7rem; color: #fff; font-weight: 900; margin-top: 4px;">
                Jaminan Belanja Aman di ALZIS STORE
            </h3>
            <p style="font-size: 0.88rem; color: var(--text-muted); margin-top: 6px;">
                Semua transaksi akun game dilindungi sistem verifikasi ketat dan garansi anti-hackback seumur hidup.
            </p>
        </div>

        <div class="feature-highlights-grid">
            <!-- Feature 1: Garansi Anti Hackback -->
            <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 24px; transition: transform 0.2s ease;">
                <div style="width: 48px; height: 48px; border-radius: var(--radius-md); background: linear-gradient(135deg, rgba(0, 242, 254, 0.15) 0%, rgba(37, 99, 235, 0.15) 100%); border: 1px solid rgba(0, 242, 254, 0.35); color: var(--primary); display: flex; align-items: center; justify-content: center; margin-bottom: 16px; box-shadow: 0 4px 15px rgba(0, 242, 254, 0.15);">
                    <svg style="width: 26px; height: 26px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
                </div>
                <h4 style="font-size: 1.05rem; font-weight: 800; color: #fff; margin-bottom: 6px;">Garansi Anti Hackback</h4>
                <p style="font-size: 0.84rem; color: var(--text-muted); line-height: 1.6;">Jaminan perlindungan akun seumur hidup. Jika ada kendala sistematis, kami siap refund atau ganti akun setara.</p>
            </div>

            <!-- Feature 2: Serah Terima 5 Menit -->
            <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 24px; transition: transform 0.2s ease;">
                <div style="width: 48px; height: 48px; border-radius: var(--radius-md); background: linear-gradient(135deg, rgba(139, 92, 246, 0.15) 0%, rgba(124, 58, 237, 0.15) 100%); border: 1px solid rgba(139, 92, 246, 0.35); color: var(--accent-purple); display: flex; align-items: center; justify-content: center; margin-bottom: 16px; box-shadow: 0 4px 15px rgba(139, 92, 246, 0.15);">
                    <svg style="width: 26px; height: 26px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                </div>
                <h4 style="font-size: 1.05rem; font-weight: 800; color: #fff; margin-bottom: 6px;">Serah Terima 5 Menit</h4>
                <p style="font-size: 0.84rem; color: var(--text-muted); line-height: 1.6;">Setelah pembayaran diverifikasi, admin langsung memberikan data login dan memandu pemindahan email sampai tuntas.</p>
            </div>

            <!-- Feature 3: Harga Tangan Pertama -->
            <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 24px; transition: transform 0.2s ease;">
                <div style="width: 48px; height: 48px; border-radius: var(--radius-md); background: linear-gradient(135deg, rgba(251, 191, 36, 0.15) 0%, rgba(217, 119, 6, 0.15) 100%); border: 1px solid rgba(251, 191, 36, 0.35); color: var(--gold); display: flex; align-items: center; justify-content: center; margin-bottom: 16px; box-shadow: 0 4px 15px rgba(251, 191, 36, 0.15);">
                    <svg style="width: 26px; height: 26px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                </div>
                <h4 style="font-size: 1.05rem; font-weight: 800; color: #fff; margin-bottom: 6px;">Harga Tangan Pertama</h4>
                <p style="font-size: 0.84rem; color: var(--text-muted); line-height: 1.6;">Langsung dari owner/japost terverifikasi tanpa mark-up liar perantara. Harga termurah dan transparan.</p>
            </div>

            <!-- Feature 4: Data Bersih (All Unbind) -->
            <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 24px; transition: transform 0.2s ease;">
                <div style="width: 48px; height: 48px; border-radius: var(--radius-md); background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(5, 150, 105, 0.15) 100%); border: 1px solid rgba(16, 185, 129, 0.35); color: var(--success); display: flex; align-items: center; justify-content: center; margin-bottom: 16px; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.15);">
                    <svg style="width: 26px; height: 26px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <h4 style="font-size: 1.05rem; font-weight: 800; color: #fff; margin-bottom: 6px;">Data Bersih (All Unbind)</h4>
                <p style="font-size: 0.84rem; color: var(--text-muted); line-height: 1.6;">Akun bebas dari bind pihak ketiga yang mencurigakan, siap dikaitkan ke email dan nomor pribadi Anda.</p>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.slider-dot');
    let slideTimer;

    function ensureSlideBg(slide) {
        if (slide && !slide.style.backgroundImage && slide.dataset.bg) {
            slide.style.backgroundImage = `url('${slide.dataset.bg}')`;
        }
    }

    function showSlide(index) {
        if (slides.length === 0) return;
        ensureSlideBg(slides[index]);
        slides.forEach((s, i) => {
            s.classList.toggle('active', i === index);
        });
        dots.forEach((d, i) => {
            d.classList.toggle('active', i === index);
        });
        currentSlide = index;
    }

    function nextSlide() {
        let next = (currentSlide + 1) % slides.length;
        ensureSlideBg(slides[next]);
        showSlide(next);
    }

    function jumpToSlide(index) {
        clearInterval(slideTimer);
        showSlide(index);
        slideTimer = setInterval(nextSlide, 4500);
    }

    if (slides.length > 1) {
        slideTimer = setInterval(nextSlide, 4500);
        if ('requestIdleCallback' in window) {
            requestIdleCallback(() => {
                slides.forEach(ensureSlideBg);
            });
        } else {
            setTimeout(() => {
                slides.forEach(ensureSlideBg);
            }, 2500);
        }
    }
</script>
@endpush

@endsection
