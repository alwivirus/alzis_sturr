<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\GameAccount;
use App\Models\GameCategory;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalAccounts = GameAccount::count();
        $availableAccounts = GameAccount::where('status', 'available')->count();
        $soldAccounts = GameAccount::where('status', 'sold')->count();
        $totalCategories = GameCategory::count();
        
        // User & Role Stats
        $totalUsers = User::count();
        $totalOwners = User::whereIn('role', ['owner', 'super_admin'])->count();
        $totalPartners = User::where('role', 'partner')->count();
        $totalCustomers = User::where('role', 'user')->count();
        $totalBanned = User::where('is_banned', true)->count();

        $totalViews = GameAccount::sum('views_count');
        $totalWishlists = Wishlist::count();
        
        // Partner Accounts Stats & Safe Column Check
        $hasUserIdCol = \Illuminate\Support\Facades\Schema::hasColumn('game_accounts', 'user_id');

        $partnerAccountsCount = 0;
        $latestPartnerAccounts = collect();

        if ($hasUserIdCol) {
            $partnerAccountsCount = GameAccount::whereHas('user', function($q) {
                $q->where('role', 'partner');
            })->count();

            $latestPartnerAccounts = GameAccount::with(['category', 'user'])
                ->whereHas('user', function($q) {
                    $q->where('role', 'partner');
                })
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        }

        // Financial & Stock Valuation
        $totalStockValue = GameAccount::where('status', 'available')->sum(DB::raw('COALESCE(discount_price, price)'));
        $totalSoldValue = GameAccount::where('status', 'sold')->sum(DB::raw('COALESCE(discount_price, price)'));

        $latestAccountsQuery = GameAccount::with('category');
        if ($hasUserIdCol) {
            $latestAccountsQuery->with('user');
        }
        $latestAccounts = $latestAccountsQuery->orderBy('created_at', 'desc')->take(6)->get();

        $topViewed = GameAccount::with('category')
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->get();

        $recentActivityLogs = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        return view('admin.dashboard', compact(
            'totalAccounts',
            'availableAccounts',
            'soldAccounts',
            'totalCategories',
            'totalUsers',
            'totalOwners',
            'totalPartners',
            'totalCustomers',
            'totalBanned',
            'totalViews',
            'totalWishlists',
            'partnerAccountsCount',
            'totalStockValue',
            'totalSoldValue',
            'latestAccounts',
            'latestPartnerAccounts',
            'topViewed',
            'recentActivityLogs'
        ));
    }
}
