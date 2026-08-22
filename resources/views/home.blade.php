@extends('layouts.app')

@section('title', 'ALzis STURR - Pusat Jual Beli & Japost Akun Game Terpercaya')

@section('content')

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-glow-1"></div>
    <div class="hero-glow-2"></div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-tag">
                <i data-lucide="shield-check" style="width: 16px; height: 16px;"></i>
                <span>#1 TRUSTED GAME ACCOUNT MARKETPLACE</span>
            </div>

            <h1 class="hero-title">
                PUSAT JUAL BELI & JAPOST <br>
                <span class="text-gradient-cyan">AKUN GAME SULTAN</span> TERPERCAYA
            </h1>

            <p class="hero-subtitle">
                Temukan stok akun Mobile Legends, Free Fire, Genshin Impact, PUBGM, Valorant, & Honor of Kings dengan garansi 100% Anti Hackback. Transaksi kilat & aman langsung bersama <strong style="color: #fff;">Admin ALzis STURR</strong>.
            </p>

            <!-- Premium Hero Search Bar -->
            <div style="max-width: 720px; margin: 0 auto 20px; background: rgba(15, 23, 42, 0.85); border: 1px solid var(--border-glow); padding: 8px 10px; border-radius: var(--radius-full); box-shadow: 0 10px 35px rgba(0, 242, 254, 0.15); backdrop-filter: blur(10px);">
                <form action="{{ route('catalog') }}" method="GET" style="display: flex; align-items: center; gap: 8px; width: 100%;">
                    <div style="display: flex; align-items: center; gap: 12px; flex: 1; padding-left: 16px;">
                        <i data-lucide="search" style="width: 20px; height: 20px; color: var(--primary); flex-shrink: 0;"></i>
                        <input type="text" name="q" style="background: transparent; border: none; outline: none; color: #ffffff; font-size: 0.95rem; width: 100%;" placeholder="Cari nama akun, rank, hero, skin (misal: Chou KOF, Glacier)...">
                    </div>
                    <button type="submit" class="btn btn-primary" style="border-radius: var(--radius-full); padding: 10px 24px; font-weight: 700; white-space: nowrap; flex-shrink: 0; display: flex; align-items: center; gap: 6px;">
                        <span>Cari Akun</span>
                        <i data-lucide="arrow-right" style="width: 16px; height: 16px;"></i>
                    </button>
                </form>
            </div>

            <!-- Trending Quick Tags -->
            <div style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap; gap: 8px; margin-bottom: 35px; font-size: 0.825rem;">
                <span style="color: var(--text-muted); font-weight: 600;">🔥 Populer:</span>
                <a href="{{ route('catalog', ['category' => 'mobile-legends']) }}" style="background: rgba(255,255,255,0.06); padding: 4px 12px; border-radius: 99px; border: 1px solid var(--border-color); color: #cbd5e1; text-decoration: none; transition: all 0.2s;">Mobile Legends</a>
                <a href="{{ route('catalog', ['category' => 'free-fire']) }}" style="background: rgba(255,255,255,0.06); padding: 4px 12px; border-radius: 99px; border: 1px solid var(--border-color); color: #cbd5e1; text-decoration: none; transition: all 0.2s;">Free Fire Old</a>
                <a href="{{ route('catalog', ['category' => 'genshin-impact']) }}" style="background: rgba(255,255,255,0.06); padding: 4px 12px; border-radius: 99px; border: 1px solid var(--border-color); color: #cbd5e1; text-decoration: none; transition: all 0.2s;">Genshin Impact</a>
                <a href="{{ route('catalog', ['category' => 'pubg-mobile']) }}" style="background: rgba(255,255,255,0.06); padding: 4px 12px; border-radius: 99px; border: 1px solid var(--border-color); color: #cbd5e1; text-decoration: none; transition: all 0.2s;">PUBG Mobile</a>
                <a href="{{ route('catalog', ['category' => 'valorant']) }}" style="background: rgba(255,255,255,0.06); padding: 4px 12px; border-radius: 99px; border: 1px solid var(--border-color); color: #cbd5e1; text-decoration: none; transition: all 0.2s;">Valorant</a>
            </div>

            <!-- Hero Stats Row -->
            <div class="hero-stats-row">
                <div class="hero-stat-card">
                    <div class="stat-number">{{ $readyAccounts }}+</div>
                    <div class="stat-label">Akun Ready Stok</div>
                </div>
                <div class="hero-stat-card">
                    <div class="stat-number">{{ $soldAccounts }}+</div>
                    <div class="stat-label">Akun Terjual Sukses</div>
                </div>
                <div class="hero-stat-card">
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Garansi Anti Hackback</div>
                </div>
                <div class="hero-stat-card">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Respon Cepat Admin</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Game Categories Horizontal Pills -->
