<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Panel Mitra Partner') - ALzis STURR</title>

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

    <!-- Stylesheets & Partner Theme -->
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
            --partner-color: #38bdf8;
            --gold: #fbbf24;
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
        body { font-family: var(--font-main); background: var(--bg-body); color: var(--text-main); line-height: 1.5; min-height: 100vh; }
        
        .partner-layout { display: flex; min-height: 100vh; background: var(--bg-body); }
        .partner-sidebar { width: 270px; background: #090e1c; border-right: 1px solid var(--border); padding: 20px 16px; display: flex; flex-direction: column; flex-shrink: 0; position: sticky; top: 0; height: 100vh; overflow-y: auto; z-index: 100; transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .partner-content { flex: 1; min-width: 0; padding: 28px 32px; background: var(--bg-body); }
        
        .partner-nav-item { display: flex; align-items: center; gap: 10px; padding: 11px 14px; border-radius: 8px; color: var(--text-muted); font-size: 0.86rem; font-weight: 600; text-decoration: none; transition: all 0.2s ease; margin-bottom: 3px; }
        .partner-nav-item:hover { color: #fff; background: rgba(0, 242, 254, 0.08); }
        .partner-nav-item.active { color: var(--primary); background: rgba(0, 242, 254, 0.12); border-left: 3px solid var(--primary); font-weight: 700; }

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
        .stat-title { font-size: 0.74rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
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
        .btn-danger { background: linear-gradient(135deg, #f43f5e 0%, #be123c 100%) !important; color: #fff !important; border: 1px solid rgba(244, 63, 94, 0.4) !important; border-radius: 8px; padding: 7px 12px; font-weight: 700; font-size: 0.82rem; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 5px; }

        .mobile-header { display: none; }
        .sidebar-overlay { display: none; }

        @media (max-width: 991px) {
            .mobile-header { display: flex; align-items: center; justify-content: space-between; padding: 12px 18px; background: #090e1c; border-bottom: 1px solid var(--border); position: sticky; top: 0; z-index: 150; }
            .partner-layout { flex-direction: column; }
            .partner-sidebar { position: fixed; top: 0; left: 0; width: 280px; height: 100vh; transform: translateX(-100%); box-shadow: 4px 0 25px rgba(0,0,0,0.8); z-index: 200; }
            .partner-sidebar.open { transform: translateX(0); }
            .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.7); backdrop-filter: blur(4px); z-index: 190; }
            .sidebar-overlay.open { display: block; }
            .partner-content { padding: 18px 14px; }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Mobile Topbar with Hamburger Toggle -->
    <div class="mobile-header">
        <div style="display: flex; align-items: center; gap: 10px;">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 32px; width: auto;">
            <div style="font-weight: 800; font-size: 1rem; color: #fff; font-family: var(--font-heading);">
                PARTNER <span style="color: var(--primary);">PANEL</span>
            </div>
        </div>
        <button type="button" id="sidebarToggleBtn" class="btn btn-outline btn-sm" style="padding: 6px 10px;">
            <i data-lucide="menu" style="width: 18px; height: 18px;"></i>
        </button>
    </div>

    <!-- Mobile Backdrop Overlay -->
    <div id="sidebarOverlay" class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <div class="partner-layout">
        <!-- Sidebar -->
        <aside id="partnerSidebar" class="partner-sidebar">
            <!-- Brand -->
            <div style="padding-bottom: 16px; border-bottom: 1px solid var(--border); margin-bottom: 14px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <a href="{{ route('partner.dashboard') }}" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
                        <img src="{{ asset('images/logo.png') }}" alt="ALzis Store Logo" style="height: 40px; width: auto; object-fit: contain; filter: drop-shadow(0 0 8px rgba(0, 242, 254, 0.4));">
                        <div>
                            <div style="font-size: 1.1rem; font-weight: 800; font-family: var(--font-heading); color: #fff; line-height: 1.1;">
                                ALZIS <span style="color: var(--primary);">PARTNER</span>
                            </div>
                            <span class="badge" style="background: rgba(0, 242, 254, 0.15); color: #00f2fe; border: 1px solid rgba(0, 242, 254, 0.4); font-size: 0.65rem; padding: 2px 6px; margin-top: 3px; font-weight: 800; display: inline-block;">
                                🤝 MITRA RESMI
                            </span>
                        </div>
                    </a>
                    <button type="button" onclick="toggleSidebar()" class="btn btn-outline btn-sm" style="display: none; padding: 4px 8px;" id="sidebarCloseBtn">
                        <i data-lucide="x" style="width: 16px; height: 16px;"></i>
                    </button>
                </div>

                <!-- Partner Profile Card -->
                <div style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 10px 12px; margin-top: 14px; display: flex; align-items: center; gap: 10px;">
                    <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" style="width: 34px; height: 34px; border-radius: 50%; object-fit: cover; border: 1px solid var(--primary); flex-shrink: 0;">
                    <div style="overflow: hidden; flex: 1;">
                        <div style="font-size: 0.82rem; font-weight: 700; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ Auth::user()->name }}
                        </div>
                        <div style="font-size: 0.7rem; color: #00f2fe; font-weight: 700;">
                            Mitra Partner
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav style="flex: 1; display: flex; flex-direction: column; gap: 3px;">
                <div style="font-size: 0.68rem; font-weight: 700; text-transform: uppercase; color: var(--text-dim); letter-spacing: 0.5px; padding: 6px 12px 2px;">
                    MENU UTAMA
                </div>

                <a href="{{ route('partner.dashboard') }}" class="partner-nav-item {{ request()->routeIs('partner.dashboard') ? 'active' : '' }}">
                    <i data-lucide="layout-dashboard" style="width: 16px; height: 16px;"></i>
                    <span>Dashboard Partner</span>
                </a>

                <a href="{{ route('partner.accounts.index') }}" class="partner-nav-item {{ request()->routeIs('partner.accounts.index') || request()->routeIs('partner.accounts.edit') ? 'active' : '' }}">
                    <i data-lucide="gamepad-2" style="width: 16px; height: 16px;"></i>
                    <span>Kelola Stok Akun Saya</span>
                </a>

                <a href="{{ route('partner.accounts.create') }}" class="partner-nav-item {{ request()->routeIs('partner.accounts.create') ? 'active' : '' }}" style="color: #38bdf8;">
                    <i data-lucide="plus-circle" style="width: 16px; height: 16px;"></i>
                    <span>+ Post Akun Game</span>
                </a>

                <div style="font-size: 0.68rem; font-weight: 700; text-transform: uppercase; color: var(--text-dim); letter-spacing: 0.5px; padding: 12px 12px 2px;">
                    PENGATURAN
                </div>

                <a href="{{ route('profile') }}" class="partner-nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                    <i data-lucide="user-cog" style="width: 16px; height: 16px;"></i>
                    <span>Profil & Kata Sandi</span>
                </a>

                @if(Auth::user()->isOwner())
                <a href="{{ route('admin.dashboard') }}" class="partner-nav-item" style="color: #fbbf24; background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.2);">
                    <i data-lucide="crown" style="width: 16px; height: 16px;"></i>
                    <span>Buka Panel Owner</span>
                </a>
                @endif
            </nav>

            <!-- Bottom Actions -->
            <div style="padding-top: 12px; border-top: 1px solid var(--border); margin-top: auto;">
                <a href="{{ route('home') }}" target="_blank" class="partner-nav-item" style="color: #7dd3fc;">
                    <i data-lucide="external-link" style="width: 16px; height: 16px;"></i>
                    <span>Buka Toko Publik</span>
                </a>

                <form action="{{ route('logout') }}" method="POST" style="margin-top: 2px;">
                    @csrf
                    <button type="submit" class="partner-nav-item" style="width: 100%; border: none; background: transparent; cursor: pointer; color: var(--danger);" onclick="return confirm('Keluar dari Panel Partner?')">
                        <i data-lucide="log-out" style="width: 16px; height: 16px;"></i>
                        <span>Keluar Panel</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="partner-content">
            <!-- Header Breadcrumb & Actions -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid var(--border); flex-wrap: wrap; gap: 14px;">
                <div>
                    <span style="font-size: 0.78rem; color: #00f2fe; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;">Panel Resmi Mitra Partner</span>
                    <h2 class="font-heading" style="font-size: 1.6rem; color: #fff; margin-top: 2px; font-weight: 800;">@yield('page_title', 'Partner Dashboard')</h2>
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
                                <span style="width: 14px; height: 14px; border-radius: 50%; background: linear-gradient(135deg, #ff7eb3, #ff4b8b); display: inline-block; flex-shrink: 0; box-shadow: 0 0 6px rgba(255, 105, 180, 0.6);"></span>
                                <span>🌸 Pink Sakura (Cewek)</span>
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
                <div class="alert alert-success" style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.4); color: #34d399; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                    <i data-lucide="check-circle-2" style="width: 18px; height: 18px; flex-shrink: 0;"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" style="background: rgba(244, 63, 94, 0.15); border: 1px solid rgba(244, 63, 94, 0.4); color: #fb7185; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                    <i data-lucide="alert-circle" style="width: 18px; height: 18px; flex-shrink: 0;"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" style="background: rgba(244, 63, 94, 0.15); border: 1px solid rgba(244, 63, 94, 0.4); color: #fb7185; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
                    <div style="font-weight: 700; margin-bottom: 6px;">Terdapat kesalahan pada input:</div>
                    <ul style="margin-left: 20px; font-size: 0.85rem;">
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
        function toggleSidebar() {
            const sidebar = document.getElementById('partnerSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('open');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('sidebarToggleBtn');
            if (toggleBtn) {
                toggleBtn.addEventListener('click', toggleSidebar);
            }
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
