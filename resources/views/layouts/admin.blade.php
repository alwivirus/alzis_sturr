<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - ALzis STURR Hub</title>

    <!-- Preconnect & Google Fonts Optimized -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800&display=swap">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/alzis.css') }}?v=1.1">

    @stack('styles')
</head>
<body style="background: var(--bg-body); color: var(--text-main);">

    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <!-- Brand & Official Logo -->
            <div style="padding-bottom: 16px; border-bottom: 1px solid var(--border); margin-bottom: 14px;">
                <a href="{{ route('home') }}" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
                    <img src="{{ asset('images/logo.png') }}" alt="ALzis Store Logo" style="height: 44px; width: auto; object-fit: contain; filter: drop-shadow(0 0 8px rgba(0, 242, 254, 0.4));">
                    <div>
                        <div style="font-size: 1.15rem; font-weight: 800; font-family: var(--font-heading); color: #fff; line-height: 1.1;">
                            ALZIS <span style="color: var(--primary);">STORE</span>
                        </div>
                        <span class="brand-badge" style="background: {{ Auth::user()->isOwner() ? 'var(--gold)' : 'var(--primary)' }}; font-size: 0.65rem; padding: 1px 6px; margin-top: 3px; display: inline-block;">
                            {{ Auth::user()->isOwner() ? '👑 OWNER UTAMA' : 'ADMIN' }}
                        </span>
                    </div>
                </a>
                
                <div style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 10px 12px; margin-top: 14px; display: flex; align-items: center; gap: 10px;">
                    <div style="width: 32px; height: 32px; border-radius: 50%; background: {{ Auth::user()->isOwner() ? 'rgba(245, 158, 11, 0.2)' : 'var(--primary-light)' }}; display: flex; align-items: center; justify-content: center; color: {{ Auth::user()->isOwner() ? 'var(--gold)' : 'var(--primary)' }}; font-weight: 800; font-size: 0.85rem; flex-shrink: 0; border: 1px solid {{ Auth::user()->isOwner() ? 'var(--gold-border)' : 'var(--primary-border)' }};">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div style="overflow: hidden; flex: 1;">
                        <div style="font-size: 0.82rem; font-weight: 700; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ Auth::user()->name }}
                        </div>
                        <div style="font-size: 0.7rem; color: {{ Auth::user()->isOwner() ? 'var(--gold)' : 'var(--primary)' }}; font-weight: 700;">
                            {{ Auth::user()->isOwner() ? 'Owner Toko' : 'Admin Toko' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav style="flex: 1; display: flex; flex-direction: column; gap: 2px;">
                <div style="font-size: 0.68rem; font-weight: 700; text-transform: uppercase; color: var(--text-dim); letter-spacing: 0.5px; padding: 6px 12px 2px;">
                    MANAJEMEN TOKO
                </div>

                <a href="{{ route('admin.dashboard') }}" class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i data-lucide="layout-dashboard" style="width: 16px; height: 16px;"></i>
                    <span>Dashboard Utama</span>
                </a>

                <a href="{{ route('admin.accounts.index') }}" class="admin-nav-item {{ request()->routeIs('admin.accounts.*') ? 'active' : '' }}">
                    <i data-lucide="gamepad-2" style="width: 16px; height: 16px;"></i>
                    <span>Kelola Stok Akun</span>
                </a>

                <a href="{{ route('admin.categories.index') }}" class="admin-nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i data-lucide="folder" style="width: 16px; height: 16px;"></i>
                    <span>Kategori Game</span>
                </a>

                <a href="{{ route('admin.settings.index') }}" class="admin-nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <i data-lucide="settings" style="width: 16px; height: 16px;"></i>
                    <span>Pengaturan Toko & WA</span>
                </a>

                <!-- Section 2: Owner Control -->
                <div style="font-size: 0.68rem; font-weight: 700; text-transform: uppercase; color: var(--gold); letter-spacing: 0.5px; padding: 12px 12px 2px; display: flex; align-items: center; gap: 4px;">
                    <i data-lucide="crown" style="width: 12px; height: 12px;"></i>
                    <span>KONTROL OWNER</span>
                </div>

                <a href="{{ route('admin.users.index') }}" class="admin-nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i data-lucide="users" style="width: 16px; height: 16px;"></i>
                    <span>Kelola Pengguna & Role</span>
                </a>

                <a href="{{ route('admin.logs.index') }}" class="admin-nav-item {{ request()->routeIs('admin.logs.*') ? 'active' : '' }}">
                    <i data-lucide="file-text" style="width: 16px; height: 16px;"></i>
                    <span>Log Audit Aktivitas</span>
                </a>

                <a href="{{ route('profile') }}" class="admin-nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                    <i data-lucide="user" style="width: 16px; height: 16px;"></i>
                    <span>Profil & Password</span>
                </a>
            </nav>

            <!-- Bottom Actions -->
            <div style="padding-top: 12px; border-top: 1px solid var(--border); margin-top: auto;">
                <a href="{{ route('home') }}" target="_blank" class="admin-nav-item" style="color: #7dd3fc;">
                    <i data-lucide="external-link" style="width: 16px; height: 16px;"></i>
                    <span>Buka Toko Publik</span>
                </a>

                <form action="{{ route('logout') }}" method="POST" style="margin-top: 2px;">
                    @csrf
                    <button type="submit" class="admin-nav-item" style="width: 100%; border: none; background: transparent; cursor: pointer; color: var(--danger);">
                        <i data-lucide="log-out" style="width: 16px; height: 16px;"></i>
                        <span>Keluar Panel Admin</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Workspace -->
        <main class="admin-content">
            <!-- Header Breadcrumb & Actions -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid var(--border); flex-wrap: wrap; gap: 14px;">
                <div>
                    <span style="font-size: 0.78rem; color: var(--text-dim); text-transform: uppercase; font-weight: 700;">ALzis STURR Command Portal</span>
                    <h2 class="font-heading" style="font-size: 1.6rem; color: #fff; margin-top: 2px; font-weight: 800;">@yield('page_title', 'Admin Dashboard')</h2>
                </div>
                <div>
                    @yield('header_actions')
                </div>
            </div>

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i data-lucide="check-circle-2" style="width: 18px; height: 18px; flex-shrink: 0;"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i data-lucide="alert-circle" style="width: 18px; height: 18px; flex-shrink: 0;"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <i data-lucide="alert-circle" style="width: 18px; height: 18px; flex-shrink: 0;"></i>
                    <ul style="margin-left: 16px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Initialize Lucide Icons -->
    <script src="{{ asset('js/lucide.min.js') }}" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
