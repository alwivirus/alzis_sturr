<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index()
    {
        $settings = [
            'site_name' => SiteSetting::get('site_name', 'ALzis STURR'),
            'site_tagline' => SiteSetting::get('site_tagline', 'Jual Beli & Japost Akun Game Terpercaya #1 di Indonesia'),
            'discord_invite_url' => SiteSetting::get('discord_invite_url', 'https://discord.gg/alzis-sturr'),
            'instagram_username' => SiteSetting::get('instagram_username', 'alzis_sturr'),
            'tiktok_username' => SiteSetting::get('tiktok_username', 'emu_velz'),
            'banner_announcement' => SiteSetting::get('banner_announcement', '🔥 PROMO SPESIAL AKHIR BULAN! Akun MLBB, FF, Genshin & HOK Diskon s/d 30%. Transaksi Cepat & 100% Anti Hackback via Discord Server!'),
            'guarantee_text' => SiteSetting::get('guarantee_text', 'Garansi 100% Aman | Anti Hackback | Legal & Bersih | Fast Respond 24 Jam via Discord'),
            'rules_text' => SiteSetting::get('rules_text', "1. Pilih akun yang ingin dibeli lalu klik 'Order via Discord' atau hubungi Instagram / TikTok kami.\n2. Buka Ticket Transaksi di Discord Server ALzis STURR.\n3. Admin ALzis STURR akan memberikan detail pembayaran resmi.\n4. Lakukan pembayaran dan kirimkan bukti transfer di Ticket Discord.\n5. Admin memproses serah terima data akun (email/password/bind) sampai selesai dan terverifikasi aman."),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'discord_invite_url' => 'required|url|max:255',
            'instagram_username' => 'required|string|max:100',
            'tiktok_username' => 'nullable|string|max:100',
            'banner_announcement' => 'nullable|string',
            'guarantee_text' => 'nullable|string',
            'rules_text' => 'nullable|string',
        ]);

        foreach ($validated as $key => $value) {
            SiteSetting::set($key, $value);
        }

        return back()->with('success', 'Pengaturan website & kontak berhasil disimpan!');
    }
}
