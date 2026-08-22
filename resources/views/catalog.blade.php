@extends('layouts.app')

@section('title', 'Katalog Stok Akun Game Sultan - ALzis STURR')
@section('meta_description', 'Katalog lengkap stok akun Mobile Legends, Free Fire, Genshin Impact, PUBGM, Valorant, & HOK bergaransi 100% Anti Hackback.')

@section('content')
<div class="container" style="padding: 30px 20px 80px;">

    <!-- Top Banner & Header Breadcrumb -->
    <div style="margin-bottom: 24px;">
        <div style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 6px; display: flex; align-items: center; gap: 6px;">
            <a href="{{ route('home') }}" style="color: var(--text-muted); transition: color 0.2s;">Beranda</a> 
            <span style="color: var(--border-color);">/</span> 
            <span style="color: var(--primary); font-weight: 600;">Katalog Stok</span>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px;">
            <div>
                <h1 class="font-gaming" style="font-size: 2.3rem; color: #fff; line-height: 1.1;">
                    KATALOG STOK <span class="text-gradient-cyan">AKUN GAME JAPOST</span>
                </h1>
                <p style="color: var(--text-muted); font-size: 0.95rem; margin-top: 4px;">
                    Ditemukan <strong style="color: var(--primary);">{{ $accounts->total() }}</strong> akun game siap di-takeover bergaransi anti hackback.
                </p>
            </div>

            <!-- Quick Category Pill Scrollbar -->
            <div class="category-pills" style="margin-bottom: 0; padding-bottom: 0;">
                <a href="{{ route('catalog', array_merge(request()->except('category', 'page'), ['category' => 'all'])) }}" 
                   class="category-pill {{ !request('category') || request('category') === 'all' ? 'active' : '' }}">
                    🎮 Semua Game
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('catalog', array_merge(request()->except('category', 'page'), ['category' => $cat->slug])) }}" 
                       class="category-pill {{ request('category') === $cat->slug ? 'active' : '' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Active Filter Badges Display (If Any Filter Active) -->
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
        <span class="filter-chip-label">
            <i data-lucide="filter" style="width: 14px; height: 14px; color: var(--primary);"></i>
            Filter Aktif:
        </span>

        @if(request('q'))
            <a href="{{ route('catalog', request()->except('q', 'page')) }}" class="filter-chip" title="Hapus kata kunci">
                <span>Cari: "{{ request('q') }}"</span>
                <span class="chip-remove">×</span>
            </a>
        @endif

        @if(request('category') && request('category') !== 'all')
            @php $currentCat = $categories->firstWhere('slug', request('category')) ?? $categories->firstWhere('id', request('category')); @endphp
            <a href="{{ route('catalog', request()->except('category', 'page')) }}" class="filter-chip" title="Hapus kategori">
                <span>Game: {{ $currentCat ? $currentCat->name : request('category') }}</span>
                <span class="chip-remove">×</span>
            </a>
        @endif

        @if(request('status') && request('status') !== 'all')
            <a href="{{ route('catalog', request()->except('status', 'page')) }}" class="filter-chip" title="Hapus status">
                <span>Status: {{ request('status') === 'available' ? 'Ready (Tersedia)' : 'Terjual' }}</span>
                <span class="chip-remove">×</span>
            </a>
        @endif

        @if(request('server') && request('server') !== 'all')
            <a href="{{ route('catalog', request()->except('server', 'page')) }}" class="filter-chip" title="Hapus filter server">
                <span>Server: {{ request('server') }}</span>
                <span class="chip-remove">×</span>
            </a>
        @endif

        @if(request('bind') && request('bind') !== 'all')
            <a href="{{ route('catalog', request()->except('bind', 'page')) }}" class="filter-chip" title="Hapus filter bind">
                <span>Bind: {{ request('bind') }}</span>
                <span class="chip-remove">×</span>
            </a>
        @endif

        @if(request('min_price') || request('max_price'))
            <a href="{{ route('catalog', request()->except('min_price', 'max_price', 'page')) }}" class="filter-chip" title="Hapus rentang harga">
                <span>Harga: {{ request('min_price') ? 'Rp ' . number_format(request('min_price'),0,',','.') : '0' }} - {{ request('max_price') ? 'Rp ' . number_format(request('max_price'),0,',','.') : 'Max' }}</span>
                <span class="chip-remove">×</span>
            </a>
        @endif

        @if(request('discount_only'))
            <a href="{{ route('catalog', request()->except('discount_only', 'page')) }}" class="filter-chip" title="Hapus promo only">
                <span>⚡ Khusus Promo</span>
                <span class="chip-remove">×</span>
            </a>
        @endif

        <a href="{{ route('catalog') }}" class="btn-reset-filters">
            <i data-lucide="rotate-ccw" style="width: 12px; height: 12px;"></i>
            <span>Reset Semua</span>
        </a>
    </div>
    @endif

    <!-- Main Catalog Grid Layout with Sidebar -->
    <div style="display: grid; grid-template-columns: 290px 1fr; gap: 30px; align-items: start;">

        <!-- Sidebar Filter Card -->
        <aside style="background: var(--bg-card); backdrop-filter: blur(16px); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 24px; position: sticky; top: 90px; box-shadow: var(--shadow-card);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 1px solid var(--border-color);">
                <h3 class="font-gaming" style="font-size: 1.2rem; color: #fff; display: flex; align-items: center; gap: 8px;">
                    <i data-lucide="sliders-horizontal" style="width: 18px; height: 18px; color: var(--primary);"></i>
                    FILTER PENCARIAN
                </h3>
                <a href="{{ route('catalog') }}" style="font-size: 0.75rem; color: var(--text-muted); text-decoration: underline;">Reset</a>
            </div>

            <form action="{{ route('catalog') }}" method="GET" id="catalogFilterForm">
                
                <!-- Search Keyword -->
                <div class="form-group" style="margin-bottom: 16px;">
                    <label class="form-label" style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600; display: block; margin-bottom: 6px;">
                        Kata Kunci
                    </label>
                    <input type="text" name="q" value="{{ request('q') }}" class="input-control" placeholder="Cari nama / spek / kode...">
                </div>

                <!-- Game Category -->
                <div class="form-group" style="margin-bottom: 16px;">
                    <label class="form-label" style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600; display: block; margin-bottom: 6px;">
                        Kategori Game
                    </label>
                    <select name="category" class="input-control">
                        <option value="all">🎮 Semua Game</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Stock Status -->
                <div class="form-group" style="margin-bottom: 16px;">
                    <label class="form-label" style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600; display: block; margin-bottom: 6px;">
                        Status Ketersediaan
                    </label>
                    <select name="status" class="input-control">
                        <option value="all">⚡ Semua Status</option>
                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>🟢 Ready (Tersedia)</option>
                        <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>🔴 Terjual (Sold Out)</option>
                    </select>
                </div>

                <!-- Server / Region -->
                <div class="form-group" style="margin-bottom: 16px;">
                    <label class="form-label" style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600; display: block; margin-bottom: 6px;">
                        Server / Region
                    </label>
                    <select name="server" class="input-control">
                        <option value="all">🌐 Semua Server</option>
                        <option value="Indonesia" {{ request('server') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                        <option value="Asia" {{ request('server') == 'Asia' ? 'selected' : '' }}>Asia</option>
                        <option value="Global" {{ request('server') == 'Global' ? 'selected' : '' }}>Global / Lainnya</option>
                    </select>
                </div>

                <!-- Bind Type -->
                <div class="form-group" style="margin-bottom: 16px;">
                    <label class="form-label" style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600; display: block; margin-bottom: 6px;">
                        Tipe Login / Bind
                    </label>
                    <select name="bind" class="input-control">
                        <option value="all">🔒 Semua Tipe Bind</option>
                        @foreach($availableBinds as $bindName)
                            <option value="{{ $bindName }}" {{ request('bind') == $bindName ? 'selected' : '' }}>{{ $bindName }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Price Range -->
                <div class="form-group" style="margin-bottom: 16px;">
                    <label class="form-label" style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600; display: block; margin-bottom: 6px;">
                        Rentang Harga (Rp)
                    </label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
                        <input type="number" id="minPriceInput" name="min_price" value="{{ request('min_price') }}" class="input-control" placeholder="Min Rp">
                        <input type="number" id="maxPriceInput" name="max_price" value="{{ request('max_price') }}" class="input-control" placeholder="Max Rp">
                    </div>

                    <!-- Quick Price Buttons -->
                    <div class="price-quick-btns">
                        <button type="button" class="price-pill-btn" onclick="setPriceFilter(0, 500000)">&lt; 500rb</button>
                        <button type="button" class="price-pill-btn" onclick="setPriceFilter(500000, 1000000)">500rb - 1jt</button>
                        <button type="button" class="price-pill-btn" onclick="setPriceFilter(1000000, 2000000)">1jt - 2jt</button>
                        <button type="button" class="price-pill-btn" onclick="setPriceFilter(2000000, '')">&gt; 2jt</button>
                    </div>
                </div>

                <!-- Promo / Discount Only Toggle -->
                <div style="margin-bottom: 20px; padding: 10px 12px; background: rgba(0, 242, 254, 0.05); border: 1px solid rgba(0, 242, 254, 0.15); border-radius: var(--radius-sm); display: flex; align-items: center; gap: 8px; cursor: pointer;">
                    <input type="checkbox" id="discountOnly" name="discount_only" value="1" {{ request('discount_only') ? 'checked' : '' }} style="cursor: pointer; accent-color: var(--primary);">
                    <label for="discountOnly" style="font-size: 0.85rem; color: #fff; cursor: pointer; user-select: none;">
                        🔥 Hanya Akun Diskon / Promo
                    </label>
                </div>

                <!-- Sorting -->
                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="form-label" style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600; display: block; margin-bottom: 6px;">
                        Urutkan Hasil
                    </label>
                    <select name="sort" class="input-control">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>✨ Terbaru Diposting</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>💰 Harga Termurah</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>💎 Harga Termahal</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>🔥 Paling Banyak Dilihat</option>
                        <option value="discount" {{ request('sort') == 'discount' ? 'selected' : '' }}>🏷️ Diskon Terbesar</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i data-lucide="check-circle" style="width: 18px; height: 18px;"></i>
                    <span>Terapkan Filter</span>
                </button>
            </form>
        </aside>

        <!-- Product Listings -->
        <div>
            @if($accounts->count() > 0)
                <div class="accounts-grid" style="margin-bottom: 40px;">
                    @foreach($accounts as $acc)
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
                <!-- Empty State -->
                <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 60px 24px; text-align: center; box-shadow: var(--shadow-card);">
                    <div style="width: 76px; height: 76px; border-radius: 50%; background: rgba(0, 242, 254, 0.1); border: 1px solid var(--border-glow); display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                        <i data-lucide="search-x" style="width: 38px; height: 38px; color: var(--primary);"></i>
                    </div>
                    <h3 class="font-gaming" style="font-size: 1.8rem; color: #fff; margin-bottom: 8px;">Tidak Ada Stok yang Cocok</h3>
                    <p style="color: var(--text-muted); max-width: 480px; margin: 0 auto 24px; font-size: 0.95rem;">
                        Maaf, tidak ada akun game yang sesuai dengan kriteria filter yang Anda pilih. Coba sesuaikan kata kunci atau reset filter untuk melihat semua stok.
                    </p>
                    <a href="{{ route('catalog') }}" class="btn btn-primary">
                        <i data-lucide="rotate-ccw" style="width: 16px; height: 16px;"></i>
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
