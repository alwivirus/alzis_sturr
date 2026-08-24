<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\GameCategory;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $newCategories = [
            [
                'name' => 'CapCut Pro',
                'slug' => 'capcut-pro',
                'description' => 'Akun CapCut Pro 1 Bulan & 1 Tahun Private / Sharing, Garansi Full.',
                'is_active' => true,
                'order' => 7,
            ],
            [
                'name' => 'Spotify Premium',
                'slug' => 'spotify-premium',
                'description' => 'Spotify Premium Individual & Family Plan Legal No Drop.',
                'is_active' => true,
                'order' => 8,
            ],
            [
                'name' => 'Canva Pro',
                'slug' => 'canva-pro',
                'description' => 'Akun Canva Pro Edu & Lifetime Garansi.',
                'is_active' => true,
                'order' => 9,
            ],
            [
                'name' => 'Netflix & Streaming',
                'slug' => 'netflix-streaming',
                'description' => 'Akun Netflix Premium 4K UHD, Disney+ Hotstar, YouTube Premium, & Vidio.',
                'is_active' => true,
                'order' => 10,
            ],
            [
                'name' => 'Fast Tournament & Poster FT',
                'slug' => 'fast-tournament-ft',
                'description' => 'Slot Turnamen, Desain Poster Fast Tournament (FT), Sertifikat, & Bracket.',
                'is_active' => true,
                'order' => 11,
            ],
            [
                'name' => 'Jasa Desain & Digital',
                'slug' => 'jasa-digital',
                'description' => 'Jasa Desain Logo Esport, Banner Sosmed, Overlay Stream, dan Produk Kreatif Digital.',
                'is_active' => true,
                'order' => 12,
            ],
        ];

        foreach ($newCategories as $cat) {
            GameCategory::firstOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        GameCategory::whereIn('slug', ['akun-premium', 'fast-tournament-ft', 'jasa-digital'])->delete();
    }
};
