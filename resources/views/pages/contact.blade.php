@extends('layouts.app')

@section('title', 'Hubungi Kami - ALzis STURR')

@section('content')
<div class="container" style="padding: 36px 20px 80px; max-width: 900px;">
    <div style="margin-bottom: 32px;">
        <h1 class="font-heading" style="font-size: 2rem; color: #fff; font-weight: 800; margin-bottom: 6px;">
            Kontak & Layanan Bantuan
        </h1>
        <p style="color: var(--text-muted); font-size: 0.95rem;">
            Hati-hati terhadap penipuan yang mengatasnamakan ALzis STURR. Kami hanya melayani transaksi lewat kontak resmi berikut:
        </p>
    </div>

    <!-- Official Contacts Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px; margin-bottom: 32px;">
        <!-- WhatsApp -->
        <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 24px;">
            <div style="width: 44px; height: 44px; border-radius: var(--radius-sm); background: rgba(37, 211, 102, 0.12); color: #25D366; display: flex; align-items: center; justify-content: center; margin-bottom: 14px;">
                <i data-lucide="message-circle" style="width: 24px; height: 24px;"></i>
            </div>
            <h3 style="font-size: 1.05rem; font-weight: 700; color: #fff; margin-bottom: 4px;">WhatsApp Resmi</h3>
            <p style="color: var(--text-muted); font-size: 0.82rem; margin-bottom: 12px;">Fast respond 24 jam untuk pembelian langsung, tanya spek & transaksi kilat.</p>
            <div style="font-size: 1.1rem; font-weight: 800; color: #25D366; margin-bottom: 16px;">
                +62 823-2463-4848
            </div>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\SiteSetting::get('whatsapp_number', '6282324634848')) }}" target="_blank" class="btn btn-primary btn-sm" style="background: #25D366; border-color: #25D366; color: #fff; width: 100%;">
                <span>Chat WhatsApp</span>
            </a>
        </div>

        <!-- Discord -->
        <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 24px;">
            <div style="width: 44px; height: 44px; border-radius: var(--radius-sm); background: rgba(88, 101, 242, 0.12); color: #5865F2; display: flex; align-items: center; justify-content: center; margin-bottom: 14px;">
                <i data-lucide="message-square" style="width: 24px; height: 24px;"></i>
            </div>
            <h3 style="font-size: 1.05rem; font-weight: 700; color: #fff; margin-bottom: 4px;">Discord Server</h3>
            <p style="color: var(--text-muted); font-size: 0.82rem; margin-bottom: 12px;">Buka Ticket transaksi privat bersama admin, gabung komunitas & klaim garansi.</p>
            <div style="font-size: 1.1rem; font-weight: 800; color: #5865F2; margin-bottom: 16px;">
                Discord Community
            </div>
            <a href="{{ $discordUrl }}" target="_blank" class="btn btn-discord btn-sm" style="width: 100%;">
                <span>Join Discord Server</span>
            </a>
        </div>

        <!-- Instagram -->
        <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 24px;">
            <div style="width: 44px; height: 44px; border-radius: var(--radius-sm); background: rgba(244, 63, 94, 0.12); color: #f43f5e; display: flex; align-items: center; justify-content: center; margin-bottom: 14px;">
                <i data-lucide="instagram" style="width: 24px; height: 24px;"></i>
            </div>
            <h3 style="font-size: 1.05rem; font-weight: 700; color: #fff; margin-bottom: 4px;">Instagram Resmi</h3>
            <p style="color: var(--text-muted); font-size: 0.82rem; margin-bottom: 12px;">Info promo flash sale, bukti testimoni kepuasan pembeli & giveaway.</p>
            <div style="font-size: 1.1rem; font-weight: 800; color: #f43f5e; margin-bottom: 16px;">
                &#64;{{ $igUsername }}
            </div>
            <a href="https://instagram.com/{{ $igUsername }}" target="_blank" class="btn btn-instagram btn-sm" style="width: 100%;">
                <span>Kunjungi Instagram</span>
            </a>
        </div>
    </div>

    <!-- Security Warning -->
    <div style="background: rgba(244, 63, 94, 0.08); border: 1px solid rgba(244, 63, 94, 0.25); border-radius: var(--radius-md); padding: 18px 20px; color: #fca5a5; font-size: 0.88rem; line-height: 1.6;">
        ⚠️ <strong>Himbauan Keamanan:</strong> Admin ALzis STURR tidak pernah menghubungi pembeli lewat akun kloningan / direct message liar. Selalu verifikasi username dan pastikan Anda bertransaksi di nomor WhatsApp atau Discord resmi kami.
    </div>
</div>
@endsection
