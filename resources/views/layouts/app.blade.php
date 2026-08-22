<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ALzis STURR') - Jual Beli & Japost Akun Game Terpercaya</title>
    <meta name="description" content="@yield('meta_description', 'ALzis STURR - Pusat jual beli dan stok japost akun Mobile Legends, Free Fire, Genshin Impact, PUBG Mobile, Valorant terpercaya 100% anti hackback.')">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/alzis.css') }}">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @stack('styles')
</head>
<body>

    <!-- Top Announcement Bar -->
    <div class="top-announcement">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center; width: 100%; gap: 20px;">
            <div class="announcement-ticker" style="flex: 1; min-width: 0;">
                <span style="color: var(--accent-gold); font-weight: 700;">⚡ INFO RESMI:</span>
                <span style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ \App\Models\SiteSetting::get('banner_announcement', '🔥 PROMO SPESIAL ALzis STURR! Transaksi Cepat & 100% Anti Hackback.') }}</span>
            </div>
            <div class="top-contacts" style="display: flex; align-items: center; gap: 8px; flex-shrink: 0;">
                <a href="{{ \App\Models\SiteSetting::get('discord_invite_url', 'https://discord.gg/alzis-sturr') }}" target="_blank" class="top-contact-pill" title="Join Discord Server Resmi">
                    <svg style="width: 14px; height: 14px; fill: #5865F2;" viewBox="0 0 24 24"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994.021-.041.001-.09-.041-.106a13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.929 1.793 8.18 1.793 12.061 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.893.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.028zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.956-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.955-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.946 2.418-2.157 2.418z"/></svg>
                    <span>Discord</span>
                </a>
                <a href="https://instagram.com/{{ \App\Models\SiteSetting::get('instagram_username', 'alzis_sturr') }}" target="_blank" class="top-contact-pill" title="Kunjungi Instagram Resmi">
                    <svg style="width: 13px; height: 13px; fill: #f43f5e; vertical-align: -2px;" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    <span>&#64;{{ \App\Models\SiteSetting::get('instagram_username', 'alzis_sturr') }}</span>
                </a>
                <a href="https://www.tiktok.com/@{{ \App\Models\SiteSetting::get('tiktok_username', 'emu_velz') }}" target="_blank" class="top-contact-pill" title="Tonton TikTok Resmi">
                    <svg style="width: 13px; height: 13px; fill: #00f2fe;" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1.04-.1z"/></svg>
                    <span>&#64;{{ \App\Models\SiteSetting::get('tiktok_username', 'emu_velz') }}</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <header class="navbar">
        <div class="container">
            <div class="nav-wrapper">
                <!-- Brand Logo -->
                <a href="{{ route('home') }}" class="brand-logo">
                    <span class="text-gradient-cyan">ALZIS</span>
                    <span class="logo-badge">STURR</span>
                </a>

                <!-- Desktop Nav Menu -->
                <nav>
                    <ul class="nav-menu">
                        <li>
                            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                                <i data-lucide="home" style="width: 18px; height: 18px;"></i>
                                <span>Beranda</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('catalog') }}" class="nav-link {{ request()->routeIs('catalog') ? 'active' : '' }}">
                                <i data-lucide="gamepad-2" style="width: 18px; height: 18px;"></i>
                                <span>Katalog Stok</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('how.to.buy') }}" class="nav-link {{ request()->routeIs('how.to.buy') ? 'active' : '' }}">
                                <i data-lucide="shield-check" style="width: 18px; height: 18px;"></i>
                                <span>Cara Beli & Garansi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                                <i data-lucide="message-square" style="width: 18px; height: 18px;"></i>
                                <span>Hubungi Kami</span>
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- Header Taskbar Quick Search -->
                <form action="{{ route('catalog') }}" method="GET" class="nav-search-bar">
                    <i data-lucide="search" style="width: 14px; height: 14px; color: var(--primary); flex-shrink: 0;"></i>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari akun game..." style="background: transparent !important; background-color: transparent !important; border: none !important; outline: none !important; box-shadow: none !important; color: #fff !important; font-size: 0.85rem; width: 100%; margin-left: 8px; padding: 2px 0;">
                </form>

                <!-- Nav Actions -->
                <div class="nav-actions">
                    @auth
                        <!-- Wishlist Button with Live Badge -->
                        <a href="{{ route('wishlist.index') }}" class="btn btn-secondary btn-icon" title="Wishlist Akun Favorit" style="position: relative;">
                            <i data-lucide="heart" style="width: 18px; height: 18px; color: #f43f5e; {{ Auth::user()->wishlists()->count() > 0 ? 'fill: #f43f5e;' : '' }}"></i>
                            <span id="nav-wishlist-badge" class="wishlist-badge" style="{{ Auth::user()->wishlists()->count() > 0 ? 'display: flex;' : 'display: none;' }}">
                                {{ Auth::user()->wishlists()->count() }}
                            </span>
                        </a>

                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm" title="Buka Panel Kelola Toko">
                                <i data-lucide="layout-dashboard" style="width: 16px; height: 16px;"></i>
                                <span>Admin Panel</span>
                            </a>
                        @endif

                        <a href="{{ route('profile') }}" class="btn btn-secondary btn-sm" title="Kelola Profil, Email & Kata Sandi">
                            <i data-lucide="user" style="width: 16px; height: 16px;"></i>
                            <span>Profil</span>
                        </a>

                        <!-- Logout -->
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-icon" title="Keluar" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                                <i data-lucide="log-out" style="width: 18px; height: 18px;"></i>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('wishlist.index') }}" class="btn btn-secondary btn-icon" title="Wishlist Akun" style="position: relative;">
                            <i data-lucide="heart" style="width: 18px; height: 18px; color: #f43f5e;"></i>
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-secondary btn-sm">
                            <i data-lucide="log-in" style="width: 16px; height: 16px;"></i>
                            <span>Masuk</span>
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                            <span>Daftar Akun</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Flash Messages -->
    <div class="container" style="margin-top: 20px;">
        @if(session('success'))
            <div class="alert alert-success">
                <i data-lucide="check-circle-2" style="width: 20px; height: 20px;"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i data-lucide="alert-circle" style="width: 20px; height: 20px;"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning">
                <i data-lucide="alert-triangle" style="width: 20px; height: 20px;"></i>
                <span>{{ session('warning') }}</span>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Floating Discord Community CTA -->
    <a href="{{ \App\Models\SiteSetting::get('discord_invite_url', 'https://discord.gg/alzis-sturr') }}" 
       target="_blank" 
       class="floating-discord-btn" 
       title="Join Discord Server Resmi ALzis STURR">
        <svg style="width: 28px; height: 28px; fill: #ffffff;" viewBox="0 0 24 24"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994.021-.041.001-.09-.041-.106a13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.929 1.793 8.18 1.793 12.061 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.893.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.028zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.956-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.955-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.946 2.418-2.157 2.418z"/></svg>
    </a>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="brand-logo" style="margin-bottom: 14px;">
                        <span class="text-gradient-cyan">ALZIS</span>
                        <span class="logo-badge">STURR</span>
                    </div>
                    <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 16px; line-height: 1.6;">
                        Platform jual beli & stok japost akun game online terpercaya di Indonesia. Melayani akun Mobile Legends, Free Fire, Genshin Impact, PUBGM, Valorant, dan Honor of Kings dengan garansi 100% aman dan anti hackback.
                    </p>
                    
                    <div style="font-size: 0.8rem; color: #94a3b8; font-weight: 600; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">
                        Komunitas & Media Sosial Resmi:
                    </div>
                    <div class="social-icon-links" style="margin-top: 0;">
                        <a href="{{ \App\Models\SiteSetting::get('discord_invite_url', 'https://discord.gg/alzis-sturr') }}" target="_blank" class="social-icon-btn discord-icon" title="Discord Server Resmi ALzis STURR">
                            <svg style="width: 20px; height: 20px; fill: currentColor;" viewBox="0 0 24 24"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994.021-.041.001-.09-.041-.106a13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.929 1.793 8.18 1.793 12.061 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.893.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.028zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.956-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.955-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.946 2.418-2.157 2.418z"/></svg>
                        </a>
                        <a href="https://instagram.com/{{ \App\Models\SiteSetting::get('instagram_username', 'alzis_sturr') }}" target="_blank" class="social-icon-btn instagram-icon" title="Instagram &#64;{{ \App\Models\SiteSetting::get('instagram_username', 'alzis_sturr') }}">
                            <svg style="width: 18px; height: 18px; fill: currentColor;" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="https://www.tiktok.com/@{{ \App\Models\SiteSetting::get('tiktok_username', 'emu_velz') }}" target="_blank" class="social-icon-btn tiktok-icon" title="TikTok &#64;{{ \App\Models\SiteSetting::get('tiktok_username', 'emu_velz') }}">
                            <svg style="width: 18px; height: 18px; fill: currentColor;" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1.04-.1z"/></svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="footer-heading">Navigasi</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Beranda Utama</a></li>
                        <li><a href="{{ route('catalog') }}">Katalog Semua Stok</a></li>
                        <li><a href="{{ route('how.to.buy') }}">Panduan Transaksi</a></li>
                        <li><a href="{{ route('contact') }}">Kontak Admin Resmi</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="footer-heading">Kategori Populer</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('catalog', ['category' => 'mobile-legends']) }}">Akun Mobile Legends</a></li>
                        <li><a href="{{ route('catalog', ['category' => 'free-fire']) }}">Akun Free Fire Old</a></li>
                        <li><a href="{{ route('catalog', ['category' => 'genshin-impact']) }}">Akun Genshin Impact</a></li>
                        <li><a href="{{ route('catalog', ['category' => 'pubg-mobile']) }}">Akun PUBG Mobile</a></li>
                        <li><a href="{{ route('catalog', ['category' => 'valorant']) }}">Akun Valorant</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="footer-heading">Keamanan & Garansi</h4>
                    <p style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 14px;">
                        Setiap akun yang diperjualbelikan di ALzis STURR telah melalui tahap verifikasi keamanan bind (First Hand / All Unbind) dan dilindungi jaminan garansi seumur hidup dari admin.
                    </p>
                    <div style="background: rgba(255,255,255,0.04); padding: 10px 14px; border-radius: var(--radius-sm); border: 1px solid var(--border-color); font-size: 0.8rem; color: #38bdf8;">
                        🔒 100% Garansi Anti Hackback & Safe Takeover
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} <strong>ALzis STURR</strong>. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Toast Container -->
    <div id="toast-container" class="toast-container"></div>

    <!-- Initialize Lucide Icons -->
    <script>
        lucide.createIcons();

        // Cyber Toast Notification helper
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = `toast-alert toast-${type}`;
            const iconSvg = type === 'success' 
                ? `<svg style="width: 18px; height: 18px; color: #00f2fe; flex-shrink: 0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>`
                : `<svg style="width: 18px; height: 18px; color: #f43f5e; flex-shrink: 0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>`;
            
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

                    this.style.transform = 'scale(0.85)';
                    setTimeout(() => { this.style.transform = 'scale(1)'; }, 150);

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
                            showToast('Silakan login terlebih dahulu untuk menyimpan akun ke Wishlist.', 'error');
                            setTimeout(() => {
                                window.location.href = "{{ route('login') }}";
                            }, 1200);
                            return null;
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (!data) return;

                        if (data.status === 'success') {
                            showToast(data.message, 'success');

                            // Update Navbar Wishlist Badge
                            const badge = document.getElementById('nav-wishlist-badge');
                            if (badge) {
                                badge.textContent = data.total_wishlists;
                                badge.style.display = data.total_wishlists > 0 ? 'flex' : 'none';
                            }

                            // Update this button's look
                            const icon = this.querySelector('i') || this.querySelector('svg');
                            if (data.is_wishlisted) {
                                this.style.color = '#f43f5e';
                                this.style.borderColor = '#f43f5e';
                                if (icon) {
                                    icon.style.color = '#f43f5e';
                                    icon.setAttribute('fill', '#f43f5e');
                                }
                            } else {
                                this.style.color = 'inherit';
                                this.style.borderColor = 'var(--border-color)';
                                if (icon) {
                                    icon.style.color = 'inherit';
                                    icon.setAttribute('fill', 'none');
                                }

                                // If on Wishlist Page, remove card smoothly
                                if (isRemoveCard) {
                                    const card = document.getElementById(`wishlist-card-${accountId}`);
                                    if (card) {
                                        card.style.opacity = '0';
                                        card.style.transform = 'scale(0.9) translateY(20px)';
                                        setTimeout(() => {
                                            card.remove();
                                            const remaining = document.querySelectorAll('#wishlist-grid .account-card');
                                            const totalHeader = document.getElementById('wishlist-total-header');
                                            if (totalHeader) {
                                                totalHeader.textContent = `${remaining.length} Akun`;
                                            }
                                            if (remaining.length === 0) {
                                                window.location.reload();
                                            }
                                        }, 300);
                                    }
                                }
                            }
                        } else {
                            showToast(data.message || 'Terjadi kesalahan sistem.', 'error');
                        }
                    })
                    .catch(err => {
                        console.error('Wishlist error:', err);
                        showToast('Gagal memproses wishlist, periksa koneksi internet Anda.', 'error');
                    });
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
