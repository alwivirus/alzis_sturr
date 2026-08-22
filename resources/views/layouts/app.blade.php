<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ALzis STURR') - Jual Beli Akun Game Terpercaya</title>
    <meta name="description" content="@yield('meta_description', 'ALzis STURR - Jual beli dan japost akun Mobile Legends, Free Fire, Genshin Impact, PUBG Mobile, Valorant terpercaya 100% anti hackback.')">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/alzis.css') }}?v={{ time() }}">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @stack('styles')
</head>
<body>

    <!-- Top Announcement Bar -->
    <div class="top-announcement">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 8px; overflow: hidden; white-space: nowrap;">
                <span style="color: var(--primary); font-weight: 800; font-size: 0.75rem; letter-spacing: 0.5px;">🔥 PENGUMUMAN:</span>
                <span style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ \App\Models\SiteSetting::get('banner_announcement', 'PROMO SPESIAL ALzis STURR! Transaksi Cepat & 100% Anti Hackback via Discord & WhatsApp.') }}</span>
            </div>
            <div style="display: flex; align-items: center; gap: 8px; flex-shrink: 0;">
                <a href="{{ \App\Models\SiteSetting::get('discord_invite_url', 'https://discord.gg/alzis-sturr') }}" target="_blank" class="top-contact-pill">
                    <svg style="width: 14px; height: 14px; fill: currentColor;" viewBox="0 0 24 24"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994.021-.041.001-.09-.041-.106a13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.929 1.793 8.18 1.793 12.061 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.893.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.028zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.956-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.955-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.946 2.418-2.157 2.418z"/></svg>
                    <span>Discord</span>
                </a>
                <a href="https://instagram.com/{{ \App\Models\SiteSetting::get('instagram_username', 'alzis_sturr') }}" target="_blank" class="top-contact-pill">
                    <svg style="width: 13px; height: 13px; fill: currentColor;" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    <span>&#64;{{ \App\Models\SiteSetting::get('instagram_username', 'alzis_sturr') }}</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <header class="navbar">
        <div class="container">
            <div class="nav-wrapper">
                <!-- Brand Official Logo Emblem -->
                <a href="{{ route('home') }}" class="brand-logo" style="display: flex; align-items: center; gap: 12px;">
                    <img src="{{ asset('images/logo.png') }}?v={{ time() }}" alt="ALZIS STORE Emblem" style="height: 38px; width: auto; object-fit: contain; filter: drop-shadow(0 0 10px rgba(0, 242, 254, 0.6));">
                    <div style="display: flex; flex-direction: column;">
                        <span style="font-size: 1.25rem; font-weight: 800; font-family: var(--font-heading); color: #fff; line-height: 1.1; letter-spacing: 0.5px;">
                            ALZIS <span style="color: var(--primary);">STORE</span>
                        </span>
                        <span style="font-size: 0.65rem; color: var(--text-dim); font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;">
                            GAMING STORE
                        </span>
                    </div>
                </a>

                <!-- Desktop Nav Menu -->
                <nav>
                    <ul class="nav-menu">
                        <li>
                            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                                <span>Beranda</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('catalog') }}" class="nav-link {{ request()->routeIs('catalog') ? 'active' : '' }}">
                                <span>Katalog Stok</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('how.to.buy') }}" class="nav-link {{ request()->routeIs('how.to.buy') ? 'active' : '' }}">
                                <span>Cara Beli & Garansi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                                <span>Bantuan & Kontak</span>
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- Header Search Bar -->
                <form action="{{ route('catalog') }}" method="GET" class="nav-search-bar">
                    <i data-lucide="search" style="width: 15px; height: 15px; color: var(--text-dim); flex-shrink: 0;"></i>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari akun, hero, skin...">
                </form>

                <!-- Nav Actions -->
                <div class="nav-actions">
                    @auth
                        <!-- Wishlist Button -->
                        <a href="{{ route('wishlist.index') }}" class="btn btn-secondary btn-icon" title="Wishlist Favorit" style="position: relative;">
                            <i data-lucide="heart" style="width: 17px; height: 17px; {{ Auth::user()->wishlists()->count() > 0 ? 'color: var(--danger); fill: var(--danger);' : '' }}"></i>
                            <span id="nav-wishlist-badge" class="wishlist-badge" style="{{ Auth::user()->wishlists()->count() > 0 ? 'display: flex;' : 'display: none;' }}">
                                {{ Auth::user()->wishlists()->count() }}
                            </span>
                        </a>

                        @if(Auth::user()->isOwner())
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm" style="background: rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.4); color: #fbbf24; font-weight: 700;">
                                <i data-lucide="shield" style="width: 14px; height: 14px;"></i>
                                <span>Owner Panel</span>
                            </a>
                        @elseif(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm" style="background: rgba(0, 242, 254, 0.15); border: 1px solid rgba(0, 242, 254, 0.4); color: var(--primary); font-weight: 700;">
                                <i data-lucide="shield" style="width: 14px; height: 14px;"></i>
                                <span>Admin Panel</span>
                            </a>
                        @endif

                        <a href="{{ route('profile') }}" class="btn btn-secondary btn-sm" style="gap: 8px;">
                            <i data-lucide="user" style="width: 14px; height: 14px;"></i>
                            <span style="max-width: 90px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ Auth::user()->name }}</span>
                        </a>

                        <!-- Logout -->
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-icon" title="Keluar Akun" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                                <i data-lucide="log-out" style="width: 15px; height: 15px; color: var(--text-dim);"></i>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('wishlist.index') }}" class="btn btn-secondary btn-icon" title="Wishlist">
                            <i data-lucide="heart" style="width: 17px; height: 17px;"></i>
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-secondary btn-sm">
                            <span>Masuk</span>
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                            <span>Daftar</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Flash Messages -->
    <div class="container" style="margin-top: 16px;">
        @if(session('success'))
            <div style="background: rgba(16, 185, 129, 0.12); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: var(--radius-sm); padding: 12px 16px; color: #34d399; font-size: 0.88rem; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="check-circle-2" style="width: 18px; height: 18px; flex-shrink: 0;"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div style="background: rgba(244, 63, 94, 0.12); border: 1px solid rgba(244, 63, 94, 0.3); border-radius: var(--radius-sm); padding: 12px 16px; color: #fb7185; font-size: 0.88rem; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="alert-circle" style="width: 18px; height: 18px; flex-shrink: 0;"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <!-- Footer Brand Logo -->
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 14px;">
                        <img src="{{ asset('images/logo.png') }}?v={{ time() }}" alt="ALZIS STORE Emblem" style="height: 44px; width: auto; object-fit: contain; filter: drop-shadow(0 0 10px rgba(0, 242, 254, 0.5));">
                        <div>
                            <div style="font-size: 1.25rem; font-weight: 800; font-family: var(--font-heading); color: #fff; line-height: 1.1;">
                                ALZIS <span style="color: var(--primary);">STORE</span>
                            </div>
                            <div style="font-size: 0.68rem; color: var(--text-dim); letter-spacing: 1.5px; text-transform: uppercase;">GAMING MARKETPLACE</div>
                        </div>
                    </div>
                    <p style="color: var(--text-muted); font-size: 0.88rem; line-height: 1.6; margin-bottom: 18px;">
                        Pusat jual beli & japost akun game online terpercaya: Mobile Legends, Free Fire, Genshin Impact, PUBG Mobile, Valorant dengan garansi 100% Anti Hackback.
                    </p>
                    <div class="social-icon-links">
                        <!-- Discord SVG -->
                        <a href="{{ \App\Models\SiteSetting::get('discord_invite_url', 'https://discord.gg/alzis-sturr') }}" target="_blank" class="social-icon-btn" title="Discord Official" style="background: rgba(88, 101, 242, 0.12); color: #5865F2; border-color: rgba(88, 101, 242, 0.3);">
                            <svg style="width: 20px; height: 20px; fill: currentColor;" viewBox="0 0 24 24"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994.021-.041.001-.09-.041-.106a13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.929 1.793 8.18 1.793 12.061 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.893.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.028zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.956-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.955-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.946 2.418-2.157 2.418z"/></svg>
                        </a>
                        <!-- Instagram SVG -->
                        <a href="https://instagram.com/{{ \App\Models\SiteSetting::get('instagram_username', 'alzis_sturr') }}" target="_blank" class="social-icon-btn" title="Instagram Official" style="background: rgba(244, 63, 94, 0.12); color: #f43f5e; border-color: rgba(244, 63, 94, 0.3);">
                            <svg style="width: 18px; height: 18px; fill: currentColor;" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <!-- TikTok SVG -->
                        <a href="https://www.tiktok.com/@{{ \App\Models\SiteSetting::get('tiktok_username', 'emu_velz') }}" target="_blank" class="social-icon-btn" title="TikTok Official" style="background: rgba(255, 255, 255, 0.08); color: #fff; border-color: rgba(255, 255, 255, 0.2);">
                            <svg style="width: 18px; height: 18px; fill: currentColor;" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V8.98a6.36 6.36 0 0 0-.79-.05A6.34 6.34 0 0 0 3 15.28 6.34 6.34 0 0 0 9.34 21.6a6.34 6.34 0 0 0 6.34-6.32V8.71a8.3 8.3 0 0 0 4.91 1.58V6.84c-.35 0-.69-.05-1-.15z"/></svg>
                        </a>
                        <!-- WhatsApp SVG -->
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\SiteSetting::get('whatsapp_number', '6282324634848')) }}" target="_blank" class="social-icon-btn" title="WhatsApp Admin" style="background: rgba(37, 211, 102, 0.12); color: #25D366; border-color: rgba(37, 211, 102, 0.3);">
                            <svg style="width: 18px; height: 18px; fill: currentColor;" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="footer-heading">Menu Utama</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('catalog') }}">Katalog Stok</a></li>
                        <li><a href="{{ route('how.to.buy') }}">Cara Transaksi</a></li>
                        <li><a href="{{ route('contact') }}">Kontak & Bantuan</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="footer-heading">Kategori Populer</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('catalog', ['category' => 'mobile-legends']) }}">Mobile Legends</a></li>
                        <li><a href="{{ route('catalog', ['category' => 'free-fire']) }}">Free Fire</a></li>
                        <li><a href="{{ route('catalog', ['category' => 'genshin-impact']) }}">Genshin Impact</a></li>
                        <li><a href="{{ route('catalog', ['category' => 'pubg-mobile']) }}">PUBG Mobile</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="footer-heading">Jaminan Keamanan</h4>
                    <p style="color: var(--text-muted); font-size: 0.85rem; line-height: 1.5; margin-bottom: 12px;">
                        Seluruh transaksi diproses langsung oleh Admin resmi dengan verifikasi data akun menyeluruh.
                    </p>
                    <div style="font-size: 0.8rem; color: var(--primary); font-weight: 700; display: flex; align-items: center; gap: 6px;">
                        <i data-lucide="shield-check" style="width: 16px; height: 16px;"></i>
                        <span>Garansi Anti Hackback</span>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} <strong>ALZIS STORE</strong>. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Navigation Bar -->
    <nav class="mobile-bottom-nav">
        <a href="{{ route('home') }}" class="mobile-nav-tab {{ request()->routeIs('home') ? 'active' : '' }}">
            <i data-lucide="home" style="width: 18px; height: 18px;"></i>
            <span>Beranda</span>
        </a>
        <a href="{{ route('catalog') }}" class="mobile-nav-tab {{ request()->routeIs('catalog') ? 'active' : '' }}">
            <i data-lucide="gamepad-2" style="width: 18px; height: 18px;"></i>
            <span>Katalog</span>
        </a>
        <a href="{{ route('wishlist.index') }}" class="mobile-nav-tab {{ request()->routeIs('wishlist.*') ? 'active' : '' }}">
            <div style="position: relative; display: inline-flex;">
                <i data-lucide="heart" style="width: 18px; height: 18px; {{ Auth::check() && Auth::user()->wishlists()->count() > 0 ? 'fill: var(--danger); color: var(--danger);' : '' }}"></i>
                @auth
                    @if(Auth::user()->wishlists()->count() > 0)
                        <span class="wishlist-badge">{{ Auth::user()->wishlists()->count() }}</span>
                    @endif
                @endauth
            </div>
            <span>Favorit</span>
        </a>
        <a href="{{ route('contact') }}" class="mobile-nav-tab {{ request()->routeIs('contact') ? 'active' : '' }}">
            <i data-lucide="message-square" style="width: 18px; height: 18px;"></i>
            <span>Bantuan</span>
        </a>
        @auth
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="mobile-nav-tab {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                    <i data-lucide="shield" style="width: 18px; height: 18px; color: var(--gold);"></i>
                    <span style="color: var(--gold);">Owner</span>
                </a>
            @else
                <a href="{{ route('profile') }}" class="mobile-nav-tab {{ request()->routeIs('profile') ? 'active' : '' }}">
                    <i data-lucide="user" style="width: 18px; height: 18px;"></i>
                    <span>Akun</span>
                </a>
            @endif
        @else
            <a href="{{ route('login') }}" class="mobile-nav-tab {{ request()->routeIs('login') ? 'active' : '' }}">
                <i data-lucide="log-in" style="width: 18px; height: 18px;"></i>
                <span>Masuk</span>
            </a>
        @endauth
    </nav>

    <div id="toast-container" class="toast-container"></div>

    <script>
        lucide.createIcons();

        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = `toast-alert toast-${type}`;
            const iconSvg = type === 'success' 
                ? `<svg style="width: 16px; height: 16px; color: var(--primary); flex-shrink: 0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>`
                : `<svg style="width: 16px; height: 16px; color: var(--danger); flex-shrink: 0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>`;
            
            toast.innerHTML = `${iconSvg}<span>${message}</span>`;
            container.appendChild(toast);

            setTimeout(() => toast.classList.add('show'), 50);

            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }, 3500);
        }

        // AJAX Wishlist toggle handler
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.btn-toggle-wishlist').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const accountId = this.getAttribute('data-id');
                    const isRemoveCard = this.getAttribute('data-remove-card') === 'true';
                    const tokenMeta = document.querySelector('meta[name="csrf-token"]');
                    const token = tokenMeta ? tokenMeta.getAttribute('content') : '';

                    fetch(`/wishlist/${accountId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        if (response.status === 401) {
                            showToast('Silakan login untuk menyimpan akun ke Wishlist.', 'error');
                            setTimeout(() => { window.location.href = "{{ route('login') }}"; }, 1200);
                            return null;
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (!data) return;

                        if (data.status === 'success') {
                            showToast(data.message, 'success');

                            const badge = document.getElementById('nav-wishlist-badge');
                            if (badge) {
                                badge.textContent = data.total_wishlists;
                                badge.style.display = data.total_wishlists > 0 ? 'flex' : 'none';
                            }

                            const icon = this.querySelector('i') || this.querySelector('svg');
                            if (data.is_wishlisted) {
                                this.style.color = 'var(--danger)';
                                if (icon) {
                                    icon.style.color = 'var(--danger)';
                                    icon.setAttribute('fill', 'var(--danger)');
                                }
                            } else {
                                this.style.color = 'inherit';
                                if (icon) {
                                    icon.style.color = 'inherit';
                                    icon.setAttribute('fill', 'none');
                                }

                                if (isRemoveCard) {
                                    const card = document.getElementById(`wishlist-card-${accountId}`);
                                    if (card) {
                                        card.style.opacity = '0';
                                        card.style.transform = 'scale(0.95)';
                                        setTimeout(() => {
                                            card.remove();
                                            const remaining = document.querySelectorAll('#wishlist-grid .account-card');
                                            if (remaining.length === 0) window.location.reload();
                                        }, 250);
                                    }
                                }
                            }
                        }
                    })
                    .catch(err => {
                        console.error('Wishlist error:', err);
                    });
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
