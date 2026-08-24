<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\GameCategory;
use App\Models\GameAccount;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $capcutCat = GameCategory::firstOrCreate(
            ['slug' => 'capcut-pro'],
            ['name' => 'CapCut Pro', 'description' => 'Akun CapCut Pro 1 Bulan & 1 Tahun', 'is_active' => true, 'order' => 7]
        );

        $spotifyCat = GameCategory::firstOrCreate(
            ['slug' => 'spotify-premium'],
            ['name' => 'Spotify Premium', 'description' => 'Spotify Premium Individual & Family Plan', 'is_active' => true, 'order' => 8]
        );

        $ftCat = GameCategory::firstOrCreate(
            ['slug' => 'fast-tournament-ft'],
            ['name' => 'Fast Tournament & Poster FT', 'description' => 'Slot Turnamen & Poster FT', 'is_active' => true, 'order' => 11]
        );

        // 1. Sample CapCut Pro
        GameAccount::firstOrCreate(
            ['code' => 'AZS-CAPCUT-01'],
            [
                'game_category_id' => $capcutCat->id,
                'title' => 'Akun CapCut Pro 1 Tahun Private Email Sendiri (Garansi Full)',
                'price' => 50000,
                'discount_price' => 35000,
                'login_bind' => 'Email Pembeli / Akun Private',
                'server' => 'Global / Indonesia',
                'status' => 'available',
                'thumbnail' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=800&q=80',
                'short_description' => 'CapCut Pro Resmi 1 Tahun tanpa watermark, full fitur pro, export 4K 60FPS.',
                'full_specs' => "• Masa Aktif: 1 Tahun (365 Hari)\n• Tipe Akun: Private (Bisa pakai email sendiri) / Sharing Hemat\n• Fitur: Unlock Semua Template Pro, Effect & Transition Eksklusif, Auto Subtitle, No Watermark, Render 4K 60FPS\n• Support Device: Android, iOS, Windows, & Mac\n• Garansi: Garansi Resmi Full 1 Tahun Ganti Baru jika ada kendala.",
                'is_verified' => true,
                'is_featured' => true,
                'views_count' => 120,
            ]
        );

        // 2. Sample Spotify Premium
        GameAccount::firstOrCreate(
            ['code' => 'AZS-SPOTIFY-01'],
            [
                'game_category_id' => $spotifyCat->id,
                'title' => 'Spotify Premium Individual 3 Bulan (Anti Drop & Bebas Iklan)',
                'price' => 45000,
                'discount_price' => 29000,
                'login_bind' => 'Email Pembeli / Akun Baru',
                'server' => 'Region Indonesia',
                'status' => 'available',
                'thumbnail' => 'https://images.unsplash.com/photo-1614680376593-902f749f7ffc?auto=format&fit=crop&w=800&q=80',
                'short_description' => 'Dengarkan jutaan lagu tanpa jeda iklan, download offline, audio kualitas tinggi.',
                'full_specs' => "• Durasi: 3 Bulan Full\n• Status: Premium Individual / Plan Resmi Legal\n• Fitur: Unlimited Skip, Download Lagu Offline, Audio Ekstra Jernih (320kbps), Bebas Iklan\n• Garansi: Anti Drop, Replace Akun Cepat jika terjadi kendala.",
                'is_verified' => true,
                'is_featured' => true,
                'views_count' => 98,
            ]
        );

        // 3. Sample Fast Tournament Poster
        GameAccount::firstOrCreate(
            ['code' => 'AZS-FT-01'],
            [
                'game_category_id' => $ftCat->id,
                'title' => 'Jasa Desain Poster Fast Tournament (FT) MLBB / FF + Format Bracket Siap Cetak',
                'price' => 60000,
                'discount_price' => 45000,
                'login_bind' => 'File HD (PNG, JPG, PDF, & File Mentahan)',
                'server' => 'Online Delivery (WA / Discord)',
                'status' => 'available',
                'thumbnail' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=800&q=80',
                'short_description' => 'Desain poster turnamen keren, modern, estetik, siap posting sosmed & broadcast WA.',
                'full_specs' => "• Pengerjaan: Kilat 1-3 Jam Selesai\n• Termasuk: Poster Utama, Format Bagan/Bracket Turnamen, Slot List Peserta\n• Revisi: Bebas Revisi Ringan 3x sampai pas\n• Format File: JPG/PNG Kualitas HD Tanpa Pecah + File Source Canva/PSD jika diminta.",
                'is_verified' => true,
                'is_featured' => true,
                'views_count' => 150,
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        GameAccount::whereIn('code', ['AZS-CAPCUT-01', 'AZS-SPOTIFY-01', 'AZS-FT-01'])->delete();
    }
};
