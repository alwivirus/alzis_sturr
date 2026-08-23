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

    <!-- Stylesheets & Direct Self-Contained Admin Theme -->
    <link rel="stylesheet" href="{{ asset('css/alzis.css') }}?v=9.0">
    <style>
        :root {
            --bg-body: #060913;
            --bg-surface: #0b1120;
            --bg-surface-elevated: #10192e;
            --bg-card: #0e1628;
            --bg-input: #090f1d;
            --primary: #00f2fe;
            --primary-gradient: linear-gradient(135deg, #00f2fe 0%, #0284c7 100%);
            --gold: #fbbf24;
            --gold-gradient: linear-gradient(135deg, #fbbf24 0%, #d97706 100%);
            --danger: #f43f5e;
            --success: #10b981;
            --border: rgba(255, 255, 255, 0.08);
            --border-glow: rgba(0, 242, 254, 0.3);
            --font-main: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            --font-heading: 'Outfit', sans-serif;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --text-dim: #64748b;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font-main); background: var(--bg-body); color: var(--text-main); line-height: 1.5; }
        
        .admin-layout { display: flex; min-height: 100vh; background: var(--bg-body); }
        .admin-sidebar { width: 270px; background: #090e1c; border-right: 1px solid var(--border); padding: 20px 16px; display: flex; flex-direction: column; flex-shrink: 0; position: sticky; top: 0; height: 100vh; overflow-y: auto; z-index: 100; }
        .admin-content { flex: 1; min-width: 0; padding: 28px 32px; background: var(--bg-body); }
        
        .admin-nav-item { display: flex; align-items: center; gap: 10px; padding: 10px 14px; border-radius: 8px; color: var(--text-muted); font-size: 0.86rem; font-weight: 600; text-decoration: none; transition: all 0.2s ease; margin-bottom: 2px; }
        .admin-nav-item:hover { color: #fff; background: rgba(0, 242, 254, 0.08); }
        .admin-nav-item.active { color: var(--primary); background: rgba(0, 242, 254, 0.12); border-left: 3px solid var(--primary); font-weight: 700; }

        /* Stat Cards */
        .stat-card {
            background: linear-gradient(145deg, #0e1628 0%, #111a30 100%) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            border-radius: 14px !important;
            padding: 18px 20px !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.35) !important;
            transition: transform 0.2s ease, border-color 0.2s ease !important;
            position: relative;
            overflow: hidden;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            border-color: rgba(0, 242, 254, 0.3) !important;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5) !important;
        }
        .stat-title { font-size: 0.76rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-value { font-family: var(--font-heading); font-size: 1.65rem; font-weight: 900; margin-top: 4px; line-height: 1.1; }

        /* Data Tables */
        .data-table-card { background: #0e1628 !important; border: 1px solid rgba(255, 255, 255, 0.08) !important; border-radius: 14px !important; overflow: hidden; box-shadow: 0 4px 25px rgba(0, 0, 0, 0.4) !important; }
        .table-responsive { width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .custom-table { width: 100%; border-collapse: collapse; text-align: left; }
        .custom-table th { background: rgba(11, 17, 32, 0.95) !important; padding: 14px 18px; font-size: 0.74rem; font-weight: 800; text-transform: uppercase; color: var(--text-dim); letter-spacing: 0.6px; border-bottom: 1px solid rgba(255, 255, 255, 0.08); white-space: nowrap; }
        .custom-table td { padding: 14px 18px; font-size: 0.86rem; border-bottom: 1px solid rgba(255, 255, 255, 0.04); vertical-align: middle; }
        .custom-table tbody tr:hover { background: rgba(0, 242, 254, 0.025); }

        /* Form Controls */
        .input-control { background: #090f1d !important; border: 1px solid rgba(255, 255, 255, 0.12) !important; border-radius: 8px !important; padding: 8px 14px; color: #fff !important; font-size: 0.85rem; outline: none; transition: all 0.2s ease; width: 100%; }
        .input-control:focus { border-color: var(--primary) !important; box-shadow: 0 0 12px rgba(0, 242, 254, 0.25) !important; }
        .input-control option { background: #0b1120; color: #fff; }

        /* Buttons */
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 6px; font-weight: 700; font-size: 0.84rem; padding: 8px 16px; border-radius: 8px; border: 1px solid transparent; cursor: pointer; text-decoration: none; transition: all 0.2s ease; }
        .btn-primary { background: var(--primary-gradient) !important; color: #050811 !important; font-weight: 800; box-shadow: 0 4px 15px rgba(0, 242, 254, 0.3) !important; }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(0, 242, 254, 0.45) !important; }
        .btn-outline { background: rgba(255, 255, 255, 0.04) !important; border: 1px solid rgba(255, 255, 255, 0.15) !important; color: var(--text-main) !important; }
        .btn-outline:hover { background: rgba(255, 255, 255, 0.1) !important; border-color: #fff !important; color: #fff !important; transform: translateY(-1px); }
        .btn-danger-outline { background: rgba(244, 63, 94, 0.1) !important; border: 1px solid rgba(244, 63, 94, 0.4) !important; color: #fb7185 !important; padding: 8px 16px; border-radius: 8px; font-weight: 700; display: inline-flex; align-items: center; gap: 6px; cursor: pointer; text-decoration: none; }
        .btn-danger-outline:hover { background: rgba(244, 63, 94, 0.25) !important; border-color: #f43f5e !important; color: #fff !important; box-shadow: 0 4px 15px rgba(244, 63, 94, 0.35) !important; transform: translateY(-1px); }
        .btn-danger { background: linear-gradient(135deg, #f43f5e 0%, #be123c 100%) !important; color: #fff !important; border: 1px solid rgba(244, 63, 94, 0.4) !important; border-radius: 8px; padding: 7px 12px; font-weight: 700; font-size: 0.82rem; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 5px; }
        .btn-danger:hover { box-shadow: 0 4px 15px rgba(244, 63, 94, 0.45) !important; transform: translateY(-1px); }

        /* Badges */
        .badge { display: inline-flex; align-items: center; gap: 4px; padding: 3px 8px; border-radius: 6px; font-size: 0.72rem; font-weight: 800; letter-spacing: 0.3px; }
        .badge-success { background: rgba(16, 185, 129, 0.15) !important; color: #34d399 !important; border: 1px solid rgba(16, 185, 129, 0.35) !important; }
        .badge-danger { background: rgba(244, 63, 94, 0.15) !important; color: #fb7185 !important; border: 1px solid rgba(244, 63, 94, 0.35) !important; }
        .brand-badge { border-radius: 4px; color: #000; font-weight: 800; }

        /* Pagination & Unordered list clean reset */
        .pagination, ul.pagination, nav[role="navigation"] ul {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 6px !important;
            list-style: none !important;
            padding: 0 !important;
            margin: 0 !important;
            flex-wrap: wrap !important;
        }
        .page-item, ul.pagination li, nav[role="navigation"] li {
            display: inline-block !important;
            list-style: none !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        .page-link, ul.pagination li a, ul.pagination li span, nav[role="navigation"] a, nav[role="navigation"] span.page-link {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 4px !important;
            min-width: 36px !important;
            height: 36px !important;
            padding: 0 12px !important;
            border-radius: 8px !important;
            background: #090f1d !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            color: var(--text-muted) !important;
            font-size: 0.84rem !important;
            font-weight: 700 !important;
            text-decoration: none !important;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
            user-select: none !important;
        }
        .page-link:hover, ul.pagination li a:hover, nav[role="navigation"] a:hover {
            background: rgba(0, 242, 254, 0.15) !important;
            border-color: var(--primary) !important;
            color: #fff !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 2px 10px rgba(0, 242, 254, 0.25) !important;
        }
        .page-item.active .page-link, ul.pagination li.active span, nav[role="navigation"] span[aria-current="page"] {
            background: var(--primary-gradient) !important;
            border-color: var(--primary) !important;
            color: #050811 !important;
            font-weight: 900 !important;
            box-shadow: 0 0 15px rgba(0, 242, 254, 0.4) !important;
        }
        .page-item.disabled .page-link, ul.pagination li.disabled span {
            opacity: 0.35 !important;
            cursor: not-allowed !important;
            pointer-events: none !important;
            background: rgba(255, 255, 255, 0.02) !important;
            border-color: rgba(255, 255, 255, 0.05) !important;
            color: var(--text-dim) !important;
        }
        nav[role="navigation"] svg, .pagination svg {
            width: 15px !important;
            height: 15px !important;
            max-width: 15px !important;
            max-height: 15px !important;
            display: inline-block !important;
            vertical-align: middle !important;
        }

        @media (max-width: 991px) {
            .admin-layout { flex-direction: column; }
            .admin-sidebar { width: 100%; height: auto; position: relative; padding: 16px 14px; border-right: none; border-bottom: 1px solid var(--border); }
            .admin-sidebar nav { display: grid !important; grid-template-columns: repeat(2, 1fr); gap: 4px; }
            .admin-content { padding: 20px 14px; }
        }
    </style>

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
