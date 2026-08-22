@extends('layouts.app')

@section('title', $account->title . ' - ALzis STURR')
@section('meta_description', Str::limit(strip_tags($account->full_specs ?: $account->short_description), 150))

@section('content')
<div class="container" style="padding: 28px 20px 70px;">

    <!-- Breadcrumb -->
    <div style="font-size: 0.82rem; color: var(--text-muted); margin-bottom: 20px; display: flex; align-items: center; gap: 6px;">
        <a href="{{ route('home') }}">Beranda</a>
        <span>/</span> 
        <a href="{{ route('catalog') }}">Katalog</a>
        <span>/</span> 
        <a href="{{ route('catalog', ['category' => $account->category->slug]) }}">{{ $account->category->name }}</a>
        <span>/</span> 
        <span style="color: #fff; font-weight: 600;">#{{ $account->code }}</span>
    </div>

    <!-- Product Layout Grid -->
    <div class="detail-layout">
        <!-- Left: Image Gallery -->
        <div>
            <div class="gallery-main" id="mainGalleryBox">
                <img id="mainGalleryImg" src="{{ $account->thumbnail_url }}" alt="{{ $account->title }}">
                
                @if($account->status === 'available')
                    <span class="badge-status badge-available">Ready Stok</span>
                @else
                    <span class="badge-status badge-sold">Terjual</span>
                @endif

                <span class="badge-code">#{{ $account->code }}</span>
            </div>

            <!-- Thumbnails -->
            <div class="gallery-thumbs">
                <div class="thumb-item active" onclick="switchGallery('{{ $account->thumbnail_url }}', this)">
                    <img src="{{ $account->thumbnail_url }}" alt="Thumbnail">
                </div>
                @foreach($account->images as $img)
                    <div class="thumb-item" onclick="switchGallery('{{ $img->image_url }}', this)">
                        <img src="{{ $img->image_url }}" alt="Screenshot">
                    </div>
                @endforeach
            </div>

            <!-- Guarantee Box -->
            <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 20px; margin-top: 20px;">
                <h4 style="font-size: 0.95rem; font-weight: 700; color: #fff; margin-bottom: 14px; display: flex; align-items: center; gap: 6px;">
                    <i data-lucide="shield-check" style="width: 18px; height: 18px; color: var(--primary);"></i>
                    <span>Jaminan Transaksi ALzis STURR</span>
                </h4>
                <div class="guarantee-badges">
                    <div class="guarantee-card">
                        <i data-lucide="lock"></i>
                        <strong>100% Anti Hackback</strong>
                        <div style="font-size: 0.72rem; color: var(--text-dim); margin-top: 2px;">Garansi Seumur Hidup</div>
                    </div>
                    <div class="guarantee-card">
                        <i data-lucide="user-check"></i>
                        <strong>Data Bersih (Unbind)</strong>
                        <div style="font-size: 0.72rem; color: var(--text-dim); margin-top: 2px;">Siap Ganti Email Baru</div>
                    </div>
                    <div class="guarantee-card">
                        <i data-lucide="headphones"></i>
                        <strong>Panduan Tuntas</strong>
                        <div style="font-size: 0.72rem; color: var(--text-dim); margin-top: 2px;">Dibantu Sampai Login</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Specs, Pricing, & Buy Box -->
        <div>
            <div class="detail-info-card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                    <span class="account-category-name" style="margin-bottom: 0;">{{ $account->category->name }}</span>
                    <span style="font-size: 0.78rem; color: var(--text-dim); display: flex; align-items: center; gap: 4px;">
                        <i data-lucide="eye" style="width: 13px; height: 13px;"></i> {{ $account->views_count }}x dilihat
                    </span>
                </div>

                <h1 class="font-heading" style="font-size: 1.5rem; color: #fff; font-weight: 800; line-height: 1.3; margin-bottom: 16px;">
                    {{ $account->title }}
                </h1>

                <!-- Pricing Box -->
                <div style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 16px 20px; display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                    <div>
                        <span style="font-size: 0.75rem; color: var(--text-dim); text-transform: uppercase; font-weight: 600;">Harga Net:</span>
                        <div style="display: flex; align-items: baseline; gap: 10px; margin-top: 2px;">
                            <span class="font-heading" style="font-size: 1.8rem; font-weight: 800; color: #fff;">
                                {{ $account->formatted_effective_price }}
                            </span>
                            @if($account->discount_price)
                                <span style="font-size: 0.95rem; color: var(--text-dim); text-decoration: line-through;">
                                    {{ $account->formatted_price }}
                                </span>
                            @endif
                        </div>
                    </div>

                    @php $isW = Auth::check() && $account->isWishlistedBy(Auth::user()); @endphp
                    <button class="btn btn-secondary btn-icon btn-toggle-wishlist" data-id="{{ $account->id }}" title="Wishlist" style="{{ $isW ? 'color: var(--danger);' : '' }}">
                        <i data-lucide="heart" style="width: 17px; height: 17px; {{ $isW ? 'fill: var(--danger);' : '' }}"></i>
                    </button>
                </div>

                <!-- Action Buttons -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 24px;">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\SiteSetting::get('whatsapp_number', '6282324634848')) }}?text=Halo%20Admin%20ALzis%20STURR,%20saya%20tertarik%20membeli%20akun%20{{ urlencode($account->title) }}%20[Kode:%20{{ $account->code }}]%20seharga%20{{ urlencode($account->formatted_effective_price) }}" target="_blank" class="btn btn-primary" style="background: #25D366; border-color: #25D366; color: #fff; padding: 11px;">
                        <i data-lucide="message-circle" style="width: 16px; height: 16px;"></i>
                        <span>Beli via WhatsApp</span>
                    </a>
                    <a href="{{ \App\Models\SiteSetting::get('discord_invite_url', 'https://discord.gg/alzis-sturr') }}" target="_blank" class="btn btn-discord" style="padding: 11px;">
                        <i data-lucide="message-square" style="width: 16px; height: 16px;"></i>
                        <span>Ticket Discord</span>
                    </a>
                </div>

                <!-- Specifications Table -->
                <h3 style="font-size: 0.95rem; font-weight: 700; color: #fff; margin-bottom: 10px;">
                    Spesifikasi Akun
                </h3>
                <div class="specs-grid">
                    <div class="spec-item">
                        <span class="spec-label">Server / Region</span>
                        <span class="spec-val">{{ $account->server }}</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Tipe Bind / Login</span>
                        <span class="spec-val">{{ $account->login_bind }}</span>
                    </div>
                    @if($account->rank_tier)
                    <div class="spec-item">
                        <span class="spec-label">Rank Saat Ini</span>
                        <span class="spec-val" style="color: var(--gold);">{{ $account->rank_tier }}</span>
                    </div>
                    @endif
                    @if($account->level)
                    <div class="spec-item">
                        <span class="spec-label">Level</span>
                        <span class="spec-val">{{ $account->level }}</span>
                    </div>
                    @endif
                    @if($account->total_skins)
                    <div class="spec-item">
                        <span class="spec-label">Total Skin</span>
                        <span class="spec-val">{{ $account->total_skins }} Skin</span>
                    </div>
                    @endif
                    @if($account->total_heroes)
                    <div class="spec-item">
                        <span class="spec-label">Total Hero</span>
                        <span class="spec-val">{{ $account->total_heroes }} Hero</span>
                    </div>
                    @endif
                </div>

                <!-- Full Specs Description -->
                @if($account->full_specs)
                <h3 style="font-size: 0.95rem; font-weight: 700; color: #fff; margin-bottom: 8px;">
                    Detail & Deskripsi Lengkap
                </h3>
                <div style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 16px; color: var(--text-muted); font-size: 0.88rem; line-height: 1.65; white-space: pre-line;">
                    {{ $account->full_specs }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function switchGallery(imgUrl, thumbEl) {
        document.getElementById('mainGalleryImg').src = imgUrl;
        document.querySelectorAll('.thumb-item').forEach(el => el.classList.remove('active'));
        thumbEl.classList.add('active');
    }
</script>
@endpush
@endsection
