@extends('layouts.app')

@section('title', 'Cara Beli & Garansi - ALzis STURR')

@section('content')
<div class="container" style="padding: 36px 20px 80px; max-width: 900px;">
    <div style="margin-bottom: 32px;">
        <h1 class="font-heading" style="font-size: 2rem; color: #fff; font-weight: 800; margin-bottom: 6px;">
            Cara Transaksi & Garansi Akun
        </h1>
        <p style="color: var(--text-muted); font-size: 0.95rem;">
            Pelajari 4 langkah mudah membeli akun game impian Anda di ALzis STURR dengan garansi 100% Anti Hackback.
        </p>
    </div>

    <!-- 4 Steps Timeline Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 36px;">
        <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 20px;">
            <div style="font-size: 1.5rem; font-weight: 800; color: var(--primary); font-family: var(--font-heading); margin-bottom: 8px;">01</div>
            <h4 style="font-size: 0.95rem; font-weight: 700; color: #fff; margin-bottom: 6px;">Pilih Akun</h4>
            <p style="font-size: 0.82rem; color: var(--text-muted); line-height: 1.5;">Cari akun game sesuai spesifikasi & budget Anda di katalog kami.</p>
        </div>

        <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 20px;">
            <div style="font-size: 1.5rem; font-weight: 800; color: var(--accent-blue); font-family: var(--font-heading); margin-bottom: 8px;">02</div>
            <h4 style="font-size: 0.95rem; font-weight: 700; color: #fff; margin-bottom: 6px;">Hubungi Admin</h4>
            <p style="font-size: 0.82rem; color: var(--text-muted); line-height: 1.5;">Klik 'Beli via WhatsApp' atau buka Ticket Discord untuk konfirmasi stok.</p>
        </div>

        <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 20px;">
            <div style="font-size: 1.5rem; font-weight: 800; color: var(--gold); font-family: var(--font-heading); margin-bottom: 8px;">03</div>
            <h4 style="font-size: 0.95rem; font-weight: 700; color: #fff; margin-bottom: 6px;">Pembayaran</h4>
            <p style="font-size: 0.82rem; color: var(--text-muted); line-height: 1.5;">Lakukan transfer ke rekening/QRIS/E-Wallet resmi yang diberikan admin.</p>
        </div>

        <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 20px;">
            <div style="font-size: 1.5rem; font-weight: 800; color: #34d399; font-family: var(--font-heading); margin-bottom: 8px;">04</div>
            <h4 style="font-size: 0.95rem; font-weight: 700; color: #fff; margin-bottom: 6px;">Serah Terima</h4>
            <p style="font-size: 0.82rem; color: var(--text-muted); line-height: 1.5;">Admin menyerahkan data login, memandu ganti email, dan aktifkan garansi.</p>
        </div>
    </div>

    <!-- Guarantee Box -->
    <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 28px; margin-bottom: 32px;">
        <h3 style="font-size: 1.2rem; font-weight: 700; color: #fff; margin-bottom: 14px; display: flex; align-items: center; gap: 8px;">
            <i data-lucide="shield-check" style="width: 20px; height: 20px; color: var(--primary);"></i>
            <span>Ketentuan & Jaminan Garansi ALzis STURR</span>
        </h3>
        <div style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.8; white-space: pre-line;">
            {{ $rulesText ?: "1. Akun yang dibeli dijamin 100% legal dan bersumber dari tangan pertama atau pemilik asli.\n2. Pembeli wajib mengikuti panduan pengamanan akun yang diarahkan oleh admin saat serah terima di Discord Ticket atau WhatsApp.\n3. Garansi Anti Hackback berlaku seumur hidup selama pembeli tidak meminjamkan data akun ke pihak ketiga atau menggunakan cheat/program ilegal.\n4. Pembayaran hanya sah ke rekening resmi yang diberikan langsung oleh Admin ALzis STURR." }}
        </div>
    </div>

    <!-- Contact Banner -->
    <div style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 24px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
        <div>
            <h4 style="font-size: 1.1rem; font-weight: 700; color: #fff;">Ada Pertanyaan Sebelum Membeli?</h4>
            <p style="color: var(--text-muted); font-size: 0.85rem; margin-top: 2px;">Admin siap melayani tanya jawab spesifikasi akun 24 jam.</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\SiteSetting::get('whatsapp_number', '6282324634848')) }}" target="_blank" class="btn btn-primary btn-sm" style="background: #25D366; border-color: #25D366; color: #fff;">
                <i data-lucide="message-circle" style="width: 15px; height: 15px;"></i>
                <span>Chat WhatsApp</span>
            </a>
            <a href="{{ $discordUrl }}" target="_blank" class="btn btn-discord btn-sm">
                <i data-lucide="message-square" style="width: 15px; height: 15px;"></i>
                <span>Discord</span>
            </a>
        </div>
    </div>
</div>
@endsection
