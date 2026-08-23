@extends('layouts.admin')

@section('title', 'Pengaturan Toko - ALzis STURR Admin')
@section('page_title', 'PENGATURAN TOKO & KONTAK RESMI')

@section('content')
<div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 32px; max-width: 900px;">
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf

        <h3 class="font-gaming" style="font-size: 1.3rem; color: var(--primary); margin-bottom: 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
            1. IDENTITAS & KONTAK TRANSAKSI UTAMA
        </h3>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label class="form-label">Nama Website / Toko <span style="color: var(--danger);">*</span></label>
                <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name']) }}" class="input-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Tagline Toko</label>
                <input type="text" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline']) }}" class="input-control">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div class="form-group">
                <label class="form-label">Nomor WhatsApp Resmi Transaksi</label>
                <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number'] ?? '6282324634848') }}" class="input-control" placeholder="6282324634848">
                <span class="form-helper">Nomor WA yang otomatis dituju saat pembeli klik tombol 'Beli via WhatsApp'.</span>
            </div>

            <div class="form-group">
                <label class="form-label">Link Invite Discord Server Resmi <span style="color: var(--danger);">*</span></label>
                <input type="url" name="discord_invite_url" value="{{ old('discord_invite_url', $settings['discord_invite_url'] ?? 'https://discord.gg/zEGEGs6hat') }}" class="input-control" placeholder="https://discord.gg/zEGEGs6hat" required>
                <span class="form-helper">Link server / ticket discord untuk transaksi & bantuan.</span>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label class="form-label">Username Instagram Resmi <span style="color: var(--danger);">*</span></label>
                <input type="text" name="instagram_username" value="{{ old('instagram_username', $settings['instagram_username']) }}" class="input-control" placeholder="alzis_sturr" required>
                <span class="form-helper">Tanpa simbol @ (contoh: alzis_sturr)</span>
            </div>

            <div class="form-group">
                <label class="form-label">Username TikTok Resmi</label>
                <input type="text" name="tiktok_username" value="{{ old('tiktok_username', $settings['tiktok_username'] ?? 'emu_velz') }}" class="input-control" placeholder="emu_velz">
                <span class="form-helper">Tanpa simbol @ (contoh: emu_velz)</span>
            </div>
        </div>

        <h3 class="font-gaming" style="font-size: 1.3rem; color: var(--primary); margin: 30px 0 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
            2. BANNER PENGUMUMAN & TEKS INFORMASI
        </h3>

        <div class="form-group">
            <label class="form-label">Teks Ticker Pengumuman / Promo (Header Atas)</label>
            <input type="text" name="banner_announcement" value="{{ old('banner_announcement', $settings['banner_announcement']) }}" class="input-control" placeholder="Teks banner promo berjalan">
        </div>

        <div class="form-group">
            <label class="form-label">Teks Jaminan & Garansi (Footer / Badge)</label>
            <input type="text" name="guarantee_text" value="{{ old('guarantee_text', $settings['guarantee_text']) }}" class="input-control">
        </div>

        <div class="form-group">
            <label class="form-label">Ketentuan Transaksi & Aturan Beli (Halaman Cara Beli)</label>
            <textarea name="rules_text" rows="5" class="input-control">{{ old('rules_text', $settings['rules_text']) }}</textarea>
        </div>

        <div style="padding-top: 20px; border-top: 1px solid var(--border-color);">
            <button type="submit" class="btn btn-primary btn-lg">
                <i data-lucide="save" style="width: 20px; height: 20px;"></i>
                <span>Simpan Pengaturan Toko</span>
            </button>
        </div>
    </form>
</div>
@endsection
