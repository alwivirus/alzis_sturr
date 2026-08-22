<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - ALzis STURR Admin Hub</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/alzis.css') }}">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @stack('styles')
</head>
<body style="background: #090d16;">

    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div style="padding: 0 12px 24px; border-bottom: 1px solid var(--border-color); margin-bottom: 20px;">
                <a href="{{ route('home') }}" class="brand-logo" style="font-size: 1.4rem;">
                    <span class="text-gradient-cyan">ALZIS</span>
                    <span class="logo-badge" style="font-size: 0.75rem;">ADMIN</span>
                </a>
                <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px;">
                    Logged in as: <strong style="color: #fff;">{{ Auth::user()->name }}</strong>
                </div>
            </div>

            <nav style="flex: 1;">
                <a href="{{ route('admin.dashboard') }}" class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i data-lucide="layout-dashboard" style="width: 18px; height: 18px;"></i>
                    <span>Dashboard Utama</span>
                </a>

                <a href="{{ route('admin.accounts.index') }}" class="admin-nav-item {{ request()->routeIs('admin.accounts.*') ? 'active' : '' }}">
                    <i data-lucide="gamepad" style="width: 18px; height: 18px;"></i>
                    <span>Kelola Stok Akun Game</span>
                </a>

                <a href="{{ route('admin.categories.index') }}" class="admin-nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i data-lucide="folder-kanban" style="width: 18px; height: 18px;"></i>
                    <span>Kategori Game</span>
                </a>

                <a href="{{ route('admin.settings.index') }}" class="admin-nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <i data-lucide="settings" style="width: 18px; height: 18px;"></i>
                    <span>Pengaturan Toko & Kontak</span>
                </a>

                <a href="{{ route('profile') }}" class="admin-nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                    <i data-lucide="user-cog" style="width: 18px; height: 18px;"></i>
                    <span>Profil & Akun Admin</span>
                </a>
            </nav>

            <div style="padding-top: 20px; border-top: 1px solid var(--border-color);">
                <a href="{{ route('home') }}" target="_blank" class="admin-nav-item">
                    <i data-lucide="external-link" style="width: 18px; height: 18px;"></i>
                    <span>Lihat Toko Publik</span>
                </a>

                <form action="{{ route('logout') }}" method="POST" style="margin-top: 6px;">
                    @csrf
                    <button type="submit" class="admin-nav-item" style="width: 100%; border: none; background: transparent; cursor: pointer; color: var(--danger);">
                        <i data-lucide="log-out" style="width: 18px; height: 18px;"></i>
                        <span>Keluar Akun Admin</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="admin-content">
            <!-- Header for Mobile / Breadcrumb -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid var(--border-color);">
                <div>
                    <span style="font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; font-weight: 700;">ALzis STURR Management Portal</span>
                    <h2 class="font-gaming" style="font-size: 1.8rem; color: #fff; margin-top: 2px;">@yield('page_title', 'Admin Dashboard')</h2>
                </div>
                <div>
                    @yield('header_actions')
                </div>
            </div>

            <!-- Flash Messages -->
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

            @if($errors->any())
                <div class="alert alert-danger">
                    <i data-lucide="alert-circle" style="width: 20px; height: 20px;"></i>
                    <ul style="margin-left: 20px;">
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
    <script>
        lucide.createIcons();
    </script>
    @stack('scripts')
</body>
</html>
