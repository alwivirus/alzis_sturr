@extends('layouts.app')

@section('title', 'ALzis STURR - Pusat Jual Beli & Japost Akun Game Terpercaya')

@section('content')

<!-- Hero Section -->
<section class="hero-section" style="padding: 70px 0 50px; position: relative;">
    <div class="hero-glow-1"></div>
    <div class="hero-glow-2"></div>
    <div class="container">
        <div class="hero-content" style="max-width: 860px; margin: 0 auto; text-align: center;">
            <div class="hero-tag" style="margin-bottom: 24px; padding: 6px 18px; font-size: 0.82rem; letter-spacing: 1px;">
                <i data-lucide="shield-check" style="width: 16px; height: 16px;"></i>
                <span>#1 TRUSTED GAME ACCOUNT MARKETPLACE</span>
            </div>

            <h1 class="hero-title" style="font-size: 3.4rem; line-height: 1.15; margin-bottom: 24px; letter-spacing: 0.5px;">
                PUSAT JUAL BELI & JAPOST <br>
                <span class="text-gradient-cyan">AKUN GAME SULTAN</span> TERPERCAYA
            </h1>

            <p class="hero-subtitle" style="font-size: 1.1rem; color: #94a3b8; line-height: 1.6; margin-bottom: 36px; max-width: 720px; margin-left: auto; margin-right: auto;">
                Temukan stok akun Mobile Legends, Free Fire, Genshin Impact, PUBGM, Valorant, & Honor of Kings dengan garansi 100% Anti Hackback. Transaksi kilat & aman langsung bersama <strong style="color: #fff;">Admin ALzis STURR</strong>.
            </p>

            <!-- Premium Hero Search Bar -->
            <div style="max-width: 680px; margin: 0 auto 28px; background: rgba(15, 23, 42, 0.9); border: 1px solid rgba(0, 242, 254, 0.35); padding: 8px 10px; border-radius: var(--radius-full); box-shadow: 0 12px 35px rgba(0, 242, 254, 0.18); backdrop-filter: blur(16px);">
                <form action="{{ route('catalog') }}" method="GET" style="display: flex; align-items: center; gap: 8px; width: 100%;">
                    <div style="display: flex; align-items: center; gap: 12px; flex: 1; padding-left: 18px;">
                        <i data-lucide="search" style="width: 20px; height: 20px; color: var(--primary); flex-shrink: 0;"></i>
                        <input type="text" name="q" style="background: transparent; border: none; outline: none; color: #ffffff; font-size: 0.95rem; width: 100%;" placeholder="Cari nama akun, rank, hero, skin (misal: Chou KOF, Glacier)...">
                    </div>
                    <button type="submit" class="btn btn-primary" style="border-radius: var(--radius-full); padding: 12px 28px; font-weight: 700; white-space: nowrap; flex-shrink: 0; display: flex; align-items: center; gap: 6px; box-shadow: 0 4px 18px rgba(0, 242, 254, 0.4);">
                        <span>Cari Akun</span>
                        <i data-lucide="arrow-right" style="width: 16px; height: 16px;"></i>
                    </button>
                </form>
            </div>

            <!-- Trending Quick Tags -->
            <div style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap; gap: 10px; margin-bottom: 45px; font-size: 0.85rem;">
                <span style="color: #64748b; font-weight: 700;">🔥 POPULER:</span>
                <a href="{{ route('catalog', ['category' => 'mobile-legends']) }}" class="category-pill" style="padding: 5px 14px; font-size: 0.8rem;">Mobile Legends</a>
                <a href="{{ route('catalog', ['category' => 'free-fire']) }}" class="category-pill" style="padding: 5px 14px; font-size: 0.8rem;">Free Fire Old</a>
                <a href="{{ route('catalog', ['category' => 'genshin-impact']) }}" class="category-pill" style="padding: 5px 14px; font-size: 0.8rem;">Genshin Impact</a>
                <a href="{{ route('catalog', ['category' => 'pubg-mobile']) }}" class="category-pill" style="padding: 5px 14px; font-size: 0.8rem;">PUBG Mobile</a>
                <a href="{{ route('catalog', ['category' => 'valorant']) }}" class="category-pill" style="padding: 5px 14px; font-size: 0.8rem;">Valorant</a>
            </div>

            <!-- Hero Stats Row -->
            <div class="hero-stats-row" style="margin-top: 50px; gap: 20px;">
                <div class="hero-stat-card" style="padding: 24px 20px; border-radius: 16px;">
                    <div class="stat-number" style="font-size: 2.2rem;">{{ $readyAccounts }}+</div>
                    <div class="stat-label" style="font-size: 0.85rem; margin-top: 4px;">Akun Ready Stok</div>
                </div>
                <div class="hero-stat-card" style="padding: 24px 20px; border-radius: 16px;">
                    <div class="stat-number" style="font-size: 2.2rem; color: #a855f7;">{{ $soldAccounts }}+</div>
                    <div class="stat-label" style="font-size: 0.85rem; margin-top: 4px;">Akun Terjual Sukses</div>
                </div>
                <div class="hero-stat-card" style="padding: 24px 20px; border-radius: 16px;">
                    <div class="stat-number" style="font-size: 2.2rem; color: #34d399;">100%</div>
                    <div class="stat-label" style="font-size: 0.85rem; margin-top: 4px;">Garansi Anti Hackback</div>
                </div>
                <div class="hero-stat-card" style="padding: 24px 20px; border-radius: 16px;">
                    <div class="stat-number" style="font-size: 2.2rem; color: #fbbf24;">24/7</div>
                    <div class="stat-label" style="font-size: 0.85rem; margin-top: 4px;">Respon Cepat Admin</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Game Categories Horizontal Ribbon -->
