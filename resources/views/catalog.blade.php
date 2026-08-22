@extends('layouts.app')

@section('title', 'Katalog Stok Akun Game - ALzis STURR')
@section('meta_description', 'Katalog lengkap stok akun Mobile Legends, Free Fire, Genshin Impact, PUBGM, Valorant bergaransi 100% Anti Hackback.')

@section('content')
<div class="container" style="padding: 28px 20px 70px;">

    <!-- Top Header -->
    <div style="margin-bottom: 24px;">
        <div style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
            <a href="{{ route('home') }}">Beranda</a> 
            <span>/</span> 
            <span style="color: #fff; font-weight: 600;">Katalog Stok</span>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 12px;">
            <div>
                <h1 class="font-heading" style="font-size: 1.8rem; color: #fff; font-weight: 800; line-height: 1.2;">
                    Katalog Stok Akun Game
                </h1>
                <p style="color: var(--text-muted); font-size: 0.88rem; margin-top: 2px;">
                    Menampilkan <strong style="color: var(--primary);">{{ $accounts->total() }}</strong> akun game siap di-takeover bergaransi anti hackback.
                </p>
            </div>
        </div>
    </div>

    <!-- Category Pills Navigation -->
    <div class="category-pills" style="margin-bottom: 24px;">
        <a href="{{ route('catalog', array_merge(request()->except('category', 'page'), ['category' => 'all'])) }}" 
           class="category-pill {{ !request('category') || request('category') === 'all' ? 'active' : '' }}">
            <span>Semua Game</span>
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('catalog', array_merge(request()->except('category', 'page'), ['category' => $cat->slug])) }}" 
               class="category-pill {{ request('category') === $cat->slug ? 'active' : '' }}">
                <span>{{ $cat->name }}</span>
            </a>
        @endforeach
    </div>

    <!-- Active Filters Badge Row -->
    @php
        $activeFiltersCount = 0;
        if(request('q')) $activeFiltersCount++;
        if(request('category') && request('category') !== 'all') $activeFiltersCount++;
        if(request('status') && request('status') !== 'all') $activeFiltersCount++;
        if(request('server') && request('server') !== 'all') $activeFiltersCount++;
        if(request('bind') && request('bind') !== 'all') $activeFiltersCount++;
        if(request('min_price')) $activeFiltersCount++;
        if(request('max_price')) $activeFiltersCount++;
        if(request('discount_only')) $activeFiltersCount++;
    @endphp

    @if($activeFiltersCount > 0)
    <div class="filter-chips-wrapper">
        <span style="font-size: 0.78rem; font-weight: 700; color: var(--text-muted);">Filter Aktif:</span>

        @if(request('q'))
            <a href="{{ route('catalog', request()->except('q', 'page')) }}" class="filter-chip">
                <span>"{{ request('q') }}"</span>
                <span class="chip-remove">×</span>
            </a>
        @endif

        @if(request('category') && request('category') !== 'all')
            @php $currentCat = $categories->firstWhere('slug', request('category')) ?? $categories->firstWhere('id', request('category')); @endphp
            <a href="{{ route('catalog', request()->except('category', 'page')) }}" class="filter-chip">
                <span>Game: {{ $currentCat ? $currentCat->name : request('category') }}</span>
                <span class="chip-remove">×</span>
            </a>
        @endif

        @if(request('status') && request('status') !== 'all')
            <a href="{{ route('catalog', request()->except('status', 'page')) }}" class="filter-chip">
                <span>Status: {{ request('status') === 'available' ? 'Ready' : 'Terjual' }}</span>
                <span class="chip-remove">×</span>
            </a>
        @endif

        @if(request('server') && request('server') !== 'all')
            <a href="{{ route('catalog', request()->except('server', 'page')) }}" class="filter-chip">
                <span>Server: {{ request('server') }}</span>
                <span class="chip-remove">×</span>
            </a>
        @endif

        @if(request('bind') && request('bind') !== 'all')
            <a href="{{ route('catalog', request()->except('bind', 'page')) }}" class="filter-chip">
                <span>Bind: {{ request('bind') }}</span>
                <span class="chip-remove">×</span>
            </a>
        @endif

        @if(request('min_price') || request('max_price'))
            <a href="{{ route('catalog', request()->except('min_price', 'max_price', 'page')) }}" class="filter-chip">
                <span>Rp {{ request('min_price') ? number_format(request('min_price'),0,',','.') : '0' }} - {{ request('max_price') ? number_format(request('max_price'),0,',','.') : 'Max' }}</span>
                <span class="chip-remove">×</span>
            </a>
        @endif

        @if(request('discount_only'))
            <a href="{{ route('catalog', request()->except('discount_only', 'page')) }}" class="filter-chip">
                <span>Promo</span>
                <span class="chip-remove">×</span>
            </a>
        @endif

        <a href="{{ route('catalog') }}" class="btn-reset-filters">
            <span>Reset Semua</span>
        </a>
    </div>
    @endif

    <!-- Catalog Main Layout -->
    <div class="catalog-layout">
        <!-- Filter Sidebar -->
        <aside class="catalog-sidebar">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; padding-bottom: 10px; border-bottom: 1px solid var(--border);">
                <h3 style="font-size: 0.95rem; font-weight: 700; color: #fff; display: flex; align-items: center; gap: 6px;">
                    <i data-lucide="sliders-horizontal" style="width: 16px; height: 16px; color: var(--primary);"></i>
                    <span>Filter Produk</span>
                </h3>
                <a href="{{ route('catalog') }}" style="font-size: 0.75rem; color: var(--text-dim);">Reset</a>
            </div>

            <form action="{{ route('catalog') }}" method="GET" id="catalogFilterForm">
                <div class="form-group">
                    <label class="form-label">Kata Kunci</label>
                    <input type="text" name="q" value="{{ request('q') }}" class="input-control" placeholder="Nama, hero, skin...">
                </div>

                <div class="form-group">
                    <label class="form-label">Kategori Game</label>
                    <select name="category" class="input-control">
                        <option value="all">Semua Game</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Status Stok</label>
                    <select name="status" class="input-control">
                        <option value="all">Semua Status</option>
                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Ready (Tersedia)</option>
                        <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Terjual</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Server / Region</label>
                    <select name="server" class="input-control">
                        <option value="all">Semua Server</option>
                        <option value="Indonesia" {{ request('server') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                        <option value="Asia" {{ request('server') == 'Asia' ? 'selected' : '' }}>Asia</option>
                        <option value="Global" {{ request('server') == 'Global' ? 'selected' : '' }}>Global / Lainnya</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Tipe Bind</label>
                    <select name="bind" class="input-control">
                        <option value="all">Semua Bind</option>
                        @foreach($availableBinds as $bindName)
                            <option value="{{ $bindName }}" {{ request('bind') == $bindName ? 'selected' : '' }}>{{ $bindName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Rentang Harga (Rp)</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px;">
                        <input type="number" id="minPriceInput" name="min_price" value="{{ request('min_price') }}" class="input-control" placeholder="Min">
                        <input type="number" id="maxPriceInput" name="max_price" value="{{ request('max_price') }}" class="input-control" placeholder="Max">
                    </div>
                    <div class="price-quick-btns">
                        <button type="button" class="price-pill-btn" onclick="setPriceFilter(0, 500000)">&lt; 500rb</button>
                        <button type="button" class="price-pill-btn" onclick="setPriceFilter(500000, 1000000)">500rb-1jt</button>
                        <button type="button" class="price-pill-btn" onclick="setPriceFilter(1000000, 2000000)">1jt-2jt</button>
                        <button type="button" class="price-pill-btn" onclick="setPriceFilter(2000000, '')">&gt; 2jt</button>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Urutan</label>
                    <select name="sort" class="input-control">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Termurah</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Termahal</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Paling Banyak Dilihat</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-sm" style="width: 100%; margin-top: 8px;">
                    <span>Terapkan Filter</span>
                </button>
            </form>
        </aside>

        <!-- Product Listings -->
        <div>
            @if($accounts->count() > 0)
                <div class="accounts-grid">
                    @foreach($accounts as $acc)
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

                <!-- Pagination -->
                <div style="display: flex; justify-content: center; margin-top: 30px;">
                    {{ $accounts->links() }}
                </div>
            @else
                <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 50px 20px; text-align: center;">
                    <div style="width: 50px; height: 50px; border-radius: 50%; background: var(--primary-light); color: var(--primary); display: inline-flex; align-items: center; justify-content: center; margin-bottom: 14px;">
                        <i data-lucide="search-x" style="width: 26px; height: 26px;"></i>
                    </div>
                    <h3 style="font-size: 1.2rem; color: #fff; margin-bottom: 6px; font-weight: 700;">Tidak Ada Stok yang Cocok</h3>
                    <p style="color: var(--text-muted); max-width: 420px; margin: 0 auto 18px; font-size: 0.88rem;">
                        Tidak ada akun game yang sesuai dengan kriteria filter. Coba ubah kata kunci atau reset filter.
                    </p>
                    <a href="{{ route('catalog') }}" class="btn btn-primary btn-sm">
                        <span>Reset Semua Filter</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    function setPriceFilter(min, max) {
        document.getElementById('minPriceInput').value = min;
        document.getElementById('maxPriceInput').value = max;
        document.getElementById('catalogFilterForm').submit();
    }
</script>
@endpush
@endsection
