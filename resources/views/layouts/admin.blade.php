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

    <!-- Instant Theme Loader (Zero Flicker) -->
    <script>
        (function() {
            try {
                const savedTheme = localStorage.getItem('alzis_theme') || @json(Auth::check() ? (Auth::user()->theme_preference ?? 'default') : 'default');
                if (savedTheme && savedTheme !== 'default') {
                    document.documentElement.setAttribute('data-theme', savedTheme);
                }
            } catch(e) {}
        })();
    </script>

    <!-- Stylesheets & Direct Self-Contained Admin Theme -->
    <link rel="stylesheet" href="{{ asset('css/alzis.css') }}?v=9.2">
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
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --text-dim: #64748b;
        }

        /* 🌸 Theme: Pink Sakura Pastel */
        [data-theme="pink-sakura"] {
            --bg-body: #160c16 !important;
            --bg-surface: #1e101f !important;
            --bg-surface-elevated: #261427 !important;
            --bg-card: #241325 !important;
            --bg-card-hover: #301a32 !important;
            --bg-glass: rgba(22, 12, 22, 0.95) !important;
            --bg-glass-card: rgba(36, 19, 37, 0.9) !important;
            --primary: #ff659f !important;
            --primary-hover: #ff8cb9 !important;
            --primary-gradient: linear-gradient(135deg, #ff659f 0%, #ff8eb4 50%, #ffa8c8 100%) !important;
            --primary-light: rgba(255, 101, 159, 0.18) !important;
            --primary-border: rgba(255, 101, 159, 0.42) !important;
            --border: rgba(255, 120, 175, 0.22) !important;
            --border-light: rgba(255, 140, 185, 0.32) !important;
            --accent-purple: #f472b6 !important;
            --shadow-glow: 0 0 25px rgba(255, 101, 159, 0.35) !important;
        }

        /* 🔮 Theme: Royal Violet (Midnight Purple) */
        [data-theme="purple-neon"] {
            --bg-body: #0b0616 !important;
            --bg-surface: #130b24 !important;
            --bg-surface-elevated: #190e30 !important;
            --bg-card: #190e30 !important;
            --bg-card-hover: #241444 !important;
            --primary: #a855f7 !important;
            --primary-hover: #c084fc !important;
            --primary-gradient: linear-gradient(135deg, #c084fc 0%, #7c3aed 100%) !important;
            --primary-light: rgba(168, 85, 247, 0.18) !important;
            --primary-border: rgba(168, 85, 247, 0.4) !important;
            --border: rgba(168, 85, 247, 0.18) !important;
        }

        /* 🌿 Theme: Emerald Mint (Fresh Green) */
        [data-theme="emerald-mint"] {
            --bg-body: #06100d !important;
            --bg-surface: #0b1a15 !important;
            --bg-surface-elevated: #0e221c !important;
            --bg-card: #0e221c !important;
            --bg-card-hover: #143027 !important;
            --primary: #10b981 !important;
            --primary-hover: #34d399 !important;
            --primary-gradient: linear-gradient(135deg, #34d399 0%, #059669 100%) !important;
            --primary-light: rgba(168, 85, 247, 0.18) !important;
            --primary-border: rgba(168, 85, 247, 0.4) !important;
            --border: rgba(16, 185, 129, 0.18) !important;
        }

        /* 🔥 Theme: Sunset Crimson (Fire Red) */
        [data-theme="sunset-crimson"] {
            --bg-body: #120608 !important;
            --bg-surface: #1c0a0e !important;
            --bg-surface-elevated: #260d13 !important;
            --bg-card: #260d13 !important;
            --bg-card-hover: #34121a !important;
            --primary: #f43f5e !important;
            --primary-hover: #fb7185 !important;
            --primary-gradient: linear-gradient(135deg, #fb7185 0%, #e11d48 50%, #f59e0b 100%) !important;
            --border: rgba(244, 63, 94, 0.18) !important;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font-main); background: var(--bg-body); color: var(--text-main); line-height: 1.5; min-height: 100vh; transition: background-color 0.3s ease, color 0.3s ease; }
        
        .admin-layout { display: flex; min-height: 100vh; background: var(--bg-body); }
        .admin-sidebar { width: 270px; background: var(--bg-surface); border-right: 1px solid var(--border); padding: 20px 16px; display: flex; flex-direction: column; flex-shrink: 0; position: sticky; top: 0; height: 100vh; overflow-y: auto; z-index: 100; }
        .admin-content { flex: 1; min-width: 0; padding: 28px 32px; background: var(--bg-body); }
        
        .admin-nav-item { display: flex; align-items: center; gap: 10px; padding: 10px 14px; border-radius: 8px; color: var(--text-muted); font-size: 0.86rem; font-weight: 600; text-decoration: none; transition: all 0.2s ease; margin-bottom: 2px; }
        .admin-nav-item:hover { color: #fff; background: var(--primary-light); }
        .admin-nav-item.active { color: var(--primary); background: var(--primary-light); border-left: 3px solid var(--primary); font-weight: 700; }

        /* Stat Cards */
        .stat-card {
            background: linear-gradient(145deg, var(--bg-card) 0%, var(--bg-surface-elevated) 100%) !important;
            border: 1px solid var(--border) !important;
            border-radius: 14px !important;
            padding: 18px 20px !important;
            box-shadow: var(--shadow-md) !important;
            transition: transform 0.2s ease, border-color 0.2s ease !important;
            position: relative;
            overflow: hidden;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            border-color: var(--primary) !important;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5) !important;
        }
        .stat-title { font-size: 0.76rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
        .stat-value { font-family: var(--font-heading); font-size: 1.65rem; font-weight: 900; margin-top: 4px; line-height: 1.1; }

        /* Data Tables */
        .data-table-card { background: var(--bg-card) !important; border: 1px solid var(--border) !important; border-radius: 14px !important; overflow: hidden; box-shadow: var(--shadow-md) !important; }
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
                <div style="display: flex; align-items: center; gap: 10px;">
                    <!-- Theme Picker Button -->
                    <div style="position: relative;">
                        <button type="button" class="btn btn-secondary btn-sm" id="btn-theme-picker" onclick="toggleThemeDropdown(event)" style="border-radius: 8px; padding: 6px 12px; font-size: 0.78rem; display: inline-flex; align-items: center; gap: 6px;">
                            <i data-lucide="palette" style="width: 14px; height: 14px; color: var(--primary);"></i>
                            <span>Tema</span>
                        </button>
                        
                        <!-- Theme Dropdown Menu -->
                        <div id="theme-dropdown-menu" style="display: none; position: absolute; top: calc(100% + 8px); right: 0; width: 220px; background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 8px; box-shadow: var(--shadow-md); z-index: 1100;">
                            <div style="font-size: 0.7rem; font-weight: 800; color: var(--text-dim); text-transform: uppercase; padding: 4px 8px 6px; border-bottom: 1px solid var(--border); margin-bottom: 6px;">
                                🎨 Pilih Tema Panel
                            </div>
                            <button type="button" onclick="setAppTheme('pink-sakura')" class="theme-option-btn" data-theme-val="pink-sakura" style="width: 100%; display: flex; align-items: center; gap: 8px; padding: 7px 10px; border-radius: 6px; border: none; background: transparent; color: #fff; font-size: 0.78rem; font-weight: 700; cursor: pointer; text-align: left; transition: all 0.2s;">
                                <span style="width: 14px; height: 14px; border-radius: 50%; background: linear-gradient(135deg, #ff659f, #ff8eb4); display: inline-block; flex-shrink: 0; box-shadow: 0 0 8px rgba(255, 101, 159, 0.7);"></span>
                                <span>🌸 Pink Sakura</span>
                            </button>
                            <button type="button" onclick="setAppTheme('default')" class="theme-option-btn" data-theme-val="default" style="width: 100%; display: flex; align-items: center; gap: 8px; padding: 7px 10px; border-radius: 6px; border: none; background: transparent; color: #fff; font-size: 0.78rem; font-weight: 700; cursor: pointer; text-align: left; transition: all 0.2s;">
                                <span style="width: 14px; height: 14px; border-radius: 50%; background: linear-gradient(135deg, #00f2fe, #2563eb); display: inline-block; flex-shrink: 0; box-shadow: 0 0 6px rgba(0, 242, 254, 0.6);"></span>
                                <span>⚡ Cyber Cyan (Default)</span>
                            </button>
                            <button type="button" onclick="setAppTheme('purple-neon')" class="theme-option-btn" data-theme-val="purple-neon" style="width: 100%; display: flex; align-items: center; gap: 8px; padding: 7px 10px; border-radius: 6px; border: none; background: transparent; color: #fff; font-size: 0.78rem; font-weight: 700; cursor: pointer; text-align: left; transition: all 0.2s;">
                                <span style="width: 14px; height: 14px; border-radius: 50%; background: linear-gradient(135deg, #c084fc, #7c3aed); display: inline-block; flex-shrink: 0; box-shadow: 0 0 6px rgba(168, 85, 247, 0.6);"></span>
                                <span>🔮 Midnight Purple</span>
                            </button>
                            <button type="button" onclick="setAppTheme('emerald-mint')" class="theme-option-btn" data-theme-val="emerald-mint" style="width: 100%; display: flex; align-items: center; gap: 8px; padding: 7px 10px; border-radius: 6px; border: none; background: transparent; color: #fff; font-size: 0.78rem; font-weight: 700; cursor: pointer; text-align: left; transition: all 0.2s;">
                                <span style="width: 14px; height: 14px; border-radius: 50%; background: linear-gradient(135deg, #34d399, #059669); display: inline-block; flex-shrink: 0; box-shadow: 0 0 6px rgba(16, 185, 129, 0.6);"></span>
                                <span>🌿 Emerald Mint</span>
                            </button>
                            <button type="button" onclick="setAppTheme('sunset-crimson')" class="theme-option-btn" data-theme-val="sunset-crimson" style="width: 100%; display: flex; align-items: center; gap: 8px; padding: 7px 10px; border-radius: 6px; border: none; background: transparent; color: #fff; font-size: 0.78rem; font-weight: 700; cursor: pointer; text-align: left; transition: all 0.2s;">
                                <span style="width: 14px; height: 14px; border-radius: 50%; background: linear-gradient(135deg, #fb7185, #f59e0b); display: inline-block; flex-shrink: 0; box-shadow: 0 0 6px rgba(244, 63, 94, 0.6);"></span>
                                <span>🔥 Sunset Crimson</span>
                            </button>
                        </div>
                    </div>

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

        // Global Theme Switcher Handlers
        function toggleThemeDropdown(e) {
            if (e) e.stopPropagation();
            const menu = document.getElementById('theme-dropdown-menu');
            if (menu) {
                menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            }
        }

        document.addEventListener('click', function(e) {
            const menu = document.getElementById('theme-dropdown-menu');
            const btn = document.getElementById('btn-theme-picker');
            if (menu && menu.style.display === 'block') {
                if (!menu.contains(e.target) && (!btn || !btn.contains(e.target))) {
                    menu.style.display = 'none';
                }
            }
        });

        function setAppTheme(themeName) {
            if (themeName === 'default') {
                document.documentElement.removeAttribute('data-theme');
                localStorage.setItem('alzis_theme', 'default');
            } else {
                document.documentElement.setAttribute('data-theme', themeName);
                localStorage.setItem('alzis_theme', themeName);
            }

            const menu = document.getElementById('theme-dropdown-menu');
            if (menu) menu.style.display = 'none';

            // Mark active button
            document.querySelectorAll('.theme-option-btn').forEach(el => {
                const val = el.getAttribute('data-theme-val');
                if (val === themeName) {
                    el.style.background = 'rgba(255, 255, 255, 0.1)';
                    el.style.borderColor = 'var(--primary)';
                } else {
                    el.style.background = 'transparent';
                    el.style.borderColor = 'transparent';
                }
            });

            // Save to DB
            const tokenMeta = document.querySelector('meta[name="csrf-token"]');
            const token = tokenMeta ? tokenMeta.getAttribute('content') : '';
            fetch('{{ route('profile.theme') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ theme: themeName })
            }).catch(() => {});
        }

        // Highlight active theme on load
        document.addEventListener('DOMContentLoaded', function() {
            const current = localStorage.getItem('alzis_theme') || @json(Auth::check() ? (Auth::user()->theme_preference ?? 'default') : 'default');
            document.querySelectorAll('.theme-option-btn').forEach(el => {
                const val = el.getAttribute('data-theme-val');
                if (val === current) {
                    el.style.background = 'rgba(255, 255, 255, 0.1)';
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
