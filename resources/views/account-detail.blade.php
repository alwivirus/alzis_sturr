@extends('layouts.app')

@section('title', $account->title . ' - ALzis STURR')
@section('meta_description', Str::limit(strip_tags($account->full_specs ?: $account->short_description), 150))

@section('content')
<div class="container" style="padding: 40px 20px 90px;">

    <!-- Breadcrumb Banner -->
    <div style="background: linear-gradient(135deg, rgba(14, 22, 38, 0.8) 0%, rgba(9, 13, 22, 0.9) 100%); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 16px; padding: 14px 22px; margin-bottom: 32px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;">
        <div style="font-size: 0.85rem; color: #94a3b8; display: flex; align-items: center; gap: 8px;">
            <a href="{{ route('home') }}" style="color: #94a3b8; transition: color 0.2s;">Beranda</a>
            <span style="color: rgba(255,255,255,0.2);">/</span> 
            <a href="{{ route('catalog') }}" style="color: #94a3b8; transition: color 0.2s;">Katalog</a>
            <span style="color: rgba(255,255,255,0.2);">/</span> 
            <a href="{{ route('catalog', ['category' => $account->category->slug]) }}" style="color: #94a3b8; transition: color 0.2s;">{{ $account->category->name }}</a>
            <span style="color: rgba(255,255,255,0.2);">/</span> 
            <span style="color: #00f2fe; font-weight: 700;">#{{ $account->code }}</span>
        </div>
        <div style="display: flex; align-items: center; gap: 8px;">
            <span style="font-size: 0.8rem; color: #94a3b8; display: inline-flex; align-items: center; gap: 4px;">
                <i data-lucide="eye" style="width: 14px; height: 14px; color: #00f2fe;"></i> {{ $account->views_count }}x Dilihat
            </span>
        </div>
    </div>

    <!-- Product Layout Grid -->
    <div class="detail-layout" style="gap: 36px; margin-bottom: 60px;">
        <!-- Left: Image Gallery -->
        <div class="gallery-container">
            <div class="gallery-main" id="mainGalleryBox" style="border-radius: 20px; border: 1px solid rgba(0, 242, 254, 0.25); box-shadow: 0 16px 40px rgba(0,0,0,0.7);">
                <img id="mainGalleryImg" src="{{ $account->thumbnail_url }}" alt="{{ $account->title }}">
                
                @if($account->status === 'available')
                    <span class="badge-status badge-available" style="padding: 6px 14px; font-size: 0.8rem;">
                        <span style="width: 8px; height: 8px; border-radius: 50%; background: #fff; display: inline-block; animation: pulse 1.5s infinite;"></span>
                        Ready Stok
                    </span>
                @else
                    <span class="badge-status badge-sold" style="padding: 6px 14px; font-size: 0.8rem;">
                        <span style="width: 8px; height: 8px; border-radius: 50%; background: #fff; display: inline-block;"></span>
                        Terjual (Sold Out)
                    </span>
                @endif

                <span class="badge-code" style="font-size: 1.05rem; padding: 6px 16px; border-radius: 8px;">#{{ $account->code }}</span>
            </div>

            <!-- Thumbnails Carousel/Row -->
            <div class="gallery-thumbs" style="gap: 12px; margin-top: 14px;">
                <div class="thumb-item active" onclick="switchGallery('{{ $account->thumbnail_url }}', this)" style="border-radius: 12px;">
                    <img src="{{ $account->thumbnail_url }}" alt="Thumbnail Utama">
                </div>
                @foreach($account->images as $img)
                    <div class="thumb-item" onclick="switchGallery('{{ $img->image_url }}', this)" style="border-radius: 12px;">
                        <img src="{{ $img->image_url }}" alt="{{ $img->caption ?: 'Screenshot Akun' }}">
                    </div>
                @endforeach
            </div>

            <!-- Guarantee Box -->
            <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 20px; padding: 24px; margin-top: 24px;">
                <h4 class="font-gaming" style="font-size: 1.2rem; color: #fff; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                    <i data-lucide="shield-check" style="width: 20px; height: 20px; color: #00f2fe;"></i>
                    JAMINAN KEAMANAN TRANSAKSI ALZIS STURR
                </h4>
                <div class="guarantee-badges" style="gap: 12px;">
                    <div class="guarantee-card" style="border-radius: 14px; padding: 14px 10px;">
                        <i data-lucide="lock" style="color: #00f2fe;"></i>
                        <strong style="color: #fff;">100% Anti Hackback</strong>
                        <div style="font-size: 0.72rem; color: #94a3b8; margin-top: 4px;">Garansi Seumur Hidup</div>
                    </div>
                    <div class="guarantee-card" style="border-radius: 14px; padding: 14px 10px;">
                        <i data-lucide="user-check" style="color: #34d399;"></i>
                        <strong style="color: #fff;">Data Bersih (Unbind)</strong>
                        <div style="font-size: 0.72rem; color: #94a3b8; margin-top: 4px;">Siap Ganti Email/No HP</div>
                    </div>
                    <div class="guarantee-card" style="border-radius: 14px; padding: 14px 10px;">
                        <i data-lucide="check-circle" style="color: #fbbf24;"></i>
                        <strong style="color: #fff;">Panduan Tuntas</strong>
                        <div style="font-size: 0.72rem; color: #94a3b8; margin-top: 4px;">Dipandu Sampai Login Sukses</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Specs, Pricing, & Direct Buy Actions -->
        <div>
            <div class="detail-info-card" style="border-radius: 24px; padding: 32px; border: 1px solid rgba(0, 242, 254, 0.18);">
                <div class="detail-header" style="margin-bottom: 24px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                        <span class="account-category-name" style="font-size: 0.95rem; color: #00f2fe; font-weight: 800; letter-spacing: 1px;">
                            {{ $account->category->name }}
                        </span>
                        @if($account->discount_percent > 0)
                            <span class="badge-discount-ribbon" style="position: static; font-size: 0.78rem; padding: 4px 10px; border-radius: 8px;">
                                HEMAT {{ $account->discount_percent }}%
                            </span>
                        @endif
                    </div>
                    <h1 class="detail-title font-gaming" style="font-size: 1.8rem; color: #ffffff; line-height: 1.3;">{{ $account->title }}</h1>
                    
                    <!-- Pricing Banner -->
                    <div style="background: rgba(15, 23, 42, 0.9); border: 1px solid rgba(0, 242, 254, 0.25); border-radius: 16px; padding: 18px 24px; display: flex; align-items: center; justify-content: space-between; margin-top: 16px; margin-bottom: 24px;">
                        <div>
                            <div style="font-size: 0.8rem; color: #94a3b8; text-transform: uppercase; font-weight: 700;">Harga Net / Promo:</div>
                            <div style="display: flex; align-items: baseline; gap: 12px; margin-top: 2px;">
                                <span class="font-gaming" style="font-size: 2.3rem; font-weight: 800; color: #00f2fe; text-shadow: 0 0 15px rgba(0,242,254,0.3);">
                                    {{ $account->formatted_effective_price }}
                                </span>
                                @if($account->discount_price)
                                    <span style="font-size: 1.1rem; color: #64748b; text-decoration: line-through;">
                                        {{ $account->formatted_price }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Wishlist Toggle -->
                        @php $isW = Auth::check() && $account->isWishlistedBy(Auth::user()); @endphp
                        <button class="btn btn-secondary btn-icon btn-toggle-wishlist" data-id="{{ $account->id }}" title="Simpan ke Wishlist" style="width: 48px; height: 48px; border-radius: 50%; {{ $isW ? 'color: #f43f5e; border-color: #f43f5e;' : '' }}">
                            <i data-lucide="heart" style="width: 22px; height: 22px; color: {{ $isW ? '#f43f5e' : 'inherit' }}; {{ $isW ? 'fill: #f43f5e;' : '' }}"></i>
                        </button>
                    </div>

                    <!-- Direct Buy CTA Box -->
                    <div class="cta-box" style="border-radius: 18px; padding: 22px; margin-bottom: 28px; background: linear-gradient(135deg, rgba(16, 185, 129, 0.08) 0%, rgba(15, 23, 42, 0.9) 100%); border-color: rgba(16, 185, 129, 0.3);">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
                            <i data-lucide="zap" style="width: 20px; height: 20px; color: #34d399;"></i>
                            <span style="font-size: 0.95rem; font-weight: 700; color: #fff;">Tertarik dengan Akun Ini?</span>
                        </div>
                        <p style="font-size: 0.85rem; color: #cbd5e1; line-height: 1.5; margin-bottom: 16px;">
                            Hubungi Admin ALzis STURR sekarang untuk pengecekan data & handover kilat 5-10 menit.
                        </p>
                        
                        <div class="cta-buttons" style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\SiteSetting::get('whatsapp_number', '6281234567890')) }}?text=Halo%20Admin%20ALzis%20STURR,%20saya%20tertarik%20membeli%20akun%20{{ urlencode($account->title) }}%20[Kode:%20{{ $account->code }}]%20seharga%20{{ urlencode($account->formatted_effective_price) }}" target="_blank" class="btn btn-primary" style="background: #25D366; border-color: #25D366; color: #fff; font-weight: 700; box-shadow: 0 4px 20px rgba(37, 211, 102, 0.35); border-radius: 14px; padding: 12px;">
                                <i data-lucide="message-circle" style="width: 18px; height: 18px;"></i>
                                <span>Beli via WhatsApp</span>
                            </a>
                            <a href="{{ \App\Models\SiteSetting::get('discord_invite_url', 'https://discord.gg/alzis-sturr') }}" target="_blank" class="btn btn-discord" style="border-radius: 14px; padding: 12px;">
                                <svg style="width: 18px; height: 18px; fill: currentColor;" viewBox="0 0 24 24"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994.021-.041.001-.09-.041-.106a13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.929 1.793 8.18 1.793 12.061 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.893.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.028zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.956-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.955-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.946 2.418-2.157 2.418z"/></svg>
                                <span>Ticket Discord</span>
                            </a>
                        </div>
                    </div>

                    <!-- Key Specifications Grid -->
                    <h3 class="font-gaming" style="font-size: 1.25rem; color: #fff; margin-bottom: 14px; display: flex; align-items: center; gap: 8px;">
                        <i data-lucide="cpu" style="width: 18px; height: 18px; color: #00f2fe;"></i>
                        SPESIFIKASI UTAMA AKUN
                    </h3>
                    <div class="specs-grid" style="border-radius: 16px; padding: 20px; gap: 16px; margin-bottom: 28px;">
                        <div class="spec-item">
                            <span class="spec-label">Server / Region</span>
                            <span class="spec-val" style="color: #7dd3fc;">{{ $account->server }}</span>
                        </div>
                        <div class="spec-item">
                            <span class="spec-label">Tipe Bind / Login</span>
                            <span class="spec-val" style="color: #d8b4fe;">{{ $account->login_bind }}</span>
                        </div>
                        @if($account->rank_tier)
                        <div class="spec-item">
                            <span class="spec-label">Rank / Tier Saat Ini</span>
                            <span class="spec-val" style="color: #fbbf24;">{{ $account->rank_tier }}</span>
                        </div>
                        @endif
                        @if($account->level)
                        <div class="spec-item">
                            <span class="spec-label">Level Akun</span>
                            <span class="spec-val">{{ $account->level }}</span>
                        </div>
                        @endif
                        @if($account->total_skins)
                        <div class="spec-item">
                            <span class="spec-label">Total Koleksi Skin</span>
                            <span class="spec-val" style="color: #f43f5e;">{{ $account->total_skins }} Skins</span>
                        </div>
                        @endif
                        @if($account->total_heroes)
                        <div class="spec-item">
                            <span class="spec-label">Total Hero / Karakter</span>
                            <span class="spec-val">{{ $account->total_heroes }} Heroes</span>
                        </div>
                        @endif
                    </div>

                    <!-- Full Specifications Text -->
                    @if($account->full_specs)
                    <h3 class="font-gaming" style="font-size: 1.25rem; color: #fff; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                        <i data-lucide="file-text" style="width: 18px; height: 18px; color: #00f2fe;"></i>
                        DESKRIPSI LENGKAP & DETAIL SPEK
                    </h3>
                    <div style="background: rgba(15, 23, 42, 0.7); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 22px; color: #cbd5e1; font-size: 0.92rem; line-height: 1.7; white-space: pre-line;">
                        {{ $account->full_specs }}
                    </div>
                    @endif

                </div>
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