<section style="padding: 40px 0 50px;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px;">
            <div>
                <span style="font-size: 0.8rem; font-weight: 700; color: #00f2fe; text-transform: uppercase; letter-spacing: 1px;">🎮 PILIH GAME FAVORIT</span>
                <h3 class="font-gaming" style="font-size: 1.6rem; color: #fff; margin-top: 2px;">KATEGORI GAME TERSEDIA</h3>
            </div>
            <a href="{{ route('catalog') }}" style="font-size: 0.85rem; color: var(--primary); font-weight: 700; display: flex; align-items: center; gap: 6px;">
                <span>Lihat Semua Katalog</span>
                <i data-lucide="arrow-right" style="width: 14px; height: 14px;"></i>
            </a>
        </div>

        <div class="category-pills" style="margin-bottom: 0;">
            <a href="{{ route('catalog') }}" class="category-pill active">
                <i data-lucide="layout-grid" style="width: 16px; height: 16px;"></i>
                <span>Semua Game</span>
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('catalog', ['category' => $cat->slug]) }}" class="category-pill">
                    <i data-lucide="flame" style="width: 16px; height: 16px; color: var(--accent-gold);"></i>
                    <span>{{ $cat->name }}</span>
                    <span style="font-size: 0.72rem; opacity: 0.85; background: rgba(255,255,255,0.12); padding: 2px 8px; border-radius: 99px; font-weight: 700;">
                        {{ $cat->availableAccountsCount() }}
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured / Sultan Accounts -->
@if($featuredAccounts->count() > 0)
<section style="padding: 50px 0 60px;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 28px; flex-wrap: wrap; gap: 16px;">
            <div>
                <span class="text-gradient-gold" style="font-size: 0.85rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1.2px;">⭐ PILIHAN SULTAN REKOMENDASI</span>
                <h2 class="font-gaming" style="font-size: 2.3rem; color: #ffffff; margin-top: 4px;">STOK AKUN SULTAN FEATURED</h2>
            </div>
            <a href="{{ route('catalog') }}" class="btn btn-secondary btn-sm" style="border-radius: var(--radius-full); padding: 8px 18px;">
                <span>Lihat Semua Katalog</span>
                <i data-lucide="arrow-right" style="width: 15px; height: 15px;"></i>
            </a>
        </div>

        <div class="accounts-grid" style="margin-bottom: 20px;">
            @foreach($featuredAccounts as $acc)
                <div class="account-card">
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
                                <i data-lucide="globe" style="width: 11px; height: 11px;"></i>
                                {{ $acc->server }}
                            </span>
                            <span class="tag-badge tag-bind">
                                <i data-lucide="lock" style="width: 11px; height: 11px;"></i>
                                {{ Str::limit($acc->login_bind, 16) }}
                            </span>
                            @if($acc->rank_tier)
                                <span class="tag-badge" style="border-color: rgba(245, 158, 11, 0.35); color: #fbbf24; background: rgba(245, 158, 11, 0.08);">
                                    <i data-lucide="trophy" style="width: 11px; height: 11px;"></i>
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
                                @php $isW = Auth::check() && $acc->isWishlistedBy(Auth::user()); @endphp
                                <button class="btn btn-secondary btn-icon btn-toggle-wishlist" data-id="{{ $acc->id }}" title="Simpan ke Wishlist" style="{{ $isW ? 'color: #f43f5e; border-color: #f43f5e;' : '' }}">
                                    <i data-lucide="heart" style="width: 16px; height: 16px; color: {{ $isW ? '#f43f5e' : 'inherit' }}; {{ $isW ? 'fill: #f43f5e;' : '' }}"></i>
                                </button>
                                <a href="{{ route('account.show', $acc->slug) }}" class="btn btn-primary btn-sm" style="border-radius: var(--radius-full); padding: 7px 18px;">
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
<section style="padding: 50px 0 80px;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 28px; flex-wrap: wrap; gap: 16px;">
            <div>
                <span style="font-size: 0.8rem; font-weight: 700; color: #00f2fe; text-transform: uppercase; letter-spacing: 1.2px;">⚡ UPDATE STOK TERBARU</span>
                <h2 class="font-gaming" style="font-size: 2.3rem; color: #ffffff; margin-top: 4px;">STOK AKUN READY HARI INI</h2>
            </div>
            <a href="{{ route('catalog') }}" class="btn btn-secondary btn-sm" style="border-radius: var(--radius-full); padding: 8px 18px;">
                <span>Lihat Semua Katalog</span>
                <i data-lucide="arrow-right" style="width: 15px; height: 15px;"></i>
            </a>
        </div>

        <div class="accounts-grid">
            @forelse($latestAccounts as $acc)
                <div class="account-card">
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
                                <i data-lucide="globe" style="width: 11px; height: 11px;"></i>
                                {{ $acc->server }}
                            </span>
                            <span class="tag-badge tag-bind">
                                <i data-lucide="lock" style="width: 11px; height: 11px;"></i>
                                {{ Str::limit($acc->login_bind, 16) }}
                            </span>
                            @if($acc->rank_tier)
                                <span class="tag-badge" style="border-color: rgba(245, 158, 11, 0.35); color: #fbbf24; background: rgba(245, 158, 11, 0.08);">
                                    <i data-lucide="trophy" style="width: 11px; height: 11px;"></i>
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
                                @php $isW = Auth::check() && $acc->isWishlistedBy(Auth::user()); @endphp
                                <button class="btn btn-secondary btn-icon btn-toggle-wishlist" data-id="{{ $acc->id }}" title="Simpan ke Wishlist" style="{{ $isW ? 'color: #f43f5e; border-color: #f43f5e;' : '' }}">
                                    <i data-lucide="heart" style="width: 16px; height: 16px; color: {{ $isW ? '#f43f5e' : 'inherit' }}; {{ $isW ? 'fill: #f43f5e;' : '' }}"></i>
                                </button>
                                <a href="{{ route('account.show', $acc->slug) }}" class="btn btn-primary btn-sm" style="border-radius: var(--radius-full); padding: 7px 18px;">
                                    <span>Detail</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; color: var(--text-sub); padding: 60px 20px; background: var(--bg-card); border-radius: var(--radius-lg); border: 1px solid var(--border-color);">
                    <i data-lucide="inbox" style="width: 48px; height: 48px; margin-bottom: 12px; opacity: 0.4;"></i>
                    <p style="font-size: 1.1rem; color: #fff; font-weight: 600;">Belum ada stok akun yang tersedia hari ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Trust & Why Choose Us Section -->
