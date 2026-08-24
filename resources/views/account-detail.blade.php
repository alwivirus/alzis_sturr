@extends('layouts.app')

@section('title', $account->title . ' - ALZIS STORE')
@section('meta_description', Str::limit(strip_tags($account->full_specs ?: $account->short_description), 150))

@section('content')
<div class="container" style="padding: 20px 16px 50px; max-width: 1040px;">

    <!-- Breadcrumb -->
    <div style="font-size: 0.78rem; color: var(--text-muted); margin-bottom: 14px; display: flex; align-items: center; gap: 6px; flex-wrap: wrap;">
        <a href="{{ route('home') }}">Beranda</a>
        <span>/</span> 
        <a href="{{ route('catalog') }}">Katalog</a>
        <span>/</span> 
        <a href="{{ route('catalog', ['category' => $account->category->slug]) }}">{{ $account->category->name }}</a>
        <span>/</span> 
        <span style="color: #fff; font-weight: 700;">#{{ $account->code }}</span>
    </div>

    <!-- Product Layout Grid -->
    <div class="detail-layout">
        <!-- Left: Image Gallery & Guarantee -->
        <div class="detail-gallery-col" style="width: 100%; min-width: 0;">
            <div class="gallery-main" id="mainGalleryBox" style="position: relative; width: 100%; aspect-ratio: 16 / 10; max-height: 310px; background: #050811; border-radius: 12px; overflow: hidden; border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-md); cursor: zoom-in;" onclick="openLightbox()">
                <img id="mainGalleryImg" src="{{ $account->thumbnail_url }}" alt="{{ $account->title }}" decoding="async" style="width: 100%; height: 100%; max-width: 100%; max-height: 100%; object-fit: contain; background: #050811; display: block;">
                
                @if($account->status === 'available')
                    <span class="badge-status badge-available" style="top: 10px; left: 10px; font-size: 0.7rem; padding: 4px 10px;">Ready Stok</span>
                @else
                    <span class="badge-status badge-sold" style="top: 10px; left: 10px; font-size: 0.7rem; padding: 4px 10px;">Terjual</span>
                @endif

                <span class="badge-code" style="bottom: 10px; left: 10px; font-size: 0.7rem; padding: 3px 8px;">#{{ $account->code }}</span>

                <!-- Zoom Prompt Badge -->
                <button type="button" class="zoom-trigger-btn" onclick="event.stopPropagation(); openLightbox();" title="Klik untuk Zoom Foto Fullscreen" style="position: absolute; bottom: 10px; right: 10px; background: rgba(5, 8, 17, 0.85); backdrop-filter: blur(8px); border: 1px solid rgba(245, 158, 11, 0.4); color: var(--primary); padding: 4px 10px; border-radius: 20px; font-size: 0.72rem; font-weight: 700; display: flex; align-items: center; gap: 5px; cursor: pointer; transition: all 0.2s ease;">
                    <svg style="width: 13px; height: 13px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                    <span>Zoom Foto</span>
                </button>
            </div>

            <!-- Thumbnails -->
            <div class="gallery-thumbs" style="display: flex; gap: 6px; margin-top: 8px; overflow-x: auto; padding-bottom: 4px; width: 100%; min-width: 0;">
                <div class="thumb-item active" onclick="switchGallery('{{ $account->thumbnail_url }}', this, 0)" style="width: 60px; height: 40px; flex-shrink: 0; border-radius: 6px; overflow: hidden; background: #050811; cursor: pointer;">
                    <img src="{{ $account->thumbnail_url }}" alt="Thumbnail" loading="lazy" decoding="async" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                @foreach($account->images as $idx => $img)
                    <div class="thumb-item" onclick="switchGallery('{{ $img->image_url }}', this, {{ $idx + 1 }})" style="width: 60px; height: 40px; flex-shrink: 0; border-radius: 6px; overflow: hidden; background: #050811; cursor: pointer;">
                        <img src="{{ $img->image_url }}" alt="Screenshot" loading="lazy" decoding="async" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                @endforeach
            </div>

            <!-- Guarantee Box -->
            <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: 12px; padding: 14px; margin-top: 14px;">
                <h4 style="font-size: 0.82rem; font-weight: 800; color: #fff; margin-bottom: 10px; display: flex; align-items: center; gap: 6px;">
                    <svg style="width: 16px; height: 16px; color: var(--primary);" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
                    <span>Jaminan & Keamanan Transaksi ALZIS STORE</span>
                </h4>
                <div class="guarantee-badges" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 6px;">
                    <div class="guarantee-card" style="padding: 8px 6px; text-align: center;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="width: 18px; height: 18px; color: var(--primary); margin: 0 auto 3px;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        <strong style="font-size: 0.74rem; display: block;">100% Anti HB</strong>
                        <div style="font-size: 0.65rem; color: var(--text-dim); margin-top: 1px;">Garansi Seumur Hidup</div>
                    </div>
                    <div class="guarantee-card" style="padding: 8px 6px; text-align: center;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="width: 18px; height: 18px; color: var(--accent-purple); margin: 0 auto 3px;"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><polyline points="17 11 19 13 23 9"/></svg>
                        <strong style="font-size: 0.74rem; display: block;">All Unbind</strong>
                        <div style="font-size: 0.65rem; color: var(--text-dim); margin-top: 1px;">Siap Bind Pribadi</div>
                    </div>
                    <div class="guarantee-card" style="padding: 8px 6px; text-align: center;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="width: 18px; height: 18px; color: var(--success); margin: 0 auto 3px;"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/></svg>
                        <strong style="font-size: 0.74rem; display: block;">Panduan 24/7</strong>
                        <div style="font-size: 0.65rem; color: var(--text-dim); margin-top: 1px;">Dipandu Tuntas</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Specs, Pricing, & Buy Box -->
        <div class="detail-info-col" style="width: 100%; min-width: 0;">
            <div class="detail-info-card" style="background: var(--bg-card); border: 1px solid var(--border); border-radius: 12px; padding: 16px 18px; box-shadow: var(--shadow-card);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                    <span class="account-category-name" style="font-size: 0.7rem; font-weight: 800; color: var(--primary); text-transform: uppercase; letter-spacing: 0.6px; margin-bottom: 0;">{{ $account->category->name }}</span>
                    <span style="font-size: 0.72rem; color: var(--text-dim); display: flex; align-items: center; gap: 4px;">
                        <svg style="width: 12px; height: 12px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        {{ $account->views_count }}x dilihat
                    </span>
                </div>

                <h1 class="font-heading" style="font-size: 1.15rem; color: #fff; font-weight: 800; line-height: 1.35; margin-bottom: 12px;">
                    {{ $account->title }}
                </h1>

                <!-- Pricing Box -->
                <div style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: 8px; padding: 10px 14px; display: flex; align-items: center; justify-content: space-between; margin-bottom: 12px;">
                    <div>
                        <span style="font-size: 0.65rem; color: var(--text-dim); text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;">Harga Net:</span>
                        <div style="display: flex; align-items: baseline; gap: 6px; margin-top: 2px;">
                            <span class="font-heading" style="font-size: 1.35rem; font-weight: 900; color: #fff;">
                                {{ $account->formatted_effective_price }}
                            </span>
                            @if($account->discount_price)
                                <span style="font-size: 0.8rem; color: var(--text-dim); text-decoration: line-through;">
                                    {{ $account->formatted_price }}
                                </span>
                            @endif
                        </div>
                    </div>

                    @php $isW = Auth::check() && $account->isWishlistedBy(Auth::user()); @endphp
                    <button type="button" class="btn btn-secondary btn-icon btn-toggle-wishlist" data-id="{{ $account->id }}" title="Wishlist" style="width: 34px; height: 34px; {{ $isW ? 'color: var(--danger);' : '' }}">
                        <svg style="width: 15px; height: 15px; {{ $isW ? 'fill: var(--danger);' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    </button>
                </div>

                @php
                    $isPartner = $account->isPartnerAccount();
                    $partner = $account->user;
                    $ownerWa = \App\Models\SiteSetting::get('whatsapp_number', '6282324634848');
                    $partnerPhone = ($isPartner && $partner && $partner->phone) ? preg_replace('/[^0-9]/', '', $partner->phone) : null;

                    if ($isPartner) {
                        $adminWaText = "Halo Admin Rekber ALZIS STORE, saya ingin membeli akun partner *" . $account->title . "* [Kode: " . $account->code . "] seharga *" . $account->formatted_effective_price . "* dari Mitra *" . ($partner ? $partner->name : 'Partner') . "*. Mohon dibantu proses transaksi aman/rekber resminya.";
                        $partnerWaText = "Halo " . ($partner ? $partner->name : 'Mitra') . ", saya ingin bertanya seputar akun *" . $account->title . "* [Kode: " . $account->code . "] di ALZIS STORE. (Transaksi tetap via Rekber Admin Utama).";
                    } else {
                        $adminWaText = "Halo Admin ALZIS STORE, saya tertarik membeli akun *" . $account->title . "* [Kode: " . $account->code . "] seharga *" . $account->formatted_effective_price . "*. Apakah stok ini masih tersedia?";
                    }
                @endphp

                @if($isPartner)
                <!-- Anti-Rip & Midman Protection Notice -->
                <div style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(217, 119, 6, 0.08) 100%); border: 1px solid rgba(245, 158, 11, 0.35); border-radius: 8px; padding: 10px 12px; margin-bottom: 12px;">
                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 8px; margin-bottom: 3px; flex-wrap: wrap;">
                        <div style="font-size: 0.74rem; font-weight: 800; color: #fbbf24; display: flex; align-items: center; gap: 5px;">
                            <svg style="width: 13px; height: 13px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            <span>REKBER RESMI ADMIN UTAMA (ANTI-RIP)</span>
                        </div>
                        <span style="font-size: 0.68rem; background: var(--primary-light); color: var(--primary); border: 1px solid var(--primary-border); padding: 1px 6px; border-radius: 4px; font-weight: 700;">
                            🤝 Mitra: {{ $partner ? $partner->name : 'Partner' }}
                        </span>
                    </div>
                    <p style="font-size: 0.74rem; color: #cbd5e1; margin: 0; line-height: 1.4;">
                        Untuk keamanan 100%, serah terima akun & pembayaran <strong>wajib diproses via Admin Utama ALZIS STORE</strong> sebagai Rekber/Midman resmi.
                    </p>
                </div>
                @endif

                <!-- Action Buttons Grid -->
                <div style="display: grid; grid-template-columns: {{ ($isPartner && $partnerPhone) ? '1.4fr 1fr 1fr' : '1fr 1fr' }}; gap: 8px; margin-bottom: 14px;">
                    <!-- Primary Admin/Rekber WhatsApp Button -->
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $ownerWa) }}?text={{ rawurlencode($adminWaText) }}" target="_blank" class="btn btn-whatsapp" style="padding: 9px 10px; font-size: 0.78rem; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; gap: 5px;" title="{{ $isPartner ? 'Beli via Rekber Admin Utama' : 'Beli via WhatsApp' }}">
                        <svg style="width: 14px; height: 14px; fill: currentColor; flex-shrink: 0;" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        <span>{{ $isPartner ? 'Beli via Rekber' : 'Beli WhatsApp' }}</span>
                    </a>

                    <!-- Optional Partner WhatsApp Contact -->
                    @if($isPartner && $partnerPhone)
                    <a href="https://wa.me/{{ $partnerPhone }}?text={{ rawurlencode($partnerWaText) }}" target="_blank" class="btn btn-secondary" style="padding: 9px 8px; font-size: 0.76rem; border-radius: 8px; border-color: rgba(245, 158, 11, 0.4); color: #fbbf24; display: inline-flex; align-items: center; justify-content: center; gap: 4px;" title="Tanya langsung ke Partner pemilik akun">
                        <svg style="width: 13px; height: 13px; fill: currentColor; flex-shrink: 0;" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg>
                        <span>Chat Mitra</span>
                    </a>
                    @endif

                    <a href="{{ \App\Models\SiteSetting::get('discord_invite_url', 'https://discord.gg/zEGEGs6hat') }}" target="_blank" class="btn btn-discord" style="padding: 9px 10px; font-size: 0.78rem; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; gap: 4px;">
                        <svg style="width: 14px; height: 14px; fill: currentColor; flex-shrink: 0;" viewBox="0 0 24 24"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994.021-.041.001-.09-.041-.106a13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.929 1.793 8.18 1.793 12.061 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.893.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.028zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.956-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.955-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.946 2.418-2.157 2.418z"/></svg>
                        <span>Discord</span>
                    </a>
                </div>

                <!-- Specifications Matrix -->
                <h3 style="font-size: 0.82rem; font-weight: 800; color: #fff; margin-bottom: 6px; display: flex; align-items: center; gap: 5px;">
                    <svg style="width: 14px; height: 14px; color: var(--primary);" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    <span>Spesifikasi Utama Akun</span>
                </h3>
                <div class="specs-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 5px; margin-bottom: 12px;">
                    <div class="spec-item" style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: 6px; padding: 6px 8px;">
                        <span class="spec-label" style="font-size: 0.62rem; color: var(--text-dim); display: block; font-weight: 700; text-transform: uppercase;">Server / Region</span>
                        <span class="spec-val" style="font-size: 0.78rem; font-weight: 700; color: #fff;">{{ $account->server }}</span>
                    </div>
                    @if($account->duration_text)
                    <div class="spec-item" style="background: var(--bg-surface); border: 1px solid rgba(245, 158, 11, 0.3); border-radius: 6px; padding: 6px 8px;">
                        <span class="spec-label" style="font-size: 0.62rem; color: #fbbf24; display: block; font-weight: 700; text-transform: uppercase;">Masa Aktif / Durasi</span>
                        <span class="spec-val" style="font-size: 0.78rem; font-weight: 700; color: #fff;">{{ $account->duration_text }}</span>
                    </div>
                    @endif
                    @if($account->account_variant)
                    <div class="spec-item" style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: 6px; padding: 6px 8px;">
                        <span class="spec-label" style="font-size: 0.62rem; color: var(--text-dim); display: block; font-weight: 700; text-transform: uppercase;">Tipe / Varian</span>
                        <span class="spec-val" style="font-size: 0.78rem; font-weight: 700; color: #fff;">{{ $account->account_variant }}</span>
                    </div>
                    @endif
                    @if($account->stock_qty && $account->stock_qty > 1)
                    <div class="spec-item" style="background: var(--bg-surface); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 6px; padding: 6px 8px;">
                        <span class="spec-label" style="font-size: 0.62rem; color: #34d399; display: block; font-weight: 700; text-transform: uppercase;">Stok Tersedia</span>
                        <span class="spec-val" style="font-size: 0.78rem; font-weight: 700; color: #fff;">{{ $account->stock_qty }} Slot / Akun Ready</span>
                    </div>
                    @endif
                    <div class="spec-item" style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: 6px; padding: 6px 8px;">
                        <span class="spec-label" style="font-size: 0.62rem; color: var(--text-dim); display: block; font-weight: 700; text-transform: uppercase;">Format / Tipe Bind</span>
                        <span class="spec-val" style="font-size: 0.78rem; font-weight: 700; color: #fff;">{{ $account->login_bind }}</span>
                    </div>
                    @if($account->rank_tier)
                    <div class="spec-item" style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: 6px; padding: 6px 8px;">
                        <span class="spec-label" style="font-size: 0.62rem; color: var(--text-dim); display: block; font-weight: 700; text-transform: uppercase;">Rank Saat Ini</span>
                        <span class="spec-val" style="font-size: 0.78rem; font-weight: 700; color: var(--gold);">{{ $account->rank_tier }}</span>
                    </div>
                    @endif
                    @if($account->hero_count)
                    <div class="spec-item" style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: 6px; padding: 6px 8px;">
                        <span class="spec-label" style="font-size: 0.62rem; color: var(--text-dim); display: block; font-weight: 700; text-transform: uppercase;">Total Hero</span>
                        <span class="spec-val" style="font-size: 0.78rem; font-weight: 700; color: #fff;">{{ $account->hero_count }} Hero</span>
                    </div>
                    @endif
                    @if($account->skin_count)
                    <div class="spec-item" style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: 6px; padding: 6px 8px;">
                        <span class="spec-label" style="font-size: 0.62rem; color: var(--text-dim); display: block; font-weight: 700; text-transform: uppercase;">Total Skin</span>
                        <span class="spec-val" style="font-size: 0.78rem; font-weight: 700; color: #fff;">{{ $account->skin_count }} Skin</span>
                    </div>
                    @endif
                    @if($account->winrate)
                    <div class="spec-item" style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: 6px; padding: 6px 8px;">
                        <span class="spec-label" style="font-size: 0.62rem; color: var(--text-dim); display: block; font-weight: 700; text-transform: uppercase;">Level Akun</span>
                        <span class="spec-val" style="font-size: 0.78rem; font-weight: 700; color: #fbbf24;">{{ str_starts_with(strtolower(trim($account->winrate)), 'level') || str_starts_with(strtolower(trim($account->winrate)), 'lv') ? $account->winrate : 'Level ' . $account->winrate }}</span>
                    </div>
                    @endif
                </div>

                <!-- Full Specs Description -->
                @if($account->full_specs)
                <h3 style="font-size: 0.82rem; font-weight: 800; color: #fff; margin-bottom: 5px; margin-top: 10px;">
                    Deskripsi & Daftar Item Lengkap
                </h3>
                <div style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: 6px; padding: 10px 12px; color: var(--text-muted); font-size: 0.8rem; line-height: 1.55; white-space: pre-line;">
                    {{ $account->full_specs }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Related / Recommended Accounts Section -->
    @if($relatedAccounts->count() > 0)
    <div style="margin-top: 36px; padding-top: 24px; border-top: 1px solid var(--border);">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 18px; flex-wrap: wrap; gap: 10px;">
            <div>
                <span style="font-size: 0.68rem; font-weight: 800; color: var(--primary); text-transform: uppercase; letter-spacing: 0.6px; display: inline-flex; align-items: center; gap: 4px;">
                    <svg style="width: 12px; height: 12px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    REKOMENDASI AKUN LAINNYA
                </span>
                <h3 class="font-heading" style="font-size: 1.3rem; color: #fff; font-weight: 900; margin-top: 2px;">
                    Temukan Akun Pilihan Lainnya
                </h3>
            </div>
            <a href="{{ route('catalog', ['category' => $account->category->slug]) }}" class="btn btn-secondary btn-sm" style="font-size: 0.78rem; padding: 6px 12px;">
                <span>Lihat Semua Akun {{ $account->category->name }}</span>
                <svg style="width: 13px; height: 13px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>

        <div class="accounts-grid">
            @foreach($relatedAccounts as $rel)
                <div class="account-card" onclick="if(!event.target.closest('.btn-toggle-wishlist') && !event.target.closest('a')) window.location='{{ route('account.show', $rel->slug) }}';" style="cursor: pointer;">
                    <a href="{{ route('account.show', $rel->slug) }}" class="account-card-overlay-link" aria-label="{{ $rel->title }}"></a>
                    <div class="account-media">
                        <img src="{{ $rel->thumbnail_url }}" alt="{{ $rel->title }}" class="account-thumb" loading="lazy" decoding="async" width="380" height="230">
                        @if($rel->status === 'available')
                            <span class="badge-status badge-available">Ready Stok</span>
                        @else
                            <span class="badge-status badge-sold">Terjual</span>
                        @endif
                        <span class="badge-code">#{{ $rel->code }}</span>
                        @if($rel->discount_percent > 0)
                            <span class="badge-discount-ribbon">Hemat {{ $rel->discount_percent }}%</span>
                        @endif
                    </div>
                    <div class="account-body">
                        <div class="account-category-name">{{ $rel->category ? $rel->category->name : 'Game Account' }}</div>
                        <h4 class="account-card-title">
                            <a href="{{ route('account.show', $rel->slug) }}">{{ $rel->title }}</a>
                        </h4>
                        <div class="account-tags-row">
                            <span class="tag-badge tag-server">{{ $rel->server }}</span>
                            <span class="tag-badge tag-bind">{{ Str::limit($rel->login_bind, 16) }}</span>
                            @if($rel->rank_tier)
                                <span class="tag-badge" style="color: var(--gold); border-color: var(--gold-border);">{{ $rel->rank_tier }}</span>
                            @endif
                        </div>
                        <div class="account-pricing">
                            <div class="price-box">
                                @if($rel->discount_price)
                                    <span class="price-strike">{{ $rel->formatted_price }}</span>
                                @endif
                                <span class="price-main">{{ $rel->formatted_effective_price }}</span>
                            </div>
                            <div class="account-actions">
                                <a href="{{ route('account.show', $rel->slug) }}" onclick="event.stopPropagation();" class="btn btn-primary btn-sm">
                                    <span>Detail</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<!-- Fullscreen Interactive Lightbox Image Zoom Modal -->
<div id="imageLightboxModal" style="display: none; position: fixed; inset: 0; background: rgba(3, 6, 12, 0.94); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); z-index: 999999; flex-direction: column; justify-content: space-between; padding: 16px; box-sizing: border-box;">
    <!-- Top Toolbar -->
    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; max-width: 1200px; margin: 0 auto; color: #fff;">
        <div style="display: flex; align-items: center; gap: 10px;">
            <span style="font-size: 0.85rem; font-weight: 700; background: rgba(255, 255, 255, 0.1); padding: 4px 10px; border-radius: 20px; border: 1px solid rgba(255, 255, 255, 0.15);" id="lightboxCounter">1 / 1</span>
            <span style="font-size: 0.82rem; color: var(--text-dim); display: none;" id="lightboxTitle">{{ $account->title }}</span>
        </div>

        <div style="display: flex; align-items: center; gap: 8px;">
            <!-- Zoom Controls -->
            <button type="button" onclick="zoomIn()" style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); color: #fff; width: 36px; height: 36px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Zoom In (+)">
                <svg style="width: 18px; height: 18px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
            </button>
            <button type="button" onclick="zoomOut()" style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); color: #fff; width: 36px; height: 36px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Zoom Out (-)">
                <svg style="width: 18px; height: 18px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
            </button>
            <button type="button" onclick="resetZoom()" style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); color: #fff; padding: 0 12px; height: 36px; border-radius: 8px; cursor: pointer; font-size: 0.75rem; font-weight: 700; display: flex; align-items: center; justify-content: center;" title="Reset Zoom">
                Reset
            </button>
            <!-- Close Button -->
            <button type="button" onclick="closeLightbox()" style="background: rgba(244, 63, 94, 0.2); border: 1px solid rgba(244, 63, 94, 0.5); color: #f43f5e; width: 36px; height: 36px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; margin-left: 8px;" title="Tutup (Esc)">
                <svg style="width: 20px; height: 20px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
    </div>

    <!-- Center Stage: Big Zoomable Image with Nav Arrows -->
    <div style="position: relative; flex: 1; display: flex; align-items: center; justify-content: center; overflow: hidden; width: 100%; margin: 10px 0;" onclick="handleStageClick(event)">
        <!-- Prev Arrow -->
        <button type="button" onclick="prevLightboxImg(event)" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); background: rgba(5, 8, 17, 0.7); border: 1px solid rgba(255, 255, 255, 0.2); color: #fff; width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 10; backdrop-filter: blur(8px);">
            <svg style="width: 22px; height: 22px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
        </button>

        <!-- Image Container -->
        <div id="lightboxImgContainer" style="max-width: 90vw; max-height: 75vh; display: flex; align-items: center; justify-content: center; transition: transform 0.2s cubic-bezier(0.2, 0, 0.2, 1); cursor: grab;">
            <img id="lightboxImg" src="" alt="Zoom Foto" style="max-width: 88vw; max-height: 72vh; object-fit: contain; border-radius: 8px; box-shadow: 0 10px 40px rgba(0,0,0,0.8); user-select: none; pointer-events: auto;">
        </div>

        <!-- Next Arrow -->
        <button type="button" onclick="nextLightboxImg(event)" style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); background: rgba(5, 8, 17, 0.7); border: 1px solid rgba(255, 255, 255, 0.2); color: #fff; width: 44px; height: 44px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 10; backdrop-filter: blur(8px);">
            <svg style="width: 22px; height: 22px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </button>
    </div>

    <!-- Bottom Thumbnail Strip -->
    <div style="display: flex; gap: 8px; justify-content: center; overflow-x: auto; padding: 6px 0; max-width: 1000px; margin: 0 auto; width: 100%;" id="lightboxThumbStrip">
        <!-- Rendered dynamically via JS -->
    </div>