<section style="padding: 20px 0 30px;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <h3 class="font-gaming" style="font-size: 1.4rem; color: #fff;">
                <i data-lucide="gamepad-2" style="width: 20px; height: 20px; color: var(--primary); vertical-align: -2px;"></i>
                PILIH KATEGORI GAME
            </h3>
            <a href="{{ route('catalog') }}" style="font-size: 0.85rem; color: var(--primary); font-weight: 600;">Lihat Semua &rarr;</a>
        </div>

        <div class="category-pills">
            <a href="{{ route('catalog') }}" class="category-pill active">
                <i data-lucide="layout-grid" style="width: 16px; height: 16px;"></i>
                <span>Semua Game</span>
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('catalog', ['category' => $cat->slug]) }}" class="category-pill">
                    <i data-lucide="flame" style="width: 16px; height: 16px; color: var(--accent-gold);"></i>
                    <span>{{ $cat->name }}</span>
                    <span style="font-size: 0.75rem; opacity: 0.7; background: rgba(255,255,255,0.1); padding: 2px 6px; border-radius: 99px;">
                        {{ $cat->availableAccountsCount() }}
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured / Sultan Accounts -->
@if($featuredAccounts->count() > 0)
<section style="padding: 30px 0 50px;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px;">
            <div>
                <span class="text-gradient-gold" style="font-size: 0.85rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">⭐ PILIHAN SULTAN REKOMENDASI</span>
                <h2 class="font-gaming" style="font-size: 2.2rem; color: #ffffff; margin-top: 4px;">STOK AKUN SULTAN FEATURED</h2>
            </div>
            <a href="{{ route('catalog') }}" class="btn btn-secondary btn-sm">
                <span>Lihat Semua Katalog</span>
                <i data-lucide="arrow-right" style="width: 16px; height: 16px;"></i>
            </a>
        </div>

        <div class="accounts-grid">
            @foreach($featuredAccounts as $acc)
                <div class="account-card">
                    <div class="account-media">
                        <img src="{{ $acc->thumbnail_url }}" alt="{{ $acc->title }}" class="account-thumb">
                        
                        <!-- Status Badge -->
                        @if($acc->status === 'available')
                            <span class="badge-status badge-available">
                                <span style="width: 8px; height: 8px; border-radius: 50%; background: #fff; display: inline-block;"></span>
                                Ready Stok
                            </span>
                        @else
                            <span class="badge-status badge-sold">
                                <span style="width: 8px; height: 8px; border-radius: 50%; background: #fff; display: inline-block;"></span>
                                Terjual (Sold)
                            </span>
                        @endif

                        <!-- Code SKU -->
                        <span class="badge-code">#{{ $acc->code }}</span>

                        <!-- Discount Ribbon -->
                        @if($acc->discount_percent > 0)
                            <span class="badge-discount-ribbon">HEMAT {{ $acc->discount_percent }}%</span>
                        @endif
                    </div>

                    <div class="account-body">
                        <div class="account-category-name">{{ $acc->category->name }}</div>
                        <h3 class="account-card-title">
                            <a href="{{ route('account.show', $acc->slug) }}">{{ $acc->title }}</a>
                        </h3>

                        <div class="account-tags-row">
                            <span class="tag-badge tag-server">
                                <i data-lucide="globe" style="width: 12px; height: 12px;"></i>
                                {{ $acc->server }}
                            </span>
                            <span class="tag-badge tag-bind">
                                <i data-lucide="lock" style="width: 12px; height: 12px;"></i>
                                {{ Str::limit($acc->login_bind, 22) }}
                            </span>
                            @if($acc->rank_tier)
                                <span class="tag-badge" style="border-color: rgba(245, 158, 11, 0.3); color: #fbbf24;">
                                    <i data-lucide="trophy" style="width: 12px; height: 12px;"></i>
                                    {{ $acc->rank_tier }}
                                </span>
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
                                <button class="btn btn-secondary btn-icon btn-toggle-wishlist" data-id="{{ $acc->id }}" title="Simpan ke Wishlist">
                                    <i data-lucide="heart" style="width: 16px; height: 16px;"></i>
                                </button>
                                <a href="{{ route('account.show', $acc->slug) }}" class="btn btn-primary btn-sm">
                                    <span>Detail</span>
                                    <i data-lucide="chevron-right" style="width: 14px; height: 14px;"></i>
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

