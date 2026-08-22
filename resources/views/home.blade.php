@extends('layouts.app')

@section('title', 'ALzis STURR - Jual Beli Akun Game Terpercaya')

@section('content')

<!-- Hero Banner Section with Auto-Sliding Game Wallpaper Background -->
<section class="hero-section">
    <div class="container">
        <div class="hero-banner-card">
            
            <!-- Sliding Background Images -->
            <div class="hero-slider-container" id="heroSliderContainer">
                <div class="hero-slide active" style="background-image: url('{{ asset('images/slides/slide-mlbb.jpg') }}');" data-game="Mobile Legends"></div>
                <div class="hero-slide" style="background-image: url('{{ asset('images/slides/slide-ff.jpg') }}');" data-game="Free Fire"></div>
                <div class="hero-slide" style="background-image: url('{{ asset('images/slides/slide-pubg.jpg') }}');" data-game="PUBG Mobile"></div>
                <div class="hero-slide" style="background-image: url('{{ asset('images/slides/slide-valorant.jpg') }}');" data-game="Valorant"></div>
                <div class="hero-slide" style="background-image: url('{{ asset('images/slides/slide-genshin.jpg') }}');" data-game="Genshin Impact"></div>
            </div>

            <!-- Dark Gradient Overlay for Maximum Text Contrast -->
            <div class="hero-slider-overlay"></div>

            <!-- Fixed Foreground Content -->
            <div class="hero-content-layer">
                <div class="hero-tag">
                    <i data-lucide="shield-check" style="width: 14px; height: 14px;"></i>
                    <span>Garansi 100% Anti Hackback</span>
                </div>

                <h1 class="hero-title">
                    Beli Akun Game Sultan <br>
                    Aman, Terpercaya & Siap Main.
                </h1>

                <p class="hero-subtitle">
                    Pusat jual beli akun Mobile Legends, Free Fire, Genshin Impact, PUBGM, & Valorant langsung bersama Admin ALzis STURR. Transaksi kilat & serah terima data tuntas 5-10 menit.
                </p>

                <!-- Search Bar -->
                <div class="hero-search-wrapper">
                    <i data-lucide="search" style="width: 18px; height: 18px; color: var(--text-dim); margin-left: 6px;"></i>
                    <form action="{{ route('catalog') }}" method="GET" style="display: flex; flex: 1; align-items: center; gap: 8px;">
                        <input type="text" name="q" placeholder="Cari nama akun, skin, hero, rank...">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <span>Cari</span>
                            <i data-lucide="arrow-right" style="width: 14px; height: 14px;"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Slider Indicator Bars -->
            <div class="hero-slider-indicators">
                <div class="slider-dot active" onclick="jumpToSlide(0)"></div>
                <div class="slider-dot" onclick="jumpToSlide(1)"></div>
                <div class="slider-dot" onclick="jumpToSlide(2)"></div>
                <div class="slider-dot" onclick="jumpToSlide(3)"></div>
                <div class="slider-dot" onclick="jumpToSlide(4)"></div>
            </div>

        </div>
    </div>
</section>

<!-- Game Category Selection Bar -->
<section style="padding: 10px 0 30px;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
            <h3 class="font-heading" style="font-size: 1.15rem; color: #fff; font-weight: 700;">
                Pilih Kategori Game
            </h3>
            <a href="{{ route('catalog') }}" style="font-size: 0.82rem; color: var(--primary); font-weight: 600;">
                Lihat Semua &rarr;
            </a>
        </div>

        <div class="category-pills">
            <a href="{{ route('catalog') }}" class="category-pill active">
                <i data-lucide="layout-grid" style="width: 15px; height: 15px;"></i>
                <span>Semua Game</span>
                <span class="category-pill-count">{{ $readyAccounts }}</span>
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

