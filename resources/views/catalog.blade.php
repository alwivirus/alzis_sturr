@extends('layouts.app')

@section('title', 'Katalog Stok Akun Game - ALZIS STORE')
@section('meta_description', 'Katalog lengkap stok akun game Mobile Legends, Free Fire, Genshin Impact, PUBGM, Valorant murah, bergaransi 100% Anti Hackback.')

@section('content')
<div class="container" style="padding: 28px 18px 70px;">

    <!-- Top Header & Breadcrumb -->
    <div style="margin-bottom: 24px;">
        <div style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 6px; display: flex; align-items: center; gap: 6px;">
            <a href="{{ route('home') }}">Beranda</a> 
            <span>/</span> 
            <span style="color: #fff; font-weight: 700;">Katalog Produk & Akun</span>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 12px;">
            <div>
                <h1 class="font-heading" style="font-size: 1.85rem; color: #fff; font-weight: 900; line-height: 1.2;">
                    Katalog Produk & Akun Digital
                </h1>
                <p style="color: var(--text-muted); font-size: 0.88rem; margin-top: 2px;">
                    Menampilkan <strong style="color: var(--primary);">{{ $accounts->total() }}</strong> akun game, akun premium (CapCut dll), & layanan FT siap transaksi dengan garansi resmi 100% aman.
                </p>
            </div>
        </div>
    </div>

    <!-- Category Pills Navigation -->
    <div class="category-pills" style="margin-bottom: 22px;">
        <a href="{{ route('catalog', array_merge(request()->except('category', 'page'), ['category' => 'all'])) }}" 
           class="category-pill {{ !request('category') || request('category') === 'all' ? 'active' : '' }}">
            <svg style="width: 14px; height: 14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            <span>Semua Produk</span>
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
        if(request('type') && request('type') !== 'all') $activeFiltersCount++;
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
        <span style="font-size: 0.76rem; font-weight: 800; color: var(--text-muted);">FILTER AKTIF:</span>

        @if(request('type') && request('type') !== 'all')
            @php
                $typeNames = [
                    'game' => '🎮 Akun Game',
                    'app' => '📱 Akun Aplikasi',
                    'tournament' => '🏆 Fast Tournament (FT)',
                ];
            @endphp
            <a href="{{ route('catalog', request()->except('type', 'page')) }}" class="filter-chip">
                <span>Tipe: {{ $typeNames[request('type')] ?? request('type') }}</span>
                <span class="chip-remove">×</span>
            </a>
        @endif

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
                <span>Status: {{ request('status') === 'available' ? 'Ready Stok' : 'Terjual' }}</span>
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

        <a href="{{ route('catalog') }}" class="btn-reset-filters">
            Reset Semua Filter
        </a>
    </div>
    @endif

    <!-- Catalog Main Layout -->
    <div class="catalog-layout">
        <!-- Filter Sidebar -->
        <aside class="catalog-sidebar" id="catalogSidebarDrawer">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; padding-bottom: 10px; border-bottom: 1px solid var(--border);">
                <h3 style="font-size: 0.92rem; font-weight: 800; color: #fff; display: flex; align-items: center; gap: 6px; margin: 0;">
                    <svg style="width: 16px; height: 16px; color: var(--primary);" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/><line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/><line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/><line x1="1" y1="14" x2="7" y2="14"/><line x1="9" y1="8" x2="15" y2="8"/><line x1="17" y1="16" x2="23" y2="16"/></svg>
                    <span>Filter Pencarian</span>
                </h3>
                <a href="{{ route('catalog') }}" style="font-size: 0.74rem; color: #f59e0b; font-weight: 700; text-decoration: none;">Reset</a>
            </div>

            <form action="{{ route('catalog') }}" method="GET" id="catalogFilterForm">
                <!-- 1. Tipe Produk Filter -->
                <div class="form-group" style="margin-bottom: 12px;">
                    <label class="form-label" style="font-size: 0.72rem; font-weight: 800; text-transform: uppercase;">Tipe Produk</label>
                    <select name="type" class="input-control" onchange="toggleFilterType(this.value)" style="font-weight: 700;">
                        <option value="all" {{ !request('type') || request('type') == 'all' ? 'selected' : '' }}>🌟 Semua Produk</option>
                        <option value="game" {{ request('type') == 'game' ? 'selected' : '' }}>🎮 Akun Game (MLBB, FF, dll)</option>
                        <option value="app" {{ request('type') == 'app' ? 'selected' : '' }}>📱 Akun Aplikasi (CapCut, Spotify)</option>
                        <option value="tournament" {{ request('type') == 'tournament' || request('type') == 'service' ? 'selected' : '' }}>🏆 Fast Tournament (FT)</option>
                    </select>
                </div>

                <!-- 2. Kata Kunci -->
                <div class="form-group" style="margin-bottom: 12px;">
                    <label class="form-label" style="font-size: 0.72rem; font-weight: 800; text-transform: uppercase;">Kata Kunci</label>
                    <input type="text" name="q" value="{{ request('q') }}" class="input-control" placeholder="Nama produk, game, kode...">
                </div>

                <!-- 3. Kategori Terstruktur -->
                <div class="form-group" style="margin-bottom: 12px;">
                    <label class="form-label" style="font-size: 0.72rem; font-weight: 800; text-transform: uppercase;">Pilih Kategori</label>
                    <select name="category" class="input-control">
                        <option value="all">-- Semua Kategori --</option>
                        @php
                            $isApp = function($cat) {
                                $s = strtolower($cat->name . ' ' . $cat->slug);
                                return str_contains($s, 'capcut') || str_contains($s, 'alight') || str_contains($s, 'spotify') || str_contains($s, 'canva') || str_contains($s, 'netflix') || str_contains($s, 'aplikasi') || str_contains($s, 'app') || str_contains($s, 'premium');
                            };
                            $isFt = function($cat) {
                                $s = strtolower($cat->name . ' ' . $cat->slug);
                                return str_contains($s, 'fast tournament') || str_contains($s, 'tournament') || str_contains($s, 'ft') || str_contains($s, 'turnamen');
                            };
                            $appCats = $categories->filter($isApp);
                            $ftCats = $categories->filter($isFt);
                            $gameCats = $categories->reject($isApp)->reject($isFt);
                        @endphp
                        
                        @if($gameCats->count() > 0)
                        <optgroup label="🎮 Kategori Game">
                            @foreach($gameCats as $cat)
                                <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </optgroup>
                        @endif

                        @if($appCats->count() > 0)
                        <optgroup label="📱 Akun Aplikasi">
                            @foreach($appCats as $cat)
                                <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </optgroup>
                        @endif

                        @if($ftCats->count() > 0)
                        <optgroup label="🏆 Fast Tournament (FT)">
                            @foreach($ftCats as $cat)
                                <option value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </optgroup>
                        @endif
                    </select>
                </div>

                <!-- 4. Status Stok -->
                <div class="form-group" style="margin-bottom: 12px;">
                    <label class="form-label" style="font-size: 0.72rem; font-weight: 800; text-transform: uppercase;">Status Stok</label>
                    <select name="status" class="input-control">
                        <option value="all">Semua Status</option>
                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>🟢 Ready (Tersedia)</option>
                        <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>🔴 Terjual</option>
                    </select>
                </div>

                <!-- 5. Khusus Game (Server & Bind) -->
                <div id="catalog-game-filters" style="{{ request('type') === 'app' || request('type') === 'tournament' ? 'display:none;' : '' }}">
                    <div class="form-group" style="margin-bottom: 12px;">
                        <label class="form-label" style="font-size: 0.72rem; font-weight: 800; text-transform: uppercase;">Server / Region (Game)</label>
                        <select name="server" class="input-control">
                            <option value="all">Semua Server</option>
                            <option value="Indonesia" {{ request('server') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                            <option value="Asia" {{ request('server') == 'Asia' ? 'selected' : '' }}>Asia</option>
                            <option value="Global" {{ request('server') == 'Global' ? 'selected' : '' }}>Global / Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group" style="margin-bottom: 12px;">
                        <label class="form-label" style="font-size: 0.72rem; font-weight: 800; text-transform: uppercase;">Tipe Login / Bind (Game)</label>
                        <select name="bind" class="input-control">
                            <option value="all">Semua Bind</option>
                            @foreach($availableBinds as $bindName)
                                <option value="{{ $bindName }}" {{ request('bind') == $bindName ? 'selected' : '' }}>{{ $bindName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- 6. Rentang Harga Fleksibel -->
                <div class="form-group" style="margin-bottom: 14px;">
                    <label class="form-label" style="font-size: 0.72rem; font-weight: 800; text-transform: uppercase;">Rentang Harga (Rp)</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px; margin-bottom: 6px;">
                        <input type="number" id="minPriceInput" name="min_price" value="{{ request('min_price') }}" class="input-control" placeholder="Min (Rp)">
                        <input type="number" id="maxPriceInput" name="max_price" value="{{ request('max_price') }}" class="input-control" placeholder="Max (Rp)">
                    </div>
                    <div class="price-quick-btns" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 4px;">
                        <button type="button" class="price-pill-btn" onclick="setPriceFilter(0, 50000)">&lt; 50rb (App/FT)</button>
                        <button type="button" class="price-pill-btn" onclick="setPriceFilter(50000, 200000)">50rb - 200rb</button>
                        <button type="button" class="price-pill-btn" onclick="setPriceFilter(200000, 500000)">200rb - 500rb</button>
                        <button type="button" class="price-pill-btn" onclick="setPriceFilter(500000, '')">&gt; 500rb</button>
                    </div>
                </div>

                <!-- 7. Urutan -->
                <div class="form-group" style="margin-bottom: 14px;">
                    <label class="form-label" style="font-size: 0.72rem; font-weight: 800; text-transform: uppercase;">Urutan</label>
                    <select name="sort" class="input-control">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Termurah</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Termahal</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Paling Populer</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-sm" style="width: 100%; height: 38px; font-weight: 800;">
                    <svg style="width: 14px; height: 14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                    <span>Terapkan Filter</span>
                </button>
            </form>
        </aside>

        <!-- Product Listings Grid -->
        <div style="min-width: 0; width: 100%;">
            @if($accounts->count() > 0)
                <div class="accounts-grid">
                    @foreach($accounts as $acc)
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

                <!-- Pagination -->
                <div style="display: flex; justify-content: center; margin-top: 32px;">
                    {{ $accounts->links() }}
                </div>
            @else
                <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 50px 20px; text-align: center;">
                    <div style="width: 50px; height: 50px; border-radius: 50%; background: var(--primary-light); color: var(--primary); display: inline-flex; align-items: center; justify-content: center; margin-bottom: 14px;">
                        <svg style="width: 26px; height: 26px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="8" y1="8" x2="14" y2="14"/><line x1="14" y1="8" x2="8" y2="14"/></svg>
                    </div>
                    <h3 style="font-size: 1.2rem; color: #fff; margin-bottom: 6px; font-weight: 800;">Tidak Ada Stok yang Cocok</h3>
                    <p style="color: var(--text-muted); max-width: 420px; margin: 0 auto 18px; font-size: 0.88rem;">
                        Tidak ada akun game yang sesuai dengan kriteria filter Anda. Coba ganti kata kunci atau reset filter.
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

    function toggleFilterType(val) {
        const gameSection = document.getElementById('catalog-game-filters');
        if (gameSection) {
            if (val === 'app' || val === 'tournament') {
                gameSection.style.display = 'none';
            } else {
                gameSection.style.display = 'block';
            }
        }
    }
</script>
@endpush
@endsection
