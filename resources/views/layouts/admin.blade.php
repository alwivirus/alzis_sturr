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
        <aside class="admin-sidebar" style="display: flex; flex-direction: column; height: 100vh; position: sticky; top: 0; overflow-y: auto;">
            <!-- Brand & Role Card -->
            <div style="padding: 0 8px 20px; border-bottom: 1px solid var(--border-color); margin-bottom: 16px;">
                <a href="{{ route('home') }}" class="brand-logo" style="font-size: 1.35rem; text-decoration: none;">
                    <span class="text-gradient-cyan">ALZIS</span>
                    <span class="logo-badge" style="font-size: 0.7rem; background: {{ Auth::user()->isOwner() ? 'linear-gradient(135deg, #f59e0b, #d97706)' : 'var(--primary-gradient)' }}; color: #090d16; font-weight: 800;">
                        {{ Auth::user()->isOwner() ? 'OWNER' : 'ADMIN' }}
                    </span>
                </a>
                
                <div style="background: rgba(15, 23, 42, 0.8); border: 1px solid var(--border-color); border-radius: var(--radius-sm); padding: 10px 12px; margin-top: 14px; display: flex; align-items: center; gap: 10px;">
                    <div style="width: 34px; height: 34px; border-radius: 50%; background: {{ Auth::user()->isOwner() ? 'linear-gradient(135deg, #f59e0b, #b45309)' : 'rgba(0, 242, 254, 0.15)' }}; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 800; font-size: 0.85rem; flex-shrink: 0; border: 1px solid {{ Auth::user()->isOwner() ? '#fbbf24' : 'var(--border-glow)' }};">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div style="overflow: hidden; flex: 1;">
                        <div style="font-size: 0.85rem; font-weight: 700; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ Auth::user()->name }}
                        </div>
                        <div style="margin-top: 2px;">
                            {!! Auth::user()->role_badge !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Sections -->
            <nav style="flex: 1; display: flex; flex-direction: column; gap: 4px;">
                <!-- Section 1: Toko & Stok -->
                <div style="font-size: 0.68rem; font-weight: 800; text-transform: uppercase; color: var(--text-sub); letter-spacing: 1px; padding: 8px 12px 4px;">
                    MANAJEMEN TOKO
                </div>

                <a href="{{ route('admin.dashboard') }}" class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i data-lucide="layout-dashboard" style="width: 17px; height: 17px;"></i>
                    <span>Dashboard Utama</span>
                </a>

                <a href="{{ route('admin.accounts.index') }}" class="admin-nav-item {{ request()->routeIs('admin.accounts.*') ? 'active' : '' }}">
                    <i data-lucide="gamepad-2" style="width: 17px; height: 17px;"></i>
                    <span>Kelola Stok Akun Game</span>
                </a>

                <a href="{{ route('admin.categories.index') }}" class="admin-nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i data-lucide="folder-kanban" style="width: 17px; height: 17px;"></i>
                    <span>Kategori Game</span>
                </a>

                <a href="{{ route('admin.settings.index') }}" class="admin-nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <i data-lucide="settings-2" style="width: 17px; height: 17px;"></i>
                    <span>Pengaturan Toko & Kontak</span>
                </a>

                <!-- Section 2: Owner Special Control -->
                <div style="font-size: 0.68rem; font-weight: 800; text-transform: uppercase; color: #f59e0b; letter-spacing: 1px; padding: 14px 12px 4px; display: flex; align-items: center; gap: 6px;">
                    <i data-lucide="crown" style="width: 12px; height: 12px;"></i>
                    <span>KONTROL OWNER</span>
                </div>

                <a href="{{ route('admin.users.index') }}" class="admin-nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i data-lucide="users" style="width: 17px; height: 17px; color: #38bdf8;"></i>
                    <span>Kelola Pengguna & Role</span>
                </a>

                <a href="{{ route('admin.logs.index') }}" class="admin-nav-item {{ request()->routeIs('admin.logs.*') ? 'active' : '' }}">
                    <i data-lucide="shield-alert" style="width: 17px; height: 17px; color: #f59e0b;"></i>
                    <span>Log Audit Aktivitas</span>
                </a>

                <a href="{{ route('profile') }}" class="admin-nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                    <i data-lucide="user-cog" style="width: 17px; height: 17px;"></i>
                    <span>Profil & Password Saya</span>
                </a>
            </nav>

            <!-- Bottom Actions -->
            <div style="padding-top: 14px; border-top: 1px solid var(--border-color); margin-top: auto;">
                <a href="{{ route('home') }}" target="_blank" class="admin-nav-item" style="color: #93c5fd;">
                    <i data-lucide="external-link" style="width: 17px; height: 17px;"></i>
                    <span>Buka Toko Publik</span>
                </a>

                <form action="{{ route('logout') }}" method="POST" style="margin-top: 4px;">
                    @csrf
                    <button type="submit" class="admin-nav-item" style="width: 100%; border: none; background: transparent; cursor: pointer; color: var(--danger);">
                        <i data-lucide="log-out" style="width: 17px; height: 17px;"></i>
                        <span>Keluar Panel Admin</span>
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
