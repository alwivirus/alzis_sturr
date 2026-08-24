<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ALZIS STORE') - Pusat Jual Beli Akun Game Terpercaya</title>
    <meta name="description" content="@yield('meta_description', 'ALZIS STORE - Pusat jual beli & rekber resmi akun Mobile Legends, Free Fire, Genshin Impact, PUBGM, & Valorant. Garansi 100% Anti Hackback & Transaksi Kilat 5 Menit.')">

    <!-- Preconnect & Asynchronous Google Fonts (Zero Render-Blocking) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800;900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800;900&display=swap">
    </noscript>

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

    <!-- Critical Above-The-Fold CSS (Instant Theme Aware & Mobile Viewport Lock) -->
    <style>
        :root {
            --bg-body: #0a0e17;
            --bg-main: #0a0e17;
            --bg-surface: #101726;
            --bg-surface-elevated: #162035;
            --bg-card: #131b2e;
            --bg-card-hover: #19243d;
            --bg-glass: rgba(10, 14, 23, 0.94);
            --bg-glass-card: rgba(19, 27, 46, 0.88);
            --primary: #f59e0b;
            --primary-hover: #f59e0b;
            --primary-gradient: #f59e0b;
            --primary-light: rgba(245, 158, 11, 0.12);
            --primary-border: rgba(245, 158, 11, 0.3);
            --accent-purple: #8b5cf6;
            --gold: #f59e0b;
            --danger: #ef4444;
            --success: #10b981;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --text-dim: #64748b;
            --border: rgba(255, 255, 255, 0.08);
            --border-light: rgba(255, 255, 255, 0.14);
            --font-sans: 'Plus Jakarta Sans', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            --font-heading: 'Outfit', system-ui, sans-serif;
        }

        /* 🌸 Theme: Soft Rose Sakura */
        [data-theme="pink-sakura"] {
            --bg-body: #140b12 !important;
            --bg-main: #140b12 !important;
            --bg-surface: #1d101b !important;
            --bg-surface-elevated: #261524 !important;
            --bg-card: #221320 !important;
            --bg-card-hover: #2e1a2b !important;
            --bg-glass: rgba(20, 11, 18, 0.95) !important;
            --bg-glass-card: rgba(34, 19, 32, 0.9) !important;
            --primary: #f472b6 !important;
            --primary-hover: #ec4899 !important;
            --primary-gradient: #db2777 !important;
            --primary-light: rgba(244, 114, 182, 0.15) !important;
            --primary-border: rgba(244, 114, 182, 0.35) !important;
            --border: rgba(244, 114, 182, 0.18) !important;
            --border-light: rgba(244, 114, 182, 0.28) !important;
            --accent-purple: #f472b6 !important;
            --shadow-glow: 0 4px 20px rgba(244, 114, 182, 0.2) !important;
        }

        /* 🔮 Theme: Royal Slate Violet */
        [data-theme="purple-neon"] {
            --bg-body: #0d0a17 !important;
            --bg-main: #0d0a17 !important;
            --bg-surface: #141024 !important;
            --bg-surface-elevated: #1c1633 !important;
            --bg-card: #18132b !important;
            --bg-card-hover: #221c3d !important;
            --bg-glass: rgba(13, 10, 23, 0.95) !important;
            --bg-glass-card: rgba(24, 19, 43, 0.88) !important;
            --primary: #8b5cf6 !important;
            --primary-hover: #7c3aed !important;
            --primary-gradient: #7c3aed !important;
            --primary-light: rgba(139, 92, 246, 0.15) !important;
            --primary-border: rgba(139, 92, 246, 0.35) !important;
            --border: rgba(139, 92, 246, 0.15) !important;
            --border-light: rgba(139, 92, 246, 0.25) !important;
        }

        /* 🌿 Theme: Clean Emerald Jade */
        [data-theme="emerald-mint"] {
            --bg-body: #07120e !important;
            --bg-main: #07120e !important;
            --bg-surface: #0c1c17 !important;
            --bg-surface-elevated: #112720 !important;
            --bg-card: #0f221c !important;
            --bg-card-hover: #153027 !important;
            --bg-glass: rgba(7, 18, 14, 0.95) !important;
            --bg-glass-card: rgba(15, 34, 28, 0.88) !important;
            --primary: #10b981 !important;
            --primary-hover: #059669 !important;
            --primary-gradient: linear-gradient(135deg, #10b981 0%, #047857 100%) !important;
            --primary-light: rgba(16, 185, 129, 0.15) !important;
            --primary-border: rgba(16, 185, 129, 0.35) !important;
            --border: rgba(16, 185, 129, 0.15) !important;
            --border-light: rgba(16, 185, 129, 0.25) !important;
        }

        /* 🔥 Theme: Deep Crimson Ruby */
        [data-theme="sunset-crimson"] {
            --bg-body: #14080a !important;
            --bg-main: #14080a !important;
            --bg-surface: #1c0c0f !important;
            --bg-surface-elevated: #261115 !important;
            --bg-card: #220e12 !important;
            --bg-card-hover: #2e1419 !important;
            --bg-glass: rgba(20, 8, 10, 0.95) !important;
            --bg-glass-card: rgba(34, 14, 18, 0.88) !important;
            --primary: #f43f5e !important;
            --primary-hover: #e11d48 !important;
            --primary-gradient: #e11d48 !important;
            --primary-light: rgba(244, 63, 94, 0.15) !important;
            --primary-border: rgba(244, 63, 94, 0.35) !important;
            --border: rgba(244, 63, 94, 0.15) !important;
            --border-light: rgba(244, 63, 94, 0.25) !important;
        }

        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        html{scroll-behavior:smooth;-webkit-text-size-adjust:100%;touch-action:pan-y;overflow-x:hidden;}
        body{background:var(--bg-body);color:var(--text-main);font-family:var(--font-sans);min-height:100vh;width:100% !important;max-width:100vw !important;overflow-x:hidden !important;position:relative;touch-action:pan-y;padding-bottom:70px;transition:background-color 0.3s ease, color 0.3s ease;}
        @media(min-width:992px){body{padding-bottom:0;}}
        .container{width:100% !important;max-width:1360px !important;margin:0 auto !important;padding:0 20px;box-sizing:border-box !important;}
        @media(min-width:1440px){.container{max-width:1440px !important;padding:0 28px;}}
        @media(max-width:768px){.container{padding:0 10px !important;max-width:100% !important;}}
        .top-announcement{background:var(--bg-surface);border-bottom:1px solid var(--border);padding:6px 0;font-size:0.75rem;width:100%;overflow:hidden;}
        .top-contact-pill{display:inline-flex;align-items:center;gap:5px;padding:3px 9px;border-radius:999px;font-size:0.72rem;background:rgba(255,255,255,0.05);color:var(--text-muted);text-decoration:none;}
        .navbar{position:sticky;top:0;z-index:1000;background:var(--bg-glass);backdrop-filter:blur(16px);-webkit-backdrop-filter:blur(16px);border-bottom:1px solid var(--border);padding:8px 0;width:100%;}
        .nav-wrapper{display:flex;align-items:center;justify-content:space-between;gap:10px;height:52px;width:100%;}
        @media(min-width:992px){.nav-wrapper{height:62px;}}
        .brand-logo{display:flex !important;align-items:center !important;text-decoration:none !important;gap:8px !important;flex-shrink:0 !important;white-space:nowrap !important;min-width:max-content !important;}
        .brand-logo *{white-space:nowrap !important;flex-shrink:0 !important;}
        .nav-menu{display:none !important;align-items:center;gap:6px;list-style:none;}
        @media(min-width:1024px){.nav-menu{display:flex !important;}}
        .nav-link{display:flex;align-items:center;gap:6px;padding:8px 14px;border-radius:10px;color:var(--text-muted);font-weight:600;font-size:0.88rem;text-decoration:none;transition:all 0.2s ease;}
        .nav-link:hover{color:#ffffff;background:rgba(255,255,255,0.05);}
        .nav-link.active{background:rgba(255,255,255,0.08) !important;color:#ffffff !important;border:1px solid rgba(255,255,255,0.14) !important;font-weight:700 !important;}
        .hero-section{padding:12px 0 18px;width:100%;}
        .hero-banner-card{position:relative;border-radius:16px;overflow:hidden;background:#0b0f19;border:1px solid var(--border);min-height:280px;width:100% !important;max-width:100% !important;}
        @media(min-width:768px){.hero-banner-card{min-height:420px;border-radius:24px;}}
        .hero-slider-container{position:absolute;inset:0;}
        .hero-slide{position:absolute;inset:0;background-size:cover;background-position:center;opacity:0;transition:opacity 0.7s ease;}
        .hero-slide.active{opacity:1;}
        .hero-slider-overlay{position:absolute;inset:0;background:linear-gradient(90deg,rgba(11,15,25,0.96) 0%,rgba(11,15,25,0.85) 55%,rgba(11,15,25,0.4) 100%);}
        @media(max-width:768px){.hero-slider-overlay{background:linear-gradient(180deg,rgba(11,15,25,0.95) 0%,rgba(11,15,25,0.85) 60%,rgba(11,15,25,0.98) 100%);}}
        .hero-content-layer{position:relative;z-index:2;padding:20px 14px;width:100% !important;max-width:100% !important;box-sizing:border-box !important;}
        @media(min-width:768px){.hero-content-layer{padding:44px 36px;max-width:680px !important;}}
        .hero-tag{display:inline-flex;align-items:center;gap:6px;padding:4px 10px;border-radius:999px;background:rgba(37,99,235,0.12);border:1px solid rgba(37,99,235,0.35);color:#fde68a;font-size:0.68rem;font-weight:800;margin-bottom:8px;}
        .hero-title{font-family:var(--font-heading);font-size:1.38rem;font-weight:900;color:#fff;line-height:1.2;margin-bottom:8px;}
        @media(min-width:768px){.hero-title{font-size:2.4rem;}}
        .text-gradient{color:#f59e0b !important;background:none !important;-webkit-text-fill-color:#f59e0b !important;}
        .btn{display:inline-flex;align-items:center;justify-content:center;gap:6px;padding:8px 16px;border-radius:10px;font-weight:700;font-size:0.84rem;text-decoration:none;border:1px solid transparent;cursor:pointer;transition:all 0.2s ease;}
        .btn-primary{background:#f59e0b !important;color:#ffffff !important;font-weight:700;border:1px solid #f59e0b !important;box-shadow:0 2px 8px rgba(37,99,235,0.25) !important;}
        .btn-primary:hover{background:#f59e0b !important;color:#ffffff !important;transform:translateY(-1px);}
        .btn-secondary{background:rgba(255,255,255,0.06);border-color:var(--border);color:var(--text-main);}
        .btn-whatsapp{background:#16a34a !important;color:#fff!important;font-weight:800;border:1px solid #15803d !important;box-shadow:0 2px 8px rgba(22,163,74,0.25) !important;}
        .btn-discord{background:#4f46e5 !important;color:#fff!important;font-weight:800;border:1px solid #4338ca !important;box-shadow:0 2px 8px rgba(79,70,229,0.25) !important;}
        .btn-instagram{background:#e11d48 !important;color:#fff!important;font-weight:800;border:1px solid #be123c !important;box-shadow:0 2px 8px rgba(225,29,72,0.25) !important;}
        
        /* Mobile Bottom Nav Bar with safe area support */
        .mobile-bottom-nav{position:fixed;bottom:0;left:0;right:0;width:100% !important;height:60px;padding-bottom:env(safe-area-inset-bottom,0px);background:var(--bg-glass);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);border-top:1px solid var(--border);display:flex;align-items:center;justify-content:space-around;z-index:9999;padding-left:4px;padding-right:4px;}
        @media(min-width:992px){.mobile-bottom-nav{display:none!important;}}
        .mobile-nav-tab{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:2px;color:var(--text-muted);text-decoration:none;font-size:0.68rem;font-weight:700;padding:4px 6px;flex:1;max-width:72px;}
        .mobile-nav-tab svg{width:19px!important;height:19px!important;display:block;}
        .mobile-nav-tab.active{color:var(--primary);}
        
        /* Trust Highlights Bar (Horizontal --- on PC, 2x2 on Mobile) */
        .trust-highlights-grid{display:grid !important;grid-template-columns:repeat(4,1fr) !important;gap:16px !important;background:var(--bg-card,#0e1628) !important;border:1px solid var(--border,rgba(255,255,255,0.08)) !important;border-radius:16px !important;padding:18px 24px !important;width:100% !important;box-sizing:border-box !important;}
        @media(max-width:991px){.trust-highlights-grid{grid-template-columns:repeat(2,1fr) !important;gap:10px !important;padding:14px !important;}}
        @media(max-width:480px){.trust-highlights-grid{grid-template-columns:repeat(2,1fr) !important;gap:8px !important;padding:12px 10px !important;}}

        /* Account Card System & Non-Clipping Detail Button */
        .account-card{position:relative;background:var(--bg-card,#0e1628);border:1px solid var(--border,rgba(255,255,255,0.08));border-radius:12px;overflow:hidden;display:flex;flex-direction:column;box-sizing:border-box;cursor:pointer;width:100% !important;min-width:0 !important;-webkit-tap-highlight-color:rgba(245, 158, 11,0.1);transition:transform 0.25s ease,border-color 0.25s ease,box-shadow 0.25s ease;}
        .account-card:hover{transform:translateY(-4px);border-color:rgba(245, 158, 11,0.4);box-shadow:0 12px 30px rgba(0,0,0,0.5);}
        .account-card-overlay-link{position:absolute;inset:0;z-index:4;border-radius:inherit;display:block;text-indent:-9999px;outline:none;}
        .account-card .btn-toggle-wishlist,
        .account-card .btn,
        .account-card a:not(.account-card-overlay-link){position:relative;z-index:8;}
        
        .accounts-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr)) !important;gap:8px;width:100% !important;max-width:100% !important;box-sizing:border-box;}
        @media(min-width:600px){.accounts-grid{grid-template-columns:repeat(2,minmax(0,1fr)) !important;gap:14px;}}
        @media(min-width:992px){.accounts-grid{grid-template-columns:repeat(3,minmax(0,1fr)) !important;gap:20px;}}
        @media(min-width:1200px){.accounts-grid{grid-template-columns:repeat(4,minmax(0,1fr)) !important;gap:22px;}}
        @media(max-width:340px){.accounts-grid{grid-template-columns:1fr !important;gap:8px;}}

        .account-pricing{margin-top:auto;padding-top:8px;border-top:1px solid var(--border,rgba(255,255,255,0.08));display:flex;align-items:center;justify-content:space-between;gap:6px;width:100%;}
        .price-box{display:flex;flex-direction:column;min-width:0;flex:1 1 auto;overflow:hidden;}
        .price-main{font-family:var(--font-heading);font-size:0.95rem;font-weight:900;color:var(--primary);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
        .price-strike{font-size:0.68rem;color:var(--text-muted);text-decoration:line-through;white-space:nowrap;}
        .account-actions{display:flex;align-items:center;gap:4px;flex-shrink:0;}
        .account-actions .btn{padding:5px 8px !important;font-size:0.72rem !important;border-radius:6px !important;white-space:nowrap !important;flex-shrink:0 !important;}
        .account-actions .btn-icon{width:28px !important;height:28px !important;padding:0 !important;flex:0 0 28px !important;}
        
        @media(max-width:768px){
            .account-pricing{flex-direction:column !important;align-items:stretch !important;gap:6px !important;padding-top:6px !important;}
            .price-box{display:flex !important;flex-direction:row !important;align-items:baseline !important;gap:6px !important;width:100% !important;}
            .price-main{font-size:0.92rem !important;color:var(--primary) !important;font-weight:900 !important;}
            .price-strike{font-size:0.65rem !important;}
            .account-actions{display:flex !important;width:100% !important;gap:4px !important;}
            .account-actions .btn{flex:1 !important;justify-content:center !important;padding:5px 8px !important;font-size:0.74rem !important;text-align:center !important;}
            .account-actions .btn-icon{width:30px !important;height:30px !important;flex:0 0 30px !important;}
            
            /* Responsive Header and Nav Actions */
            .navbar{padding:6px 0 !important;}
            .nav-wrapper{height:48px !important;}
            .nav-actions{gap:4px !important;}
            .nav-actions .user-name-text{display:none !important;}
            .nav-actions .btn-sm{padding:4px 7px !important;font-size:0.72rem !important;}
            .nav-actions .btn-icon{width:30px !important;height:30px !important;}
            .brand-logo img{height:30px !important;}
            .brand-logo span{font-size:0.95rem !important;}
        }
        @media(max-width:380px){
            .nav-actions{gap:3px !important;}
            .nav-actions .btn-sm{padding:3px 5px !important;font-size:0.68rem !important;}
            .nav-actions .btn-icon{width:28px !important;height:28px !important;}
            .brand-logo img{height:26px !important;}
            .brand-logo span{font-size:0.86rem !important;}
        }

        /* Auth and Cards Grid Rules */
        .auth-page-wrapper{min-height:calc(100vh - 220px);display:flex;align-items:center;justify-content:center;padding:36px 16px 60px;width:100%;box-sizing:border-box;}
        .auth-card{width:100%;max-width:440px;margin:0 auto;background:var(--bg-card,#131b2e);border:1px solid var(--border-light,rgba(255,255,255,0.12));border-radius:20px;padding:32px 26px;box-shadow:0 20px 50px rgba(0,0,0,0.5);position:relative;overflow:hidden;box-sizing:border-box;}
        .auth-card-wide{max-width:480px;}
        
        .feature-highlights-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;width:100%;}
        @media(max-width:991px){.feature-highlights-grid{grid-template-columns:repeat(2,1fr);gap:14px;}}
        @media(max-width:520px){.feature-highlights-grid{grid-template-columns:repeat(2,1fr);gap:10px;}}
        @media(max-width:340px){.feature-highlights-grid{grid-template-columns:1fr;gap:10px;}}
    </style>

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/alzis.css') }}?v=10.2">

    @stack('styles')
</head>
<body>

    <!-- Top Official Announcement Bar -->
    <div class="top-announcement">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center; gap: 8px; min-width: 0; width: 100%;">
            <div style="display: flex; align-items: center; gap: 6px; min-width: 0; flex: 1; overflow: hidden;">
                <span style="color: var(--primary); font-weight: 800; font-size: 0.7rem; letter-spacing: 0.8px; text-transform: uppercase; flex-shrink: 0;">🔥 INFO RESMI:</span>
                <span style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-size: 0.74rem; color: var(--text-muted); min-width: 0;">{{ \App\Models\SiteSetting::get('banner_announcement', 'GARANSI RESMI 100% ANTI HACKBACK! Transaksi kilat & serah terima akun aman via WhatsApp & Discord.') }}</span>
            </div>
            <div class="top-announcement-socials" style="display: flex; align-items: center; gap: 6px; flex-shrink: 0;">
                <a href="{{ \App\Models\SiteSetting::get('discord_invite_url', 'https://discord.gg/zEGEGs6hat') }}" target="_blank" class="top-contact-pill">
                    <svg style="width: 13px; height: 13px; fill: currentColor;" viewBox="0 0 24 24"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994.021-.041.001-.09-.041-.106a13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.929 1.793 8.18 1.793 12.061 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.893.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.028zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.956-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.955-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.946 2.418-2.157 2.418z"/></svg>
                    <span>Discord</span>
                </a>
                <a href="https://instagram.com/{{ \App\Models\SiteSetting::get('instagram_username', 'alzis_sturr') }}" target="_blank" class="top-contact-pill">
                    <svg style="width: 12px; height: 12px; fill: currentColor;" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    <span>Instagram</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <header class="navbar">
        <div class="container">
            <div class="nav-wrapper">
                <!-- Brand Official Logo -->
                <a href="{{ route('home') }}" class="brand-logo" style="display: flex; align-items: center; gap: 8px; text-decoration: none; flex-shrink: 0; white-space: nowrap; min-width: max-content;">
                    <img src="{{ asset('images/logo.png') }}" width="34" height="34" decoding="async" alt="ALZIS STORE Logo" style="height: 34px; width: auto; object-fit: contain; flex-shrink: 0;">
                    <div style="display: flex; flex-direction: column; white-space: nowrap;">
                        <span style="font-size: 1.05rem; font-weight: 900; font-family: var(--font-heading); color: #fff; line-height: 1.1; letter-spacing: 0.2px; white-space: nowrap;">
                            ALZIS <span style="color: var(--primary);">STORE</span>
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
                                <span>Katalog Produk & Game</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('how.to.buy') }}" class="nav-link {{ request()->routeIs('how.to.buy') ? 'active' : '' }}">
                                <span>Cara Beli & Garansi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                                <span>Kontak & Bantuan</span>
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- Header Search Bar (Desktop only) -->
                <form action="{{ route('catalog') }}" method="GET" class="nav-search-bar">
                    <svg style="width: 15px; height: 15px; color: var(--text-dim); flex-shrink: 0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari akun game, CapCut, Spotify, FT...">
                </form>

                <!-- Nav Actions -->
                <div class="nav-actions" style="display: flex; align-items: center; gap: 5px; flex-shrink: 0;">
                    <!-- Theme Picker Button -->
                    <div style="position: relative;">
                        <button type="button" class="btn btn-secondary btn-icon" id="btn-theme-picker" onclick="toggleThemeDropdown(event)" title="Pilih Tema Warna" style="width: 32px; height: 32px; flex-shrink: 0; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px;">
                            <svg style="width: 15px; height: 15px; color: var(--primary);" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="13.5" cy="6.5" r=".5" fill="currentColor"/><circle cx="17.5" cy="10.5" r=".5" fill="currentColor"/><circle cx="8.5" cy="7.5" r=".5" fill="currentColor"/><circle cx="6.5" cy="12.5" r=".5" fill="currentColor"/><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.563-2.512 5.563-5.563C22 6.5 17.5 2 12 2z"/></svg>
                        </button>
                        
                        <!-- Theme Dropdown Menu -->
                        <div id="theme-dropdown-menu" style="display: none; position: absolute; top: calc(100% + 8px); right: 0; width: 220px; background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 8px; box-shadow: var(--shadow-md); z-index: 1100;">
                            <div style="font-size: 0.7rem; font-weight: 800; color: var(--text-dim); text-transform: uppercase; padding: 4px 8px 6px; border-bottom: 1px solid var(--border); margin-bottom: 6px;">
                                🎨 Pilih Tema Website
                            </div>
                            <button type="button" onclick="setAppTheme('default')" class="theme-option-btn" data-theme-val="default" style="width: 100%; display: flex; align-items: center; gap: 8px; padding: 7px 10px; border-radius: 6px; border: none; background: transparent; color: #fff; font-size: 0.78rem; font-weight: 700; cursor: pointer; text-align: left; transition: all 0.2s;">
                                <span style="width: 14px; height: 14px; border-radius: 50%; background: linear-gradient(135deg, #f59e0b, #f59e0b); display: inline-block; flex-shrink: 0; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.35);"></span>
                                <span>⚡ Sapphire Slate (Default)</span>
                            </button>
                            <button type="button" onclick="setAppTheme('emerald-mint')" class="theme-option-btn" data-theme-val="emerald-mint" style="width: 100%; display: flex; align-items: center; gap: 8px; padding: 7px 10px; border-radius: 6px; border: none; background: transparent; color: #fff; font-size: 0.78rem; font-weight: 700; cursor: pointer; text-align: left; transition: all 0.2s;">
                                <span style="width: 14px; height: 14px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #047857); display: inline-block; flex-shrink: 0; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.35);"></span>
                                <span>🌿 Emerald Jade</span>
                            </button>
                            <button type="button" onclick="setAppTheme('purple-neon')" class="theme-option-btn" data-theme-val="purple-neon" style="width: 100%; display: flex; align-items: center; gap: 8px; padding: 7px 10px; border-radius: 6px; border: none; background: transparent; color: #fff; font-size: 0.78rem; font-weight: 700; cursor: pointer; text-align: left; transition: all 0.2s;">
                                <span style="width: 14px; height: 14px; border-radius: 50%; background: linear-gradient(135deg, #8b5cf6, #6d28d9); display: inline-block; flex-shrink: 0; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.35);"></span>
                                <span>🔮 Royal Violet</span>
                            </button>
                            <button type="button" onclick="setAppTheme('sunset-crimson')" class="theme-option-btn" data-theme-val="sunset-crimson" style="width: 100%; display: flex; align-items: center; gap: 8px; padding: 7px 10px; border-radius: 6px; border: none; background: transparent; color: #fff; font-size: 0.78rem; font-weight: 700; cursor: pointer; text-align: left; transition: all 0.2s;">
                                <span style="width: 14px; height: 14px; border-radius: 50%; background: linear-gradient(135deg, #f43f5e, #be123c); display: inline-block; flex-shrink: 0; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.35);"></span>
                                <span>🔥 Crimson Ruby</span>
                            </button>
                            <button type="button" onclick="setAppTheme('pink-sakura')" class="theme-option-btn" data-theme-val="pink-sakura" style="width: 100%; display: flex; align-items: center; gap: 8px; padding: 7px 10px; border-radius: 6px; border: none; background: transparent; color: #fff; font-size: 0.78rem; font-weight: 700; cursor: pointer; text-align: left; transition: all 0.2s;">
                                <span style="width: 14px; height: 14px; border-radius: 50%; background: linear-gradient(135deg, #f472b6, #db2777); display: inline-block; flex-shrink: 0; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.35);"></span>
                                <span>🌸 Soft Sakura</span>
                            </button>
                        </div>
                    </div>

                    @auth
                        <!-- Wishlist Button -->
                        <a href="{{ route('wishlist.index') }}" class="btn btn-secondary btn-icon" title="Wishlist Favorit" style="position: relative; width: 32px; height: 32px; flex-shrink: 0; padding: 0; display: inline-flex; align-items: center; justify-content: center;">
                            <svg style="width: 15px; height: 15px; {{ Auth::user()->wishlists()->count() > 0 ? 'color: var(--danger); fill: var(--danger);' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                            <span id="nav-wishlist-badge" class="wishlist-badge" style="{{ Auth::user()->wishlists()->count() > 0 ? 'display: flex;' : 'display: none;' }}">
                                {{ Auth::user()->wishlists()->count() }}
                            </span>
                        </a>

                        @if(Auth::user()->isOwner())
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm" style="background: rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.4); color: #fbbf24; font-weight: 800; padding: 5px 9px; font-size: 0.74rem;">
                                <svg style="width: 13px; height: 13px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M2 4l3 12h14l3-12-6 7-4-7-4 7-6-7zm3 16h14v2H5v-2z"/></svg>
                                <span>Owner</span>
                            </a>
                        @elseif(Auth::user()->isPartner())
                            <a href="{{ route('partner.dashboard') }}" class="btn btn-sm" style="background: var(--primary-light); border: 1px solid var(--primary-border); color: var(--primary); font-weight: 800; padding: 5px 9px; font-size: 0.74rem;">
                                <svg style="width: 13px; height: 13px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                <span>Panel Partner</span>
                            </a>
                        @endif

                        <!-- Profile Pill with Avatar -->
                        <a href="{{ route('profile') }}" class="btn btn-secondary btn-sm" style="gap: 6px; padding: 4px 8px;" title="{{ Auth::user()->name }}">
                            <img src="{{ Auth::user()->avatar_url }}" alt="Avatar" width="22" height="22" style="width: 22px; height: 22px; border-radius: 50%; object-fit: cover; border: 1px solid var(--primary); flex-shrink: 0;">
                            <span class="user-name-text" style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-weight: 700; font-size: 0.76rem;">{{ Auth::user()->name }}</span>
                        </a>

                        <!-- Logout -->
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-icon" title="Keluar Akun" style="width: 32px; height: 32px; padding: 0;" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                                <svg style="width: 14px; height: 14px; color: var(--text-dim);" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('wishlist.index') }}" class="btn btn-secondary btn-icon" title="Wishlist" style="width: 32px; height: 32px; flex-shrink: 0; padding: 0; display: inline-flex; align-items: center; justify-content: center;">
                            <svg style="width: 15px; height: 15px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-secondary btn-sm" style="padding: 5px 9px; font-size: 0.74rem; flex-shrink: 0; white-space: nowrap; border-radius: 6px;">
                            <span>Masuk</span>
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm" style="padding: 5px 9px; font-size: 0.74rem; flex-shrink: 0; white-space: nowrap; border-radius: 6px;">
                            <span>Daftar</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Flash Messages -->
    @if(session('success') || session('error'))
    <div class="container" style="margin-top: 14px; margin-bottom: 6px;">
        @if(session('success'))
            <div style="background: rgba(16, 185, 129, 0.12); border: 1px solid rgba(16, 185, 129, 0.35); border-radius: var(--radius-md); padding: 12px 18px; color: #34d399; font-size: 0.88rem; display: flex; align-items: center; gap: 10px;">
                <svg style="width: 18px; height: 18px; flex-shrink: 0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div style="background: rgba(244, 63, 94, 0.12); border: 1px solid rgba(244, 63, 94, 0.35); border-radius: var(--radius-md); padding: 12px 18px; color: #fb7185; font-size: 0.88rem; display: flex; align-items: center; gap: 10px;">
                <svg style="width: 18px; height: 18px; flex-shrink: 0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif
    </div>
    @endif

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
                        <img src="{{ asset('images/logo.png') }}" width="44" height="44" decoding="async" alt="ALZIS STORE Logo" style="height: 44px; width: auto; object-fit: contain; filter: drop-shadow(0 0 10px rgba(245, 158, 11, 0.5));">
                        <div>
                            <div style="font-size: 1.25rem; font-weight: 900; font-family: var(--font-heading); color: #fff; line-height: 1.1;">
                                ALZIS <span style="color: var(--primary);">STORE</span>
                            </div>
                            <div style="font-size: 0.65rem; color: var(--text-dim); letter-spacing: 1.5px; text-transform: uppercase; font-weight: 700;">PRO GAMING MARKETPLACE</div>
                        </div>
                    </div>
                    <p style="color: var(--text-muted); font-size: 0.86rem; line-height: 1.6; margin-bottom: 18px;">
                        Platform marketplace & rekber resmi akun game online Mobile Legends, Free Fire, Genshin Impact, PUBGM, & Valorant. Garansi 100% Anti Hackback & Serah Terima Kilat 5 Menit.
                    </p>
                    <div class="social-icon-links">
                        <!-- Discord -->
                        <a href="{{ \App\Models\SiteSetting::get('discord_invite_url', 'https://discord.gg/zEGEGs6hat') }}" target="_blank" class="social-icon-btn" title="Discord Official" style="background: rgba(88, 101, 242, 0.12); color: #5865F2; border-color: rgba(88, 101, 242, 0.35);">
                            <svg style="width: 20px; height: 20px; fill: currentColor;" viewBox="0 0 24 24"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994.021-.041.001-.09-.041-.106a13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.929 1.793 8.18 1.793 12.061 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.893.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.028zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.956-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.955-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.946 2.418-2.157 2.418z"/></svg>
                        </a>
                        <!-- Instagram -->
                        <a href="https://instagram.com/{{ \App\Models\SiteSetting::get('instagram_username', 'alzis_sturr') }}" target="_blank" class="social-icon-btn" title="Instagram Official" style="background: rgba(244, 63, 94, 0.12); color: #f43f5e; border-color: rgba(244, 63, 94, 0.35);">
                            <svg style="width: 18px; height: 18px; fill: currentColor;" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <!-- WhatsApp -->
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\SiteSetting::get('whatsapp_number', '6282324634848')) }}" target="_blank" class="social-icon-btn" title="WhatsApp Admin" style="background: rgba(37, 211, 102, 0.12); color: #25D366; border-color: rgba(37, 211, 102, 0.35);">
                            <svg style="width: 18px; height: 18px; fill: currentColor;" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="footer-heading">Navigasi Utama</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('catalog') }}">Katalog Stok Akun</a></li>
                        <li><a href="{{ route('how.to.buy') }}">Cara Transaksi & Garansi</a></li>
                        <li><a href="{{ route('contact') }}">Kontak & Bantuan Resmi</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="footer-heading">Kategori Populer</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('catalog', ['category' => 'mobile-legends']) }}">Mobile Legends: Bang Bang</a></li>
                        <li><a href="{{ route('catalog', ['category' => 'free-fire']) }}">Free Fire Max</a></li>
                        <li><a href="{{ route('catalog', ['category' => 'genshin-impact']) }}">Genshin Impact</a></li>
                        <li><a href="{{ route('catalog', ['category' => 'pubg-mobile']) }}">PUBG Mobile</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="footer-heading">Jaminan & Keamanan</h4>
                    <p style="color: var(--text-muted); font-size: 0.85rem; line-height: 1.5; margin-bottom: 12px;">
                        Semua transaksi dilindungi sistem keamanan tingkat tinggi dengan verifikasi data ketat dan garansi anti-hackback seumur hidup.
                    </p>
                    <div style="font-size: 0.82rem; color: var(--primary); font-weight: 800; display: flex; align-items: center; gap: 8px;">
                        <svg style="width: 18px; height: 18px; color: var(--primary);" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
                        <span>100% Anti Hackback Guaranteed</span>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} <strong>ALZIS STORE</strong>. Official Gaming Marketplace. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Navigation Dock -->
    <nav class="mobile-bottom-nav">
        <a href="{{ route('home') }}" class="mobile-nav-tab {{ request()->routeIs('home') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            <span>Beranda</span>
        </a>
        <a href="{{ route('catalog') }}" class="mobile-nav-tab {{ request()->routeIs('catalog') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="6" y1="12" x2="10" y2="12"/><line x1="8" y1="10" x2="8" y2="14"/><line x1="15" y1="13" x2="15.01" y2="13"/><line x1="18" y1="11" x2="18.01" y2="11"/><rect x="2" y="6" width="20" height="12" rx="2"/></svg>
            <span>Katalog</span>
        </a>
        <a href="{{ route('wishlist.index') }}" class="mobile-nav-tab {{ request()->routeIs('wishlist.*') ? 'active' : '' }}">
            <div style="position: relative; display: inline-flex;">
                <svg style="{{ Auth::check() && Auth::user()->wishlists()->count() > 0 ? 'fill: var(--danger); color: var(--danger);' : '' }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                @auth
                    @if(Auth::user()->wishlists()->count() > 0)
                        <span class="wishlist-badge">{{ Auth::user()->wishlists()->count() }}</span>
                    @endif
                @endauth
            </div>
            <span>Favorit</span>
        </a>
        <a href="{{ route('contact') }}" class="mobile-nav-tab {{ request()->routeIs('contact') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            <span>Bantuan</span>
        </a>
        @auth
            @if(Auth::user()->isOwner() || Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="mobile-nav-tab {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                    <svg style="color: var(--gold);" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    <span style="color: var(--gold);">Owner</span>
                </a>
            @elseif(Auth::user()->isPartner())
                <a href="{{ route('partner.dashboard') }}" class="mobile-nav-tab {{ request()->routeIs('partner.*') ? 'active' : '' }}">
                    <svg style="color: var(--primary);" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    <span style="color: var(--primary);">Partner</span>
                </a>
            @else
                <a href="{{ route('profile') }}" class="mobile-nav-tab {{ request()->routeIs('profile') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <span>Akun</span>
                </a>
            @endif
        @else
            <a href="{{ route('login') }}" class="mobile-nav-tab {{ request()->routeIs('login') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                <span>Masuk</span>
            </a>
        @endauth
    </nav>

    <div id="toast-container" class="toast-container"></div>

    <!-- Scripts -->
    <script>
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = `toast-alert toast-${type}`;
            const iconSvg = type === 'success' 
                ? `<svg style="width: 18px; height: 18px; color: var(--primary); flex-shrink: 0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>`
                : `<svg style="width: 18px; height: 18px; color: var(--danger); flex-shrink: 0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>`;
            
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

                            const svg = this.querySelector('svg');
                            if (data.is_wishlisted) {
                                this.style.color = 'var(--danger)';
                                if (svg) {
                                    svg.style.color = 'var(--danger)';
                                    svg.setAttribute('fill', 'var(--danger)');
                                }
                            } else {
                                this.style.color = 'inherit';
                                if (svg) {
                                    svg.style.color = 'inherit';
                                    svg.setAttribute('fill', 'none');
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
            document.querySelectorAll('.theme-option-btn, .theme-card-picker').forEach(el => {
                const val = el.getAttribute('data-theme-val');
                if (val === themeName) {
                    el.style.background = 'rgba(255, 255, 255, 0.1)';
                    el.style.borderColor = 'var(--primary)';
                } else {
                    el.style.background = 'transparent';
                    el.style.borderColor = 'var(--border)';
                }
            });

            // Save to DB if logged in
            @auth
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
            @endauth

            showToast(`Tema berhasil diubah! ✨`, 'success');
        }

        // Highlight currently active theme
        document.addEventListener('DOMContentLoaded', function() {
            const current = localStorage.getItem('alzis_theme') || @json(Auth::check() ? (Auth::user()->theme_preference ?? 'default') : 'default');
            document.querySelectorAll('.theme-option-btn, .theme-card-picker').forEach(el => {
                const val = el.getAttribute('data-theme-val');
                if (val === current) {
                    el.style.background = 'rgba(255, 255, 255, 0.1)';
                    el.style.borderColor = 'var(--primary)';
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
