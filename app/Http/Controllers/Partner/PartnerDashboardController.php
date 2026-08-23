<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\GameAccount;
use App\Models\GameCategory;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PartnerDashboardController extends Controller
{
    public function index()
    {
        $partnerId = Auth::id();
        $hasUserIdCol = \Illuminate\Support\Facades\Schema::hasColumn('game_accounts', 'user_id');

        // Metrics for logged-in Partner
        $myAccountsCount = 0;
        $myAvailableCount = 0;
        $mySoldCount = 0;
        $myStockValue = 0;
        $mySoldValue = 0;
        $myTotalViews = 0;
        $myWishlistsCount = 0;
        $recentAccounts = collect();

        if ($hasUserIdCol) {
            $myAccountsCount = GameAccount::where('user_id', $partnerId)->count();
            $myAvailableCount = GameAccount::where('user_id', $partnerId)->where('status', 'available')->count();
            $mySoldCount = GameAccount::where('user_id', $partnerId)->where('status', 'sold')->count();

            $myStockValue = GameAccount::where('user_id', $partnerId)
                ->where('status', 'available')
                ->sum(DB::raw('COALESCE(discount_price, price)'));

            $mySoldValue = GameAccount::where('user_id', $partnerId)
                ->where('status', 'sold')
                ->sum(DB::raw('COALESCE(discount_price, price)'));

            $myTotalViews = GameAccount::where('user_id', $partnerId)->sum('views_count');

            $myAccountIds = GameAccount::where('user_id', $partnerId)->pluck('id');
            $myWishlistsCount = Wishlist::whereIn('game_account_id', $myAccountIds)->count();

            $recentAccounts = GameAccount::with('category')
                ->where('user_id', $partnerId)
                ->orderBy('created_at', 'desc')
                ->take(6)
                ->get();
        }

        // Total game categories available
        $totalCategories = GameCategory::where('is_active', true)->count();

        return view('partner.dashboard', compact(
            'myAccountsCount',
            'myAvailableCount',
            'mySoldCount',
            'myStockValue',
            'mySoldValue',
            'myTotalViews',
            'myWishlistsCount',
            'recentAccounts',
            'totalCategories'
        ));
    }
}
