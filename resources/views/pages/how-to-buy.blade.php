@extends('layouts.app')

@section('title', 'Cara Transaksi & Garansi Akun - ALZIS STORE')
@section('meta_description', 'Pelajari alur transaksi pembelian akun game dan jaminan garansi 100% Anti Hackback seumur hidup di ALZIS STORE.')

@section('content')
<div class="container" style="padding: 36px 18px 80px; max-width: 960px;">
    <div style="margin-bottom: 36px; text-align: center;">
        <span style="font-size: 0.72rem; font-weight: 800; color: var(--primary); text-transform: uppercase; letter-spacing: 0.8px;">PANDUAN PEMBELIAN</span>
        <h1 class="font-heading" style="font-size: 2.1rem; color: #fff; font-weight: 900; margin-top: 4px; margin-bottom: 8px;">
            Cara Transaksi & Ketentuan Garansi
        </h1>
        <p style="color: var(--text-muted); font-size: 0.95rem; max-width: 620px; margin: 0 auto;">
            4 Langkah mudah memiliki akun game impian Anda di ALZIS STORE dengan perlindungan 100% Garansi Anti Hackback seumur hidup.
        </p>
    </div>

    <!-- 4 Steps Timeline Cards -->
    <div class="steps-cards-grid">
        <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 24px; position: relative; overflow: hidden;">
            <div style="font-size: 1.8rem; font-weight: 900; color: var(--primary); font-family: var(--font-heading); margin-bottom: 10px;">01</div>
            <h4 style="font-size: 1.05rem; font-weight: 800; color: #fff; margin-bottom: 6px;">Pilih Akun</h4>
            <p style="font-size: 0.84rem; color: var(--text-muted); line-height: 1.55;">Pilih akun game yang Anda inginkan di katalog kami sesuai spesifikasi & budget.</p>
        </div>

        <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 24px; position: relative; overflow: hidden;">
            <div style="font-size: 1.8rem; font-weight: 900; color: var(--accent-purple); font-family: var(--font-heading); margin-bottom: 10px;">02</div>
            <h4 style="font-size: 1.05rem; font-weight: 800; color: #fff; margin-bottom: 6px;">Konfirmasi Admin</h4>
            <p style="font-size: 0.84rem; color: var(--text-muted); line-height: 1.55;">Klik tombol "Beli via WhatsApp" atau buka "Ticket Discord" untuk verifikasi ketersediaan.</p>
        </div>

        <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 24px; position: relative; overflow: hidden;">
            <div style="font-size: 1.8rem; font-weight: 900; color: var(--gold); font-family: var(--font-heading); margin-bottom: 10px;">03</div>
            <h4 style="font-size: 1.05rem; font-weight: 800; color: #fff; margin-bottom: 6px;">Pembayaran Resmi</h4>
            <p style="font-size: 0.84rem; color: var(--text-muted); line-height: 1.55;">Lakukan transfer ke rekening/QRIS/E-Wallet resmi yang diberikan admin.</p>
        </div>

        <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 24px; position: relative; overflow: hidden;">
            <div style="font-size: 1.8rem; font-weight: 900; color: var(--success); font-family: var(--font-heading); margin-bottom: 10px;">04</div>
            <h4 style="font-size: 1.05rem; font-weight: 800; color: #fff; margin-bottom: 6px;">Serah Terima 5 Mnt</h4>
            <p style="font-size: 0.84rem; color: var(--text-muted); line-height: 1.55;">Admin memandu pemindahan email sampai tuntas dan memberikan garansi resmi.</p>
        </div>
    </div>

    <!-- Guarantee Box -->
    <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-xl); padding: 30px; margin-bottom: 32px; box-shadow: var(--shadow-card);">
        <h3 style="font-size: 1.25rem; font-weight: 800; color: #fff; margin-bottom: 14px; display: flex; align-items: center; gap: 8px;">
            <svg style="width: 22px; height: 22px; color: var(--primary);" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
            <span>Ketentuan & Jaminan Garansi ALZIS STORE</span>
        </h3>
        <div style="color: var(--text-muted); font-size: 0.92rem; line-height: 1.8; white-space: pre-line; background: var(--bg-surface); padding: 20px; border-radius: var(--radius-md); border: 1px solid var(--border);">
            {{ $rulesText ?: "1. Semua akun yang dijual di ALZIS STORE telah melalui audit verifikasi data menyeluruh dan dijamin 100% legal serta berasal dari tangan pertama.\n2. Pembeli wajib mengikuti panduan pengamanan dan penggantian data yang diarahkan oleh Admin saat proses serah terima via WhatsApp atau Discord Ticket.\n3. Garansi Anti Hackback berlaku seumur hidup selama pembeli tidak membagikan data akun ke pihak lain atau menggunakan aplikasi ilegal/cheat.\n4. Segala transaksi sah hanya dilakukan melalui nomor WhatsApp dan Ticket Discord resmi kami." }}
        </div>
    </div>

    <!-- Contact CTA Banner -->
    <div style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius-xl); padding: 28px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px;">
        <div>
            <h4 style="font-size: 1.15rem; font-weight: 800; color: #fff;">Butuh Bantuan atau Ingin Request Akun?</h4>
            <p style="color: var(--text-muted); font-size: 0.88rem; margin-top: 4px;">Admin siap melayani konsultasi spesifikasi dan request akun game 24 jam nonstop.</p>
        </div>
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\SiteSetting::get('whatsapp_number', '6282324634848')) }}" target="_blank" class="btn btn-whatsapp btn-sm">
                <span>Chat WhatsApp Admin</span>
            </a>
            <a href="{{ $discordUrl }}" target="_blank" class="btn btn-discord btn-sm">
                <span>Join Discord Server</span>
            </a>
        </div>
    </div>
</div>
@endsection
