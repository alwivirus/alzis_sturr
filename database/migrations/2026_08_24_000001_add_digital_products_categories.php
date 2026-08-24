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
                'name' => 'Akun Premium & Aplikasi',
                'slug' => 'akun-premium',
                'description' => 'Akun Premium CapCut Pro, Canva Pro, Netflix, Spotify, YouTube Premium, ChatGPT, dll.',
                'is_active' => true,
                'order' => 7,
            ],
            [
                'name' => 'Fast Tournament & Poster FT',
                'slug' => 'fast-tournament-ft',
                'description' => 'Slot Turnamen, Desain Poster Fast Tournament (FT), Sertifikat, Bracket & Jasa Turnamen.',
                'is_active' => true,
                'order' => 8,
            ],
            [
                'name' => 'Jasa Desain & Digital',
                'slug' => 'jasa-digital',
                'description' => 'Jasa Desain Logo Esport, Banner Sosmed, Overlay Stream, dan Produk Kreatif Digital.',
                'is_active' => true,
                'order' => 9,
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