</div>

@push('scripts')
<script>
    // Image dataset for lightbox & switcher
    const galleryImages = [
        "{{ $account->thumbnail_url }}",
        @foreach($account->images as $img)
            "{{ $img->image_url }}",
        @endforeach
    ];

    let currentIdx = 0;
    let currentZoom = 1;

    function switchGallery(imgUrl, thumbEl, idx = 0) {
        document.getElementById('mainGalleryImg').src = imgUrl;
        document.querySelectorAll('.thumb-item').forEach(el => el.classList.remove('active'));
        if (thumbEl) {
            thumbEl.classList.add('active');
        }
        currentIdx = idx;
    }

    function openLightbox() {
        const modal = document.getElementById('imageLightboxModal');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden'; // prevent page scroll
        renderLightboxThumbs();
        updateLightboxView();
    }

    function closeLightbox() {
        const modal = document.getElementById('imageLightboxModal');
        modal.style.display = 'none';
        document.body.style.overflow = '';
        resetZoom();
    }

    function updateLightboxView() {
        const img = document.getElementById('lightboxImg');
        img.src = galleryImages[currentIdx];
        document.getElementById('lightboxCounter').innerText = `${currentIdx + 1} / ${galleryImages.length}`;
        
        // Highlight active thumb in lightbox
        document.querySelectorAll('.lightbox-thumb').forEach((el, i) => {
            if (i === currentIdx) {
                el.style.borderColor = 'var(--primary)';
                el.style.opacity = '1';
                el.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
            } else {
                el.style.borderColor = 'rgba(255,255,255,0.2)';
                el.style.opacity = '0.5';
            }
        });
        resetZoom();
    }

    function renderLightboxThumbs() {
        const container = document.getElementById('lightboxThumbStrip');
        container.innerHTML = '';
        galleryImages.forEach((url, i) => {
            const thumb = document.createElement('div');
            thumb.className = 'lightbox-thumb';
            thumb.style.width = '50px';
            thumb.style.height = '34px';
            thumb.style.borderRadius = '4px';
            thumb.style.overflow = 'hidden';
            thumb.style.border = '2px solid rgba(255,255,255,0.2)';
            thumb.style.cursor = 'pointer';
            thumb.style.flexShrink = '0';
            thumb.style.transition = 'all 0.2s ease';
            thumb.innerHTML = `<img src="${url}" style="width: 100%; height: 100%; object-fit: cover;">`;
            thumb.onclick = (e) => {
                e.stopPropagation();
                currentIdx = i;
                updateLightboxView();
            };
            container.appendChild(thumb);
        });
    }

    function prevLightboxImg(e) {
        if (e) e.stopPropagation();
        currentIdx = (currentIdx - 1 + galleryImages.length) % galleryImages.length;
        updateLightboxView();
    }

    function nextLightboxImg(e) {
        if (e) e.stopPropagation();
        currentIdx = (currentIdx + 1) % galleryImages.length;
        updateLightboxView();
    }

    function zoomIn() {
        if (currentZoom < 3) {
            currentZoom += 0.4;
            applyZoom();
        }
    }

    function zoomOut() {
        if (currentZoom > 0.8) {
            currentZoom -= 0.4;
            applyZoom();
        }
    }

    function resetZoom() {
        currentZoom = 1;
        applyZoom();
    }

    function applyZoom() {
        const container = document.getElementById('lightboxImgContainer');
        container.style.transform = `scale(${currentZoom})`;
    }

    function handleStageClick(e) {
        if (e.target.id === 'lightboxImg') {
            // Toggle 1.8x zoom on image click
            if (currentZoom > 1) {
                resetZoom();
            } else {
                currentZoom = 1.8;
                applyZoom();
            }
        } else if (e.target.tagName !== 'BUTTON' && !e.target.closest('button')) {
            closeLightbox();
        }
    }

    // Keyboard Shortcuts (Esc to close, Arrow keys to navigate)
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('imageLightboxModal');
        if (modal && modal.style.display === 'flex') {
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') prevLightboxImg();
            if (e.key === 'ArrowRight') nextLightboxImg();
            if (e.key === '+' || e.key === '=') zoomIn();
            if (e.key === '-') zoomOut();
        }
    });
</script>
@endpush
@endsection
