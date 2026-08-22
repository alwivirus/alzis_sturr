<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ALzis STURR') - Jual Beli Akun Game Terpercaya</title>
    <meta name="description" content="@yield('meta_description', 'ALzis STURR - Jual beli dan japost akun Mobile Legends, Free Fire, Genshin Impact, PUBG Mobile, Valorant terpercaya 100% anti hackback.')">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/alzis.css') }}">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @stack('styles')
</head>
<body>

    <!-- Top Announcement Bar -->
    <div class="top-announcement">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 8px; overflow: hidden; white-space: nowrap;">
                <span style="color: var(--primary); font-weight: 700; font-size: 0.75rem; text-transform: uppercase;">PENGUMUMAN:</span>
                <span style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ \App\Models\SiteSetting::get('banner_announcement', 'Transaksi Cepat & 100% Anti Hackback via Discord & WhatsApp Resmi.') }}</span>
            </div>
            <div style="display: flex; align-items: center; gap: 8px; flex-shrink: 0;">
                <a href="{{ \App\Models\SiteSetting::get('discord_invite_url', 'https://discord.gg/alzis-sturr') }}" target="_blank" class="top-contact-pill">
                    <i data-lucide="message-square" style="width: 13px; height: 13px;"></i>
                    <span>Discord</span>
                </a>
                <a href="https://instagram.com/{{ \App\Models\SiteSetting::get('instagram_username', 'alzis_sturr') }}" target="_blank" class="top-contact-pill">
                    <i data-lucide="instagram" style="width: 13px; height: 13px;"></i>
                    <span>&#64;{{ \App\Models\SiteSetting::get('instagram_username', 'alzis_sturr') }}</span>
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
                    <span class="brand-dot"></span>
                    <span>ALzis STURR</span>
                    <span class="brand-badge">Store</span>
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
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari game, hero, skin...">
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
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm" style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.4); color: var(--primary); font-weight: 700;">
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
                    <div class="brand-logo" style="margin-bottom: 12px;">
                        <span class="brand-dot"></span>
                        <span>ALzis STURR</span>
                        <span class="brand-badge">Store</span>
                    </div>
                    <p style="color: var(--text-muted); font-size: 0.88rem; line-height: 1.6; margin-bottom: 18px;">
                        Marketplace jual beli dan japost akun game online terpercaya di Indonesia: Mobile Legends, Free Fire, Genshin Impact, PUBG Mobile, Valorant dengan garansi 100% Anti Hackback.
                    </p>
                    <div class="social-icon-links">
                        <a href="{{ \App\Models\SiteSetting::get('discord_invite_url', 'https://discord.gg/alzis-sturr') }}" target="_blank" class="social-icon-btn" title="Discord">
                            <i data-lucide="message-square" style="width: 18px; height: 18px;"></i>
                        </a>
                        <a href="https://instagram.com/{{ \App\Models\SiteSetting::get('instagram_username', 'alzis_sturr') }}" target="_blank" class="social-icon-btn" title="Instagram">
                            <i data-lucide="instagram" style="width: 18px; height: 18px;"></i>
                        </a>
                        <a href="https://www.tiktok.com/@{{ \App\Models\SiteSetting::get('tiktok_username', 'emu_velz') }}" target="_blank" class="social-icon-btn" title="TikTok">
                            <i data-lucide="video" style="width: 18px; height: 18px;"></i>
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
                <p>&copy; {{ date('Y') }} <strong>ALzis STURR</strong>. All rights reserved.</p>
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
