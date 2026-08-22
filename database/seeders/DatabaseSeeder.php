<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\GameCategory;
use App\Models\GameAccount;
use App\Models\AccountImage;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin & Demo User
        $admin = User::updateOrCreate(
            ['email' => 'admin@alzis.com'],
            [
                'name' => 'Admin ALzis STURR',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'phone' => '082324634848',
                'avatar' => null,
            ]
        );

        $demoUser = User::updateOrCreate(
            ['email' => 'user@alzis.com'],
            [
                'name' => 'Gamer Sultan',
                'password' => Hash::make('user123'),
                'role' => 'user',
                'phone' => '081234567890',
                'avatar' => null,
            ]
        );

        // 2. Create Site Settings
        $settings = [
            'site_name' => 'ALzis STURR',
            'site_tagline' => 'Jual Beli & Japost Akun Game Terpercaya #1 di Indonesia',
            'discord_invite_url' => 'https://discord.gg/alzis-sturr',
            'instagram_username' => 'alzis_sturr',
            'tiktok_username' => 'emu_velz',
            'banner_announcement' => '🔥 PROMO SPESIAL AKHIR BULAN! Akun MLBB, FF, Genshin & HOK Diskon s/d 30%. Transaksi Cepat & 100% Anti Hackback via Discord Server!',
            'guarantee_text' => 'Garansi 100% Aman | Anti Hackback | Legal & Bersih | Fast Respond 24 Jam via Discord Ticket',
            'rules_text' => "1. Pilih akun yang ingin dibeli lalu klik 'Order via Discord' atau hubungi Instagram / TikTok kami.\n2. Buka Ticket Transaksi di Discord Server ALzis STURR.\n3. Admin ALzis STURR akan memberikan detail pembayaran resmi.\n4. Lakukan pembayaran dan kirimkan bukti transfer di Ticket Discord.\n5. Admin memproses serah terima data akun (email/password/bind) sampai selesai dan terverifikasi aman.",
        ];

        foreach ($settings as $key => $val) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $val]);
        }

        // 3. Create Game Categories
        $categoriesData = [
            [
                'name' => 'Mobile Legends: Bang Bang',
                'slug' => 'mobile-legends',
                'icon' => 'mlbb-icon.png',
                'banner' => 'mlbb-banner.jpg',
                'description' => 'Akun MLBB Mythical Glory, Collector, KOF, Legend, Aspirants, All Unbind.',
                'order' => 1,
            ],
            [
                'name' => 'Free Fire',
                'slug' => 'free-fire',
                'icon' => 'ff-icon.png',
                'banner' => 'ff-banner.jpg',
                'description' => 'Akun FF Old, SG 2 OPM, Megalodon, Bundle Season 1/2, Akun Polosan & Sultan.',
                'order' => 2,
            ],
            [
                'name' => 'Genshin Impact',
                'slug' => 'genshin-impact',
                'icon' => 'genshin-icon.png',
                'banner' => 'genshin-banner.jpg',
                'description' => 'Akun Genshin AR 55-60, C6 R5 Sultan, Well-Built, Primogems Melimpah Server Asia.',
                'order' => 3,
            ],
            [
                'name' => 'PUBG Mobile',
                'slug' => 'pubg-mobile',
                'icon' => 'pubg-icon.png',
                'banner' => 'pubg-banner.jpg',
                'description' => 'Akun PUBGM M416 Glacier Max, X-Suit Bintang 6, Title Conqueror Server Indo.',
                'order' => 4,
            ],
            [
                'name' => 'Honor of Kings',
                'slug' => 'honor-of-kings',
                'icon' => 'hok-icon.png',
                'banner' => 'hok-banner.jpg',
                'description' => 'Akun HOK Grandmaster, Skin Epic & Legend, Hero Komplit, Bind Aman.',
                'order' => 5,
            ],
            [
                'name' => 'Valorant',
                'slug' => 'valorant',
                'icon' => 'valorant-icon.png',
                'banner' => 'valorant-banner.jpg',
                'description' => 'Akun Valorant Kuronami, Prime, Reaver, Radiant Rank Server AP/Indonesia.',
                'order' => 6,
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $cat) {
            $categories[$cat['slug']] = GameCategory::updateOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
        }

        // 4. Create Sample Game Accounts with rich specs
        $accountsData = [
            [
                'category_slug' => 'mobile-legends',
                'code' => 'AZS-ML-01',
                'title' => 'MLBB Mythical Glory 120★ | 8 Skin Collector + 4 KOF + Aspirants Lesley',
                'price' => 850000,
                'discount_price' => 699000,
                'login_bind' => 'Moonton Sepaket (Email Bersih + All Unbind)',
                'server' => 'Indonesia',
                'status' => 'available',
                'thumbnail' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=800&q=80',
                'short_description' => 'Akun pribadi tangan pertama, full skin mahal siap mabar turney!',
                'full_specs' => "• Rank Saat Ini: Mythical Glory (120 Stars)\n• Total Hero: 124 (Full Hero)\n• Total Skin: 345 Skin\n• Skin Spesial: Collector Chou, Aldous, Gusion, Badang, Granger. KOF Chou, Gusion, Guinevere. Lesley Aspirants.\n• Winrate Total: 69.4% (All Match)\n• Emblem: Max All Level 60\n• Status Bind: Moonton sepaket dengan email Outlook (diberikan full akses), Google Play kosong, FB kosong, VK kosong, TikTok kosong.\n• Garansi: Anti Hackback Seumur Hidup.",
                'hero_count' => 124,
                'skin_count' => 345,
                'rank_tier' => 'Mythical Glory',
                'winrate' => '69.4%',
                'is_verified' => true,
                'is_featured' => true,
                'views_count' => 342,
            ],
            [
                'category_slug' => 'mobile-legends',
                'code' => 'AZS-ML-02',
                'title' => 'MLBB Sultan Legend Gusion & Valir | 500+ Skin | Ex-Immortal',
                'price' => 1500000,
                'discount_price' => 1250000,
                'login_bind' => 'Moonton Kosong (Bisa Bind Email Pembeli)',
                'server' => 'Indonesia',
                'status' => 'available',
                'thumbnail' => 'https://images.unsplash.com/photo-1511512578047-dfb367046420?auto=format&fit=crop&w=800&q=80',
                'short_description' => 'Akun Sultan skin bejibun, 2 Skin Legend & 15 Epic Limited.',
                'full_specs' => "• Rank Tertinggi: Mythical Immortal\n• Total Hero: 126\n• Total Skin: 512 Skin\n• Skin Legend: Gusion Cosmic Gleam, Valir Infernal Lord\n• Skin Collector: 12 Skin\n• Efek Recall: Tas Tas Fire Crown + Seal of Anvil Crawlers (Efek Tas Tas Permanen)\n• Bind: Moonton All Kosong, siap diganti ke email dan nomor pembeli langsung.\n• Garansi: 100% Legal & Safe.",
                'hero_count' => 126,
                'skin_count' => 512,
                'rank_tier' => 'Mythical Immortal',
                'winrate' => '72.1%',
                'is_verified' => true,
                'is_featured' => true,
                'views_count' => 580,
            ],
            [
                'category_slug' => 'free-fire',
                'code' => 'AZS-FF-01',
                'title' => 'FF Akun Old Season 2 | SG 2 OPM + SG Ungu Rapper + Bundle Cobra Max',
                'price' => 450000,
                'discount_price' => 375000,
                'login_bind' => 'Google Play (Siap Take Over)',
                'server' => 'Indonesia',
                'status' => 'available',
                'thumbnail' => 'https://images.unsplash.com/photo-1538481199705-c710c4e965fc?auto=format&fit=crop&w=800&q=80',
                'short_description' => 'Akun FF Old impian para rusher, SG OPM sakit banget!',
                'full_specs' => "• Elite Pass: Season 2 (Hip Hop), Season 4, Season 5, Season 7 on\n• Skin Senjata: SG 2 One Punch Man, SG 2 Rapper Ungu, AK Draco Blue Flame Level Max\n• Bundle: Cobra Rage Max, Arctic Blue, Kakashi Old\n• Level Akun: 73 (Like 25.000+)\n• Login: Akun Google Play bersih no minus, siap serah terima dengan nomor pemulihan baru.\n• Garansi: Aman 100% Anti Hackback.",
                'hero_count' => 48,
                'skin_count' => 280,
                'rank_tier' => 'Master Grandmaster',
                'winrate' => '64.2%',
                'is_verified' => true,
                'is_featured' => true,
                'views_count' => 419,
            ],
            [
                'category_slug' => 'free-fire',
                'code' => 'AZS-FF-02',
                'title' => 'FF Sultan Murah | AK Naga Level 7 + M1014 Naga Hijau + Emote Lobi Lengkap',
                'price' => 300000,
                'discount_price' => 240000,
                'login_bind' => 'Facebook (No Tabrak / Single Login)',
                'server' => 'Indonesia',
                'status' => 'sold',
                'thumbnail' => 'https://images.unsplash.com/photo-1560253023-3ec5d502959f?auto=format&fit=crop&w=800&q=80',
                'short_description' => 'Stok Terjual - Contoh akun sultan japost sukses terkirim!',
                'full_specs' => "• AK Draco Blue Flame Level 7 Max\n• M1014 Green Flame Draco Level 6\n• Emote Lobi Kursi Raja, Emote Bunga, Emote Tepuk Pramuka\n• Vault rame, siap pakai push rank.\n• Status: SUDAH TERJUAL.",
                'hero_count' => 42,
                'skin_count' => 195,
                'rank_tier' => 'Heroic 4★',
                'winrate' => '58.0%',
                'is_verified' => true,
                'is_featured' => false,
                'views_count' => 210,
            ],
            [
                'category_slug' => 'genshin-impact',
                'code' => 'AZS-GI-01',
                'title' => 'Genshin AR 59 Server Asia | Raiden Shogun C2 + Furina C2 + Arlecchino + 15 Sign B5',
                'price' => 1200000,
                'discount_price' => 980000,
                'login_bind' => 'Hoyoverse Username Unset (Email Ganti Pembeli)',
                'server' => 'Asia',
                'status' => 'available',
                'thumbnail' => 'https://images.unsplash.com/photo-1579373903781-fd5c0c30c4cd?auto=format&fit=crop&w=800&q=80',
                'short_description' => 'Akun Genshin end-game super terawat, Abyss 36★ auto rata!',
                'full_specs' => "• Adventure Rank: AR 59 (Server Asia)\n• Karakter B5: Raiden Shogun C2, Furina C2, Arlecchino C1, Neuvillette, Nahida, Zhongli, Kazuha, Yelan, Hu Tao, Xiao\n• Senjata B5: Engulfing Lightning, Splendor of Tranquil Waters, Crimson Moon's Semblance, Tome of the Eternal Flow, Homa\n• Primogems Tabungan: 8.500 Primo + 14 Intertwined Fate\n• Exploration: Fontaine 100%, Natlan 95%, Sumeru 100%\n• Bind: Hoyoverse ID Username Unset, No Birthday Set (Bisa set sendiri), Email bersih siap change email.\n• Garansi: Anti Hackback Seumur Hidup.",
                'hero_count' => 45,
                'skin_count' => 15,
                'rank_tier' => 'AR 59 End-Game',
                'winrate' => 'Abyss 36★',
                'is_verified' => true,
                'is_featured' => true,
                'views_count' => 610,
            ],
            [
                'category_slug' => 'pubg-mobile',
                'code' => 'AZS-PUBG-01',
                'title' => 'PUBGM M416 Glacier Level 7 Max (Loot Crate) + X-Suit Silvanus Bintang 4',
                'price' => 1800000,
                'discount_price' => 1499000,
                'login_bind' => 'Twitter/X + Email Link (Facebook Kosong)',
                'server' => 'Indonesia',
                'status' => 'available',
                'thumbnail' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=800&q=80',
                'short_description' => 'Akun PUBG Sultan M4 Glacier Max peti es + X-Suit mewah.',
                'full_specs' => "• Senjata Upgrade: M416 Glacier Level 7 Max (On Hit Effect + Loot Crate Es), AWM Godzilla Lv 4, UZI Romantis Lv 4\n• X-Suit: Silvanus X-Suit Bintang 4 (Entry Emote)\n• Kendaraan: McLaren P1 Papaya Orange & UAZ Godzilla\n• Title: Conqueror Season C1S3, On a Mission, Weapon Master\n• Login: Single Twitter/X + Email siap dipindahkan ke data pembeli.\n• Garansi: Anti Hackback & 100% Data Aman.",
                'hero_count' => 10,
                'skin_count' => 380,
                'rank_tier' => 'Ace Dominator',
                'winrate' => 'K/D 5.85',
                'is_verified' => true,
                'is_featured' => true,
                'views_count' => 740,
            ],
            [
                'category_slug' => 'honor-of-kings',
                'code' => 'AZS-HOK-01',
                'title' => 'Honor of Kings Grandmaster 50★ | Skin Legend Sun Ce & Li Bai | 95 Hero',
                'price' => 350000,
                'discount_price' => 280000,
                'login_bind' => 'Level Infinite Pass (Email Kosong Siap Ganti)',
                'server' => 'Indonesia / Global',
                'status' => 'available',
                'thumbnail' => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&w=800&q=80',
                'short_description' => 'Akun HOK siap kompetitif, Hero banyak dan skin keren!',
                'full_specs' => "• Rank: Grandmaster 50 Stars\n• Total Hero: 95 Hero Unlocked\n• Total Skin: 110 Skin (Legend Sun Ce, Epic Milady, Mayene, Lam)\n• Arcana: Full Level 5 Semua Role (Fighter, Mage, Marksman, Roam, Assassin)\n• Login: Level Infinite Pass, email khusus serah terima langsung.\n• Garansi: 100% Aman.",
                'hero_count' => 95,
                'skin_count' => 110,
                'rank_tier' => 'Grandmaster 50★',
                'winrate' => '67.8%',
                'is_verified' => true,
                'is_featured' => false,
                'views_count' => 180,
            ],
            [
                'category_slug' => 'valorant',
                'code' => 'AZS-VAL-01',
                'title' => 'Valorant Immortal 2 | Kuronami Vandal + Reaver Karambit + Prime Phantom + 800 VP',
                'price' => 750000,
                'discount_price' => 620000,
                'login_bind' => 'Riot Games Single Login (First Email / First Hand)',
                'server' => 'Asia Pasifik (Indonesia)',
                'status' => 'available',
                'thumbnail' => 'https://images.unsplash.com/photo-1542751110-97427bbecf20?auto=format&fit=crop&w=800&q=80',
                'short_description' => 'Akun Valorant tangan pertama, invoice pembelian pertama lengkap!',
                'full_specs' => "• Current Rank: Immortal 2 (Peak Immortal 3)\n• Skin Vandal: Kuronami Vandal, Araxys Vandal, Prime Vandal\n• Skin Phantom: Recon Phantom, Oni Phantom\n• Melee / Pisau: Reaver Karambit, Ignite Fan (Kipas Imlek Limited), VCT Lock/In Misericórdia\n• Operator: Ion Operator\n• VP Sisa: 850 VP + 140 Radianite Points\n• Data: Email Pertama (First Email) disertakan saat transaksi.\n• Garansi: Anti Hackback 100%.",
                'hero_count' => 24,
                'skin_count' => 45,
                'rank_tier' => 'Immortal 2',
                'winrate' => '59.3%',
                'is_verified' => true,
                'is_featured' => true,
                'views_count' => 495,
            ],
        ];

        foreach ($accountsData as $accData) {
            $catSlug = $accData['category_slug'];
            unset($accData['category_slug']);
            $accData['game_category_id'] = $categories[$catSlug]->id;
            $accData['slug'] = Str::slug($accData['title'] . '-' . $accData['code']);

            $account = GameAccount::updateOrCreate(
                ['code' => $accData['code']],
                $accData
            );

            // Add sample additional screenshots
            AccountImage::updateOrCreate(
                [
                    'game_account_id' => $account->id,
                    'image_path' => $account->thumbnail,
                ],
                [
                    'caption' => 'Tampilan Utama & Lobby',
                    'sort_order' => 0,
                ]
            );

            AccountImage::updateOrCreate(
                [
                    'game_account_id' => $account->id,
                    'image_path' => 'https://images.unsplash.com/photo-1538481199705-c710c4e965fc?auto=format&fit=crop&w=800&q=80',
                ],
                [
                    'caption' => 'Rincian Skin & Koleksi',
                    'sort_order' => 1,
                ]
            );

            AccountImage::updateOrCreate(
                [
                    'game_account_id' => $account->id,
                    'image_path' => 'https://images.unsplash.com/photo-1511512578047-dfb367046420?auto=format&fit=crop&w=800&q=80',
                ],
                [
                    'caption' => 'Status Bind & Profil Akun',
                    'sort_order' => 2,
                ]
            );
        }
    }
}