<!-- Featured / Sultan Accounts -->
@if($featuredAccounts->count() > 0)
<section style="padding: 20px 0 40px;">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 18px;">
            <div>
                <span style="font-size: 0.75rem; font-weight: 700; color: var(--gold); text-transform: uppercase; letter-spacing: 0.5px;">REKOMENDASI ADMIN</span>
                <h2 class="font-heading" style="font-size: 1.6rem; color: #fff; margin-top: 2px;">Akun Sultan Pilihan</h2>
            </div>
            <a href="{{ route('catalog') }}" class="btn btn-secondary btn-sm">
                <span>Lihat Semua</span>
                <i data-lucide="arrow-right" style="width: 14px; height: 14px;"></i>
            </a>
        </div>

        <div class="accounts-grid">
            @foreach($featuredAccounts as $acc)
                <div class="account-card">
                    <div class="account-media">
                        <img src="{{ $acc->thumbnail_url }}" alt="{{ $acc->title }}" class="account-thumb" loading="lazy">
                        
                        @if($acc->status === 'available')
                            <span class="badge-status badge-available">Ready</span>
                        @else
                            <span class="badge-status badge-sold">Terjual</span>
                        @endif

                        <span class="badge-code">#{{ $acc->code }}</span>

                        @if($acc->discount_percent > 0)
                            <span class="badge-discount-ribbon">Diskon {{ $acc->discount_percent }}%</span>
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
                                <span class="tag-badge" style="color: var(--gold);">{{ $acc->rank_tier }}</span>
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
                                <button class="btn btn-secondary btn-icon btn-toggle-wishlist" data-id="{{ $acc->id }}" title="Wishlist" style="width: 32px; height: 32px; {{ $isW ? 'color: var(--danger);' : '' }}">
                                    <i data-lucide="heart" style="width: 14px; height: 14px; {{ $isW ? 'fill: var(--danger);' : '' }}"></i>
                                </button>
                                <a href="{{ route('account.show', $acc->slug) }}" class="btn btn-primary btn-sm">
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
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 18px;">
            <div>
                <span style="font-size: 0.75rem; font-weight: 700; color: var(--primary); text-transform: uppercase; letter-spacing: 0.5px;">KATALOG TERBARU</span>
                <h2 class="font-heading" style="font-size: 1.6rem; color: #fff; margin-top: 2px;">Stok Akun Ready Hari Ini</h2>
            </div>
            <a href="{{ route('catalog') }}" class="btn btn-secondary btn-sm">
                <span>Lihat Semua</span>
                <i data-lucide="arrow-right" style="width: 14px; height: 14px;"></i>
            </a>
        </div>

        <div class="accounts-grid">
            @forelse($latestAccounts as $acc)
                <div class="account-card">
                    <div class="account-media">
                        <img src="{{ $acc->thumbnail_url }}" alt="{{ $acc->title }}" class="account-thumb" loading="lazy">
                        
                        @if($acc->status === 'available')
                            <span class="badge-status badge-available">Ready</span>
                        @else
                            <span class="badge-status badge-sold">Terjual</span>
                        @endif

                        <span class="badge-code">#{{ $acc->code }}</span>

                        @if($acc->discount_percent > 0)
                            <span class="badge-discount-ribbon">Diskon {{ $acc->discount_percent }}%</span>
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
                                <span class="tag-badge" style="color: var(--gold);">{{ $acc->rank_tier }}</span>
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
                                <button class="btn btn-secondary btn-icon btn-toggle-wishlist" data-id="{{ $acc->id }}" title="Wishlist" style="width: 32px; height: 32px; {{ $isW ? 'color: var(--danger);' : '' }}">
                                    <i data-lucide="heart" style="width: 14px; height: 14px; {{ $isW ? 'fill: var(--danger);' : '' }}"></i>
                                </button>
                                <a href="{{ route('account.show', $acc->slug) }}" class="btn btn-primary btn-sm">
                                    <span>Detail</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; color: var(--text-dim); padding: 40px 20px; background: var(--bg-card); border-radius: var(--radius-md); border: 1px solid var(--border);">
                    <p style="font-size: 1rem; color: #fff; font-weight: 600;">Belum ada stok akun yang tersedia hari ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Trust Highlights -->
<section style="padding: 40px 0 50px; border-top: 1px solid var(--border); background: var(--bg-surface);">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px;">
            <div style="display: flex; gap: 14px; align-items: flex-start;">
                <div style="width: 42px; height: 42px; border-radius: var(--radius-sm); background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i data-lucide="shield-check" style="width: 22px; height: 22px;"></i>
                </div>
                <div>
                    <h4 style="font-size: 0.95rem; font-weight: 700; color: #fff; margin-bottom: 3px;">100% Anti Hackback</h4>
                    <p style="font-size: 0.82rem; color: var(--text-muted); line-height: 1.5;">Akun legal & bersih dari tangan pertama, siap ganti data aman.</p>
                </div>
            </div>

            <div style="display: flex; gap: 14px; align-items: flex-start;">
                <div style="width: 42px; height: 42px; border-radius: var(--radius-sm); background: var(--accent-purple-light); color: var(--accent-purple); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i data-lucide="zap" style="width: 22px; height: 22px;"></i>
                </div>
                <div>
                    <h4 style="font-size: 0.95rem; font-weight: 700; color: #fff; margin-bottom: 3px;">Proses Kilat 5 Menit</h4>
                    <p style="font-size: 0.82rem; color: var(--text-muted); line-height: 1.5;">Serah terima akun instan via WhatsApp / Discord resmi.</p>
                </div>
            </div>

            <div style="display: flex; gap: 14px; align-items: flex-start;">
                <div style="width: 42px; height: 42px; border-radius: var(--radius-sm); background: var(--gold-light); color: var(--gold); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i data-lucide="tag" style="width: 22px; height: 22px;"></i>
                </div>
                <div>
                    <h4 style="font-size: 0.95rem; font-weight: 700; color: #fff; margin-bottom: 3px;">Harga Tangan Pertama</h4>
                    <p style="font-size: 0.82rem; color: var(--text-muted); line-height: 1.5;">Harga langsung dari japost owner tanpa perantara liar.</p>
                </div>
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

    function showSlide(index) {
        if (slides.length === 0) return;
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
        showSlide(next);
    }

    function jumpToSlide(index) {
        clearInterval(slideTimer);
        showSlide(index);
        slideTimer = setInterval(nextSlide, 4000);
    }

    // Start auto slide
    if (slides.length > 1) {
        slideTimer = setInterval(nextSlide, 4000);
    }
</script>
@endpush

@endsection
