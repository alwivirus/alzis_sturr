@extends('layouts.app')

@section('title', 'Cara Beli & Garansi Akun - ALzis STURR')

@section('content')
<div class="container" style="padding: 50px 20px 90px; max-width: 1040px;">
    <!-- Header Banner -->
    <div style="background: linear-gradient(135deg, rgba(14, 22, 38, 0.9) 0%, rgba(9, 13, 22, 0.95) 100%); border: 1px solid rgba(0, 242, 254, 0.18); border-radius: 24px; padding: 36px 32px; text-align: center; margin-bottom: 48px; position: relative; overflow: hidden; box-shadow: 0 16px 40px rgba(0,0,0,0.6);">
        <div style="position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, #00f2fe, #a855f7, transparent);"></div>
        <span style="font-size: 0.82rem; font-weight: 800; color: #00f2fe; text-transform: uppercase; letter-spacing: 1.5px; display: inline-flex; align-items: center; gap: 6px;">
            <i data-lucide="shield-check" style="width: 16px; height: 16px;"></i>
            PANDUAN TRANSAKSI RESMI
        </span>
        <h1 class="font-gaming" style="font-size: 2.8rem; color: #fff; margin-top: 8px; margin-bottom: 12px;">
            CARA BELI & <span class="text-gradient-cyan">GARANSI 100% AMAN</span>
        </h1>
        <p style="color: #94a3b8; font-size: 1.05rem; max-width: 650px; margin: 0 auto; line-height: 1.6;">
            Pelajari 4 langkah mudah bertransaksi akun game sultan di ALzis STURR dengan garansi anti hackback dan panduan langsung oleh admin.
        </p>
    </div>

    <!-- Step by Step Visual Guide -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); gap: 24px; margin-bottom: 50px;">
        <div class="hero-stat-card" style="text-align: left; padding: 28px 24px; border-radius: 20px;">
            <div style="font-family: var(--font-gaming); font-size: 2.8rem; font-weight: 800; color: #00f2fe; line-height: 1; margin-bottom: 12px;">01</div>
            <h4 class="font-gaming" style="font-size: 1.3rem; color: #fff; margin-bottom: 8px;">PILIH AKUN GAME</h4>
            <p style="font-size: 0.88rem; color: #94a3b8; line-height: 1.6;">
                Buka katalog stok kami, cari akun game sesuai budget dan spesifikasi idaman Anda.
            </p>
        </div>

        <div class="hero-stat-card" style="text-align: left; padding: 28px 24px; border-radius: 20px;">
            <div style="font-family: var(--font-gaming); font-size: 2.8rem; font-weight: 800; color: #a855f7; line-height: 1; margin-bottom: 12px;">02</div>
            <h4 class="font-gaming" style="font-size: 1.3rem; color: #fff; margin-bottom: 8px;">CHAT / BUKA TICKET</h4>
            <p style="font-size: 0.88rem; color: #94a3b8; line-height: 1.6;">
                Klik tombol Beli via WhatsApp atau Ticket Discord resmi untuk terhubung langsung dengan Admin.
            </p>
        </div>

        <div class="hero-stat-card" style="text-align: left; padding: 28px 24px; border-radius: 20px;">
            <div style="font-family: var(--font-gaming); font-size: 2.8rem; font-weight: 800; color: #fbbf24; line-height: 1; margin-bottom: 12px;">03</div>
            <h4 class="font-gaming" style="font-size: 1.3rem; color: #fff; margin-bottom: 8px;">TRANSFER PEMBAYARAN</h4>
            <p style="font-size: 0.88rem; color: #94a3b8; line-height: 1.6;">
                Lakukan transfer ke rekening/QRIS/E-Wallet resmi yang diberikan admin dan kirim bukti transfer.
            </p>
        </div>

        <div class="hero-stat-card" style="text-align: left; padding: 28px 24px; border-radius: 20px;">
            <div style="font-family: var(--font-gaming); font-size: 2.8rem; font-weight: 800; color: #34d399; line-height: 1; margin-bottom: 12px;">04</div>
            <h4 class="font-gaming" style="font-size: 1.3rem; color: #fff; margin-bottom: 8px;">SERAH TERIMA & GARANSI</h4>
            <p style="font-size: 0.88rem; color: #94a3b8; line-height: 1.6;">
                Admin menyerahkan data login, memandu ganti bind email/no HP, dan mengaktifkan garansi anti hackback.
            </p>
        </div>
    </div>

    <!-- Guarantee Details -->
    <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 24px; padding: 36px 32px; margin-bottom: 40px; box-shadow: var(--shadow-card);">
        <h3 class="font-gaming" style="font-size: 1.6rem; color: #fff; margin-bottom: 18px; display: flex; align-items: center; gap: 10px;">
            <i data-lucide="shield-check" style="width: 26px; height: 26px; color: var(--primary);"></i>
            KETENTUAN & JAMINAN GARANSI ALZIS STURR
        </h3>

        <div style="color: #cbd5e1; font-size: 0.95rem; line-height: 1.85; white-space: pre-line;">
            {{ $rulesText ?: "1. Akun yang dibeli dijamin 100% legal dan bersumber dari tangan pertama atau pemilik asli.\n2. Pembeli wajib mengikuti panduan pengamanan akun yang diarahkan oleh admin saat serah terima di Discord Ticket atau WhatsApp.\n3. Garansi Anti Hackback berlaku seumur hidup selama pembeli tidak meminjamkan data akun ke pihak ketiga atau menggunakan cheat/program ilegal.\n4. Pembayaran hanya sah ke rekening resmi yang diberikan langsung oleh Admin ALzis STURR." }}
        </div>
    </div>

    <!-- Contacts Card -->
    <div style="background: rgba(15, 23, 42, 0.9); border: 1px solid rgba(0, 242, 254, 0.25); border-radius: 24px; padding: 32px 36px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 24px;">
        <div>
            <h4 class="font-gaming" style="font-size: 1.4rem; color: #fff; margin-bottom: 4px;">Ada Pertanyaan Sebelum Membeli?</h4>
            <p style="color: #94a3b8; font-size: 0.92rem;">Admin siap melayani konsultasi dan tanya spesifikasi akun 24 jam non-stop.</p>
        </div>
        <div style="display: flex; flex-wrap: wrap; gap: 12px;">
            <a href="{{ $discordUrl }}" target="_blank" class="btn btn-discord" style="border-radius: var(--radius-full); padding: 10px 22px;">
                <svg style="width: 18px; height: 18px; fill: currentColor;" viewBox="0 0 24 24"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994.021-.041.001-.09-.041-.106a13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.929 1.793 8.18 1.793 12.061 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.893.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.028zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.956-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.955-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.946 2.418-2.157 2.418z"/></svg>
                <span>Discord Server</span>
            </a>
            <a href="https://instagram.com/{{ $igUsername }}" target="_blank" class="btn btn-instagram" style="border-radius: var(--radius-full); padding: 10px 22px;">
                <svg style="width: 18px; height: 18px; fill: currentColor;" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                <span>Instagram</span>
            </a>
        </div>
    </div>
</div>
@endsection