<!-- Latest Stock Japost Grid -->
<section style="padding: 30px 0 60px; background: rgba(0,0,0,0.2);">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px;">
            <div>
                <span class="text-gradient-cyan" style="font-size: 0.85rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">🔥 UPDATE HARI INI</span>
                <h2 class="font-gaming" style="font-size: 2.2rem; color: #ffffff; margin-top: 4px;">SEMUA STOK JAPOST TERBARU</h2>
            </div>
            <a href="{{ route('catalog') }}" class="btn btn-secondary btn-sm">
                <span>Filter Lengkap</span>
                <i data-lucide="sliders-horizontal" style="width: 16px; height: 16px;"></i>
            </a>
        </div>

        <div class="accounts-grid">
            @foreach($latestAccounts as $acc)
                <div class="account-card">
                    <div class="account-media">
                        <img src="{{ $acc->thumbnail_url }}" alt="{{ $acc->title }}" class="account-thumb">
                        
                        @if($acc->status === 'available')
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

                        <span class="badge-code">#{{ $acc->code }}</span>

                        @if($acc->discount_percent > 0)
                            <span class="badge-discount-ribbon">HEMAT {{ $acc->discount_percent }}%</span>
                        @endif
                    </div>

                    <div class="account-body">
                        <div class="account-category-name">{{ $acc->category->name }}</div>
                        <h3 class="account-card-title">
                            <a href="{{ route('account.show', $acc->slug) }}">{{ $acc->title }}</a>
                        </h3>

                        <div class="account-tags-row">
                            <span class="tag-badge tag-server">
                                <i data-lucide="globe" style="width: 12px; height: 12px;"></i>
                                {{ $acc->server }}
                            </span>
                            <span class="tag-badge tag-bind">
                                <i data-lucide="lock" style="width: 12px; height: 12px;"></i>
                                {{ Str::limit($acc->login_bind, 20) }}
                            </span>
                            @if($acc->hero_count || $acc->skin_count)
                                <span class="tag-badge">
                                    <i data-lucide="sparkles" style="width: 12px; height: 12px;"></i>
                                    {{ $acc->skin_count ? $acc->skin_count . ' Skin' : $acc->hero_count . ' Hero' }}
                                </span>
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
                                <a href="{{ route('account.show', $acc->slug) }}" class="btn btn-secondary btn-sm" style="padding: 8px 12px;">
                                    <span>Lihat</span>
                                </a>
                                @if($acc->status === 'available')
                                    <a href="{{ $discordUrl }}" 
                                       target="_blank" 
                                       class="btn btn-discord btn-sm" 
                                       style="padding: 8px 12px;">
                                        <i data-lucide="message-circle" style="width: 15px; height: 15px;"></i>
                                        <span>Beli</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('catalog') }}" class="btn btn-primary btn-lg">
                <i data-lucide="grid" style="width: 20px; height: 20px;"></i>
                <span>Jelajahi Semua {{ $totalAccounts }} Stok Akun Game</span>
            </a>
        </div>
    </div>
</section>

