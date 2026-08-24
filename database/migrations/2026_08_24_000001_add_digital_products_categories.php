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
                'name' => 'Alight Motion Pro',
                'slug' => 'alight-motion-pro',
                'description' => 'Akun Alight Motion Pro 1 Tahun / 1 Bulan Full Fitur & Preset.',
                'is_active' => true,
                'order' => 8,
            ],
            [
                'name' => 'Spotify Premium',
                'slug' => 'spotify-premium',
                'description' => 'Spotify Premium Individual & Family Plan Legal No Drop.',
                'is_active' => true,
                'order' => 9,
            ],
            [
                'name' => 'Canva Pro',
                'slug' => 'canva-pro',
                'description' => 'Akun Canva Pro Edu & Lifetime Garansi.',
                'is_active' => true,
                'order' => 10,
            ],
            [
                'name' => 'Fast Tournament (FT)',
                'slug' => 'fast-tournament-ft',
                'description' => 'Slot Fast Tournament (FT) MLBB, Free Fire, & PUBGM.',
                'is_active' => true,
                'order' => 11,
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
        GameCategory::whereIn('slug', ['capcut-pro', 'alight-motion-pro', 'spotify-premium', 'canva-pro', 'fast-tournament-ft'])->delete();
    }
};
