<?php

namespace App\Http\Controllers;

use App\Models\GameCategory;
use App\Models\GameAccount;
use App\Models\Wishlist;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $categories = GameCategory::withCount(['gameAccounts' => function($q) {
            $q->where('status', 'available');
        }])->where('is_active', true)->orderBy('order', 'asc')->get();

        $featuredAccounts = GameAccount::with('category')
            ->where('is_featured', true)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $latestAccounts = GameAccount::with('category')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        $readyAccounts = GameAccount::where('status', 'available')->count();
        $totalAccounts = $readyAccounts + GameAccount::where('status', 'sold')->count();
        $soldAccounts = $totalAccounts - $readyAccounts;

        $bannerAnnouncement = SiteSetting::get('banner_announcement', '🔥 PROMO SPESIAL ALzis STURR! Transaksi Cepat & 100% Anti Hackback via Discord Server.');
        $discordUrl = SiteSetting::get('discord_invite_url', 'https://discord.gg/zEGEGs6hat');
        $igUsername = SiteSetting::get('instagram_username', 'alzis_sturr');
        $tiktokUsername = SiteSetting::get('tiktok_username', 'emu_velz');

        return view('home', compact(
            'categories',
            'featuredAccounts',
            'latestAccounts',
            'totalAccounts',
            'readyAccounts',
            'soldAccounts',
            'bannerAnnouncement',
            'discordUrl',
            'igUsername',
            'tiktokUsername'
        ));
    }

    public function catalog(Request $request)
    {
        $query = GameAccount::with('category');

        // Search Keyword (Title, Code, Description, Specs, Rank, Server, Login Bind, Category)
        if ($request->filled('q')) {
            $search = trim($request->input('q'));
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('full_specs', 'like', "%{$search}%")
                  ->orWhere('rank_tier', 'like', "%{$search}%")
                  ->orWhere('server', 'like', "%{$search}%")
                  ->orWhere('login_bind', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($catQ) use ($search) {
                      $catQ->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter Category (Accepts Slug or ID)
        if ($request->filled('category') && $request->input('category') !== 'all') {
            $cat = $request->input('category');
            $query->where(function ($q) use ($cat) {
                if (is_numeric($cat)) {
                    $q->where('game_category_id', (int) $cat);
                } else {
                    $q->whereHas('category', function ($sub) use ($cat) {
                        $sub->where('slug', $cat);
                    });
                }
            });
        }

        // Filter Status (available, sold, booked)
        if ($request->filled('status') && $request->input('status') !== 'all') {
            $query->where('status', $request->input('status'));
        }

        // Filter Server
        $server = $request->input('server');
        if (!empty($server) && $server !== 'all') {
            $query->where('server', 'like', "%{$server}%");
        }

        // Filter Login Bind
        $bind = $request->input('bind');
        if (!empty($bind) && $bind !== 'all') {
            $query->where('login_bind', 'like', "%{$bind}%");
        }

        // Filter Price Range (Uses effective selling price: COALESCE(discount_price, price))
        if ($request->filled('min_price') && is_numeric($request->input('min_price'))) {
            $min = (float) $request->input('min_price');
            $query->whereRaw('COALESCE(discount_price, price) >= ?', [$min]);
        }
        if ($request->filled('max_price') && is_numeric($request->input('max_price'))) {
            $max = (float) $request->input('max_price');
            $query->whereRaw('COALESCE(discount_price, price) <= ?', [$max]);
        }

        // Filter Discount / Promo Only
        if ($request->boolean('discount_only')) {
            $query->whereNotNull('discount_price')->whereColumn('discount_price', '<', 'price');
        }

        // Sorting
        switch ($request->input('sort', 'newest')) {
            case 'price_asc':
                $query->orderByRaw('COALESCE(discount_price, price) ASC');
                break;
            case 'price_desc':
                $query->orderByRaw('COALESCE(discount_price, price) DESC');
                break;
            case 'popular':
                $query->orderBy('views_count', 'desc');
                break;
            case 'discount':
                $query->orderByRaw('CASE WHEN discount_price IS NOT NULL THEN (price - discount_price) ELSE 0 END DESC');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $accounts = $query->paginate(12)->withQueryString();
        $categories = GameCategory::where('is_active', true)->orderBy('order', 'asc')->get();

        // Get unique servers and binds for filter options
        $availableServers = GameAccount::select('server')->whereNotNull('server')->distinct()->pluck('server');
        $availableBinds = ['Moonton', 'Google Play', 'Facebook', 'Twitter', 'Clean Bind', 'VK', 'Level Infinite', 'Riot Games'];

        return view('catalog', compact('accounts', 'categories', 'availableServers', 'availableBinds'));
    }

    public function show($slug)
    {
        $account = GameAccount::with(['category', 'images'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment view count
        $account->increment('views_count');

        // Related / Recommended accounts
        $relatedAccounts = GameAccount::with('category')
            ->where('id', '!=', $account->id)
            ->where('status', 'available')
            ->orderByRaw("CASE WHEN game_category_id = ? THEN 0 ELSE 1 END", [$account->game_category_id])
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        // Get Store Contact Settings
        $discordUrl = SiteSetting::get('discord_invite_url', 'https://discord.gg/zEGEGs6hat');
        $igUsername = SiteSetting::get('instagram_username', 'alzis_sturr');
        $tiktokUsername = SiteSetting::get('tiktok_username', 'emu_velz');

        $igUrl = "https://instagram.com/{$igUsername}";
        $tiktokUrl = "https://www.tiktok.com/@{$tiktokUsername}";

        return view('account-detail', compact('account', 'relatedAccounts', 'discordUrl', 'igUrl', 'tiktokUrl', 'igUsername', 'tiktokUsername'));
    }

    public function toggleWishlist(Request $request, $id)
    {
        if (!Auth::check()) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'status' => 'unauthenticated',
                    'message' => 'Silakan masuk / daftar akun terlebih dahulu untuk menyimpan akun ke Wishlist.',
                    'redirect' => route('login'),
                ], 401);
            }
            return redirect()->route('login')->with('warning', 'Silakan login terlebih dahulu untuk menyimpan akun ke Wishlist.');
        }

        $userId = Auth::id();
        $account = GameAccount::find($id);

        if (!$account) {
            return response()->json([
                'status' => 'error',
                'message' => 'Akun game tidak ditemukan atau telah dihapus.',
            ], 404);
        }

        $wishlist = Wishlist::where('user_id', $userId)->where('game_account_id', $account->id)->first();

        if ($wishlist) {
            $wishlist->delete();
            $isWishlisted = false;
            $msg = "Akun [{$account->code}] dihapus dari Wishlist Anda.";
        } else {
            Wishlist::create([
                'user_id' => $userId,
                'game_account_id' => $account->id,
            ]);
            $isWishlisted = true;
            $msg = "Akun [{$account->code}] berhasil ditambahkan ke Wishlist!";
        }

        $totalWishlists = Wishlist::where('user_id', $userId)->count();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'is_wishlisted' => $isWishlisted,
                'message' => $msg,
                'total_wishlists' => $totalWishlists,
            ]);
        }

        return back()->with('success', $msg);
    }

    public function myWishlist()
    {
        $user = Auth::user();

        // Clean up any orphan wishlist entries where the account was deleted
        Wishlist::whereDoesntHave('gameAccount')->delete();

        $wishlists = Wishlist::has('gameAccount')
            ->with(['gameAccount.category'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $totalCount = $wishlists->total();

        return view('user.wishlist', compact('wishlists', 'totalCount'));
    }

    public function howToBuy()
    {
        $discordUrl = SiteSetting::get('discord_invite_url', 'https://discord.gg/zEGEGs6hat');
        $igUsername = SiteSetting::get('instagram_username', 'alzis_sturr');
        $tiktokUsername = SiteSetting::get('tiktok_username', 'emu_velz');
        $rulesText = SiteSetting::get('rules_text');
        $guaranteeText = SiteSetting::get('guarantee_text');

        return view('pages.how-to-buy', compact('discordUrl', 'igUsername', 'tiktokUsername', 'rulesText', 'guaranteeText'));
    }

    public function contact()
    {
        $discordUrl = SiteSetting::get('discord_invite_url', 'https://discord.gg/zEGEGs6hat');
        $igUsername = SiteSetting::get('instagram_username', 'alzis_sturr');
        $tiktokUsername = SiteSetting::get('tiktok_username', 'emu_velz');

        return view('pages.contact', compact('discordUrl', 'igUsername', 'tiktokUsername'));
    }
}