<section style="padding: 70px 0 90px; background: linear-gradient(180deg, transparent 0%, rgba(15, 23, 42, 0.8) 100%); border-top: 1px solid var(--border-color);">
    <div class="container">
        <div style="text-align: center; max-width: 680px; margin: 0 auto 50px;">
            <span style="font-size: 0.8rem; font-weight: 700; color: #00f2fe; text-transform: uppercase; letter-spacing: 1.5px;">KEAMANAN & REPUTASI</span>
            <h2 class="font-gaming" style="font-size: 2.4rem; color: #fff; margin-top: 4px;">KENAPA HARUS DI ALZIS STURR?</h2>
            <p style="color: #94a3b8; font-size: 0.95rem; margin-top: 8px;">
                Belanja akun game sultan tanpa rasa was-was dengan standar keamanan nomor satu di Indonesia.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 24px;">
            <!-- Card 1 -->
            <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 20px; padding: 32px 24px; text-align: center; transition: all 0.3s;" onmouseover="this.style.borderColor='rgba(0,242,254,0.4)'; this.style.transform='translateY(-6px)'" onmouseout="this.style.borderColor='var(--border-color)'; this.style.transform='translateY(0)'">
                <div style="width: 64px; height: 64px; border-radius: 18px; background: rgba(0, 242, 254, 0.12); border: 1px solid rgba(0, 242, 254, 0.3); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: #00f2fe;">
                    <i data-lucide="shield-check" style="width: 32px; height: 32px;"></i>
                </div>
                <h4 class="font-gaming" style="font-size: 1.3rem; color: #fff; margin-bottom: 10px;">100% ANTI HACKBACK</h4>
                <p style="color: #94a3b8; font-size: 0.88rem; line-height: 1.6;">
                    Semua akun di-inspect menyeluruh oleh Owner sebelum diposting. Data sepaket sampai akar aman 100%.
                </p>
            </div>

            <!-- Card 2 -->
            <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 20px; padding: 32px 24px; text-align: center; transition: all 0.3s;" onmouseover="this.style.borderColor='rgba(168,85,247,0.4)'; this.style.transform='translateY(-6px)'" onmouseout="this.style.borderColor='var(--border-color)'; this.style.transform='translateY(0)'">
                <div style="width: 64px; height: 64px; border-radius: 18px; background: rgba(168, 85, 247, 0.12); border: 1px solid rgba(168, 85, 247, 0.3); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: #c084fc;">
                    <i data-lucide="zap" style="width: 32px; height: 32px;"></i>
                </div>
                <h4 class="font-gaming" style="font-size: 1.3rem; color: #fff; margin-bottom: 10px;">PROSES KILAT 5-10 MENIT</h4>
                <p style="color: #94a3b8; font-size: 0.88rem; line-height: 1.6;">
                    Handover data akun dibantu langsung via live chat Discord atau WhatsApp resmi sampai tuntas.
                </p>
            </div>

            <!-- Card 3 -->
            <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 20px; padding: 32px 24px; text-align: center; transition: all 0.3s;" onmouseover="this.style.borderColor='rgba(245,158,11,0.4)'; this.style.transform='translateY(-6px)'" onmouseout="this.style.borderColor='var(--border-color)'; this.style.transform='translateY(0)'">
                <div style="width: 64px; height: 64px; border-radius: 18px; background: rgba(245, 158, 11, 0.12); border: 1px solid rgba(245, 158, 11, 0.3); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: #fbbf24;">
                    <i data-lucide="badge-percent" style="width: 32px; height: 32px;"></i>
                </div>
                <h4 class="font-gaming" style="font-size: 1.3rem; color: #fff; margin-bottom: 10px;">HARGA TERMURAH & PROMO</h4>
                <p style="color: #94a3b8; font-size: 0.88rem; line-height: 1.6;">
                    Harga langsung tangan pertama japost owner, tanpa markup agen perantara liar.
                </p>
            </div>

            <!-- Card 4 -->
            <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 20px; padding: 32px 24px; text-align: center; transition: all 0.3s;" onmouseover="this.style.borderColor='rgba(16,185,129,0.4)'; this.style.transform='translateY(-6px)'" onmouseout="this.style.borderColor='var(--border-color)'; this.style.transform='translateY(0)'">
                <div style="width: 64px; height: 64px; border-radius: 18px; background: rgba(16, 185, 129, 0.12); border: 1px solid rgba(16, 185, 129, 0.3); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: #34d399;">
                    <i data-lucide="headphones" style="width: 32px; height: 32px;"></i>
                </div>
                <h4 class="font-gaming" style="font-size: 1.3rem; color: #fff; margin-bottom: 10px;">SUPPORT CS OWNER 24/7</h4>
                <p style="color: #94a3b8; font-size: 0.88rem; line-height: 1.6;">
                    Kendala bind, ganti password, atau tanya spek dibimbing ramah oleh tim owner setiap saat.
                </p>
            </div>
        </div>
    </div>
</section>

@endsection