<!-- Trust & Security Pillars -->
<section style="padding: 70px 0;">
    <div class="container">
        <div style="text-align: center; max-width: 650px; margin: 0 auto 45px;">
            <span class="text-gradient-cyan" style="font-weight: 800; font-size: 0.85rem; letter-spacing: 1px; text-transform: uppercase;">KENAPA MEMILIH KAMI?</span>
            <h2 class="font-gaming" style="font-size: 2.3rem; color: #fff; margin-top: 6px;">TRANSAKSI AMAN, LEGAL & TANPA CEMAS</h2>
            <p style="color: var(--text-muted); font-size: 0.95rem; margin-top: 10px;">
                ALzis STURR mengutamakan transparansi dan keamanan setiap pelanggan dalam proses jual beli akun game.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 24px;">
            <div class="hero-stat-card" style="text-align: left; padding: 28px;">
                <div style="width: 48px; height: 48px; border-radius: var(--radius-md); background: rgba(0, 242, 254, 0.15); border: 1px solid var(--border-glow); display: flex; align-items: center; justify-content: center; margin-bottom: 18px;">
                    <i data-lucide="shield-check" style="width: 26px; height: 26px; color: var(--primary);"></i>
                </div>
                <h4 class="font-gaming" style="font-size: 1.3rem; color: #fff; margin-bottom: 8px;">Garansi Anti Hackback</h4>
                <p style="color: var(--text-muted); font-size: 0.875rem;">
                    Seluruh akun dijamin aman dengan identitas bind yang jelas (First Hand / All Unbind) dan perlindungan klaim seumur hidup.
                </p>
            </div>

            <div class="hero-stat-card" style="text-align: left; padding: 28px;">
                <div style="width: 48px; height: 48px; border-radius: var(--radius-md); background: rgba(16, 185, 129, 0.15); border: 1px solid var(--success-glow); display: flex; align-items: center; justify-content: center; margin-bottom: 18px;">
                    <i data-lucide="zap" style="width: 26px; height: 26px; color: var(--success);"></i>
                </div>
                <h4 class="font-gaming" style="font-size: 1.3rem; color: #fff; margin-bottom: 8px;">Proses Cepat 5-10 Menit</h4>
                <p style="color: var(--text-muted); font-size: 0.875rem;">
                    Setelah pembayaran terkonfirmasi, data email & kata sandi akun langsung diserahkan dan dipandu sampai tuntas login.
                </p>
            </div>

            <div class="hero-stat-card" style="text-align: left; padding: 28px;">
                <div style="width: 48px; height: 48px; border-radius: var(--radius-md); background: rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.3); display: flex; align-items: center; justify-content: center; margin-bottom: 18px;">
                    <i data-lucide="badge-percent" style="width: 26px; height: 26px; color: var(--accent-gold);"></i>
                </div>
                <h4 class="font-gaming" style="font-size: 1.3rem; color: #fff; margin-bottom: 8px;">Harga Bersahabat</h4>
                <p style="color: var(--text-muted); font-size: 0.875rem;">
                    Harga akun tangan pertama tanpa mark-up berlebihan, siap nego tipis langsung dengan admin resmi.
                </p>
            </div>

            <div class="hero-stat-card" style="text-align: left; padding: 28px;">
                <div style="width: 48px; height: 48px; border-radius: var(--radius-md); background: rgba(168, 85, 247, 0.15); border: 1px solid rgba(168, 85, 247, 0.3); display: flex; align-items: center; justify-content: center; margin-bottom: 18px;">
                    <i data-lucide="message-square-check" style="width: 26px; height: 26px; color: var(--secondary);"></i>
                </div>
                <h4 class="font-gaming" style="font-size: 1.3rem; color: #fff; margin-bottom: 8px;">Kontak Resmi Terverifikasi</h4>
                <p style="color: var(--text-muted); font-size: 0.875rem;">
                    Hanya bertransaksi via Discord resmi, Instagram <strong>&#64;{{ $igUsername }}</strong>, dan TikTok <strong>&#64;{{ $tiktokUsername }}</strong>. Waspada akun tiruan!
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Direct Contact & Banner CTA -->
<section style="padding: 40px 0 80px;">
    <div class="container">
        <div style="background: linear-gradient(135deg, #1e1b4b 0%, #0f172a 50%, #064e3b 100%); border: 1px solid var(--border-glow); border-radius: var(--radius-lg); padding: 45px 36px; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 24px; box-shadow: var(--shadow-glow);">
            <div style="max-width: 600px;">
                <span class="badge-status badge-available" style="position: static; margin-bottom: 12px; display: inline-flex;">ONLINE 24 JAM</span>
                <h3 class="font-gaming" style="font-size: 2.2rem; color: #fff; line-height: 1.2; margin-bottom: 12px;">Punya Akun Game Ingin Dijual / Japost?</h3>
                <p style="color: #cbd5e1; font-size: 1rem;">
                    Hubungi admin ALzis STURR melalui Discord sekarang untuk titip jual (japost) akun game Anda atau cari akun spesifikasi khusus yang belum ada di katalog!
                </p>
            </div>

            <div style="display: flex; flex-direction: column; gap: 10px; width: 100%; max-width: 320px;">
                <a href="{{ $discordUrl }}" 
                   target="_blank" 
                   class="btn btn-discord btn-lg">
                    <i data-lucide="message-circle" style="width: 18px; height: 18px;"></i>
                    <span>Chat Admin di Discord</span>
                </a>
                <a href="https://instagram.com/{{ $igUsername }}" 
                   target="_blank" 
                   class="btn btn-instagram btn-lg">
                    <svg style="width: 18px; height: 18px; fill: currentColor; vertical-align: -2px;" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    <span>Follow IG &#64;{{ $igUsername }}</span>
                </a>
                <a href="https://www.tiktok.com/@{{ $tiktokUsername }}" 
                   target="_blank" 
                   class="btn btn-tiktok btn-lg">
                    <svg style="width: 18px; height: 18px; fill: currentColor; vertical-align: -2px;" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1.04-.1z"/></svg>
                    <span>TikTok &#64;{{ $tiktokUsername }}</span>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
