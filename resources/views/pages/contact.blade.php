@extends('layouts.app')

@section('title', 'Kontak Resmi & Bantuan - ALZIS STORE')
@section('meta_description', 'Kontak resmi WhatsApp, Discord Server, dan Instagram ALZIS STORE. Hindari penipuan dengan hanya bertransaksi via channel resmi.')

@section('content')
<div class="container" style="padding: 36px 18px 80px; max-width: 960px;">
    <div style="margin-bottom: 36px; text-align: center;">
        <span style="font-size: 0.72rem; font-weight: 800; color: var(--primary); text-transform: uppercase; letter-spacing: 0.8px;">LAYANAN PELANGGAN</span>
        <h1 class="font-heading" style="font-size: 2.1rem; color: #fff; font-weight: 900; margin-top: 4px; margin-bottom: 8px;">
            Kontak Resmi & Layanan Bantuan
        </h1>
        <p style="color: var(--text-muted); font-size: 0.95rem; max-width: 620px; margin: 0 auto;">
            Pastikan Anda hanya bertransaksi melalui saluran resmi kami di bawah ini untuk keamanan transaksi Anda.
        </p>
    </div>

    <!-- Official Contacts Cards Grid -->
    <div class="contact-cards-grid">
        <!-- WhatsApp Card -->
        <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-xl); padding: 26px; display: flex; flex-direction: column; transition: transform 0.2s ease;">
            <div style="width: 48px; height: 48px; border-radius: var(--radius-md); background: rgba(37, 211, 102, 0.14); color: #25D366; display: flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                <svg style="width: 26px; height: 26px; fill: currentColor;" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
            </div>
            <h3 style="font-size: 1.15rem; font-weight: 800; color: #fff; margin-bottom: 4px;">WhatsApp Official</h3>
            <p style="color: var(--text-muted); font-size: 0.85rem; line-height: 1.5; margin-bottom: 14px;">
                Fast response 24/7 untuk pembelian langsung, tanya spesifikasi & klaim garansi.
            </p>
            <div style="font-size: 0.92rem; font-weight: 800; color: #25D366; margin-bottom: 20px; display: flex; align-items: center; gap: 6px;">
                <span style="width: 8px; height: 8px; border-radius: 50%; background: #25D366; display: inline-block;"></span>
                <span>Customer Care 24/7 Terverifikasi</span>
            </div>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\SiteSetting::get('whatsapp_number', '6282324634848')) }}" target="_blank" class="btn btn-whatsapp" style="margin-top: auto; width: 100%;">
                <span>Chat Admin WhatsApp</span>
            </a>
        </div>

        <!-- Discord Card -->
        <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-xl); padding: 26px; display: flex; flex-direction: column; transition: transform 0.2s ease;">
            <div style="width: 48px; height: 48px; border-radius: var(--radius-md); background: rgba(88, 101, 242, 0.14); color: #5865F2; display: flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                <svg style="width: 26px; height: 26px; fill: currentColor;" viewBox="0 0 24 24"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515.074.074 0 0 0-.079.037c-.21.375-.444.864-.608 1.25a18.27 18.27 0 0 0-5.487 0 12.64 12.64 0 0 0-.617-1.25.077.077 0 0 0-.079-.037A19.736 19.736 0 0 0 3.677 4.37a.07.07 0 0 0-.032.027C.533 9.046-.32 13.58.099 18.057a.082.082 0 0 0 .031.057 19.9 19.9 0 0 0 5.993 3.03.078.078 0 0 0 .084-.028c.462-.63.874-1.295 1.226-1.994.021-.041.001-.09-.041-.106a13.107 13.107 0 0 1-1.872-.892.077.077 0 0 1-.008-.128 10.2 10.2 0 0 0 .372-.292.074.074 0 0 1 .077-.01c3.929 1.793 8.18 1.793 12.061 0a.074.074 0 0 1 .078.01c.12.098.246.198.373.292a.077.077 0 0 1-.006.127 12.299 12.299 0 0 1-1.873.893.077.077 0 0 0-.041.107c.36.698.772 1.362 1.225 1.993a.076.076 0 0 0 .084.028 19.839 19.839 0 0 0 6.002-3.03.077.077 0 0 0 .032-.054c.5-5.177-.838-9.674-3.549-13.66a.061.061 0 0 0-.031-.028zM8.02 15.33c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.956-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.956 2.418-2.157 2.418zm7.975 0c-1.183 0-2.157-1.085-2.157-2.419 0-1.333.955-2.419 2.157-2.419 1.21 0 2.176 1.096 2.157 2.42 0 1.333-.946 2.418-2.157 2.418z"/></svg>
            </div>
            <h3 style="font-size: 1.15rem; font-weight: 800; color: #fff; margin-bottom: 4px;">Discord Community</h3>
            <p style="color: var(--text-muted); font-size: 0.85rem; line-height: 1.5; margin-bottom: 14px;">
                Buka Ticket transaksi privat bersama admin, diskusi grup & info event giveaway.
            </p>
            <div style="font-size: 0.92rem; font-weight: 800; color: #5865F2; margin-bottom: 20px; display: flex; align-items: center; gap: 6px;">
                <span style="width: 8px; height: 8px; border-radius: 50%; background: #5865F2; display: inline-block;"></span>
                <span>Official Discord Server & Ticket</span>
            </div>
            <a href="{{ $discordUrl }}" target="_blank" class="btn btn-discord" style="margin-top: auto; width: 100%;">
                <span>Join Discord Server</span>
            </a>
        </div>

        <!-- Instagram Card -->
        <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-xl); padding: 26px; display: flex; flex-direction: column; transition: transform 0.2s ease;">
            <div style="width: 48px; height: 48px; border-radius: var(--radius-md); background: rgba(244, 63, 94, 0.14); color: #f43f5e; display: flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                <svg style="width: 26px; height: 26px; fill: currentColor;" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
            </div>
            <h3 style="font-size: 1.15rem; font-weight: 800; color: #fff; margin-bottom: 4px;">Instagram Official</h3>
            <p style="color: var(--text-muted); font-size: 0.85rem; line-height: 1.5; margin-bottom: 14px;">
                Cek ribuan bukti testimoni pembeli, update flash sale & giveaway berkala.
            </p>
            <div style="font-size: 0.92rem; font-weight: 800; color: #f43f5e; margin-bottom: 20px; display: flex; align-items: center; gap: 6px;">
                <span style="width: 8px; height: 8px; border-radius: 50%; background: #f43f5e; display: inline-block;"></span>
                <span>Official Social Media Account</span>
            </div>
            <a href="https://instagram.com/{{ $igUsername }}" target="_blank" class="btn btn-instagram" style="margin-top: auto; width: 100%;">
                <span>Kunjungi Instagram</span>
            </a>
        </div>
    </div>

    <!-- Security Warning Alert -->
    <div style="background: rgba(244, 63, 94, 0.08); border: 1px solid rgba(244, 63, 94, 0.3); border-radius: var(--radius-lg); padding: 22px 24px; color: #fca5a5; font-size: 0.9rem; line-height: 1.65;">
        <div style="font-weight: 800; font-size: 1rem; color: #fb7185; margin-bottom: 6px; display: flex; align-items: center; gap: 8px;">
            <svg style="width: 20px; height: 20px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            <span>Himbauan Penting Keamanan Pembeli:</span>
        </div>
        Admin ALZIS STORE <strong>TIDAK PERNAH</strong> mengirim pesan direct message liar atau meminta password email pribadi Anda di luar tiket resmi. Selalu periksa nomor WhatsApp dan server Discord resmi sebelum mengirim pembayaran.
    </div>
</div>
@endsection
