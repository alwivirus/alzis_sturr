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
        $totalAdmins = User::where('role', 'admin')->count();
        $totalResellers = User::where('role', 'reseller')->count();
        $totalCustomers = User::where('role', 'user')->count();
        $totalBanned = User::where('is_banned', true)->count();

        $totalViews = GameAccount::sum('views_count');
        $totalWishlists = Wishlist::count();

        // Financial & Stock Valuation
        $totalStockValue = GameAccount::where('status', 'available')->sum(DB::raw('COALESCE(discount_price, price)'));
        $totalSoldValue = GameAccount::where('status', 'sold')->sum(DB::raw('COALESCE(discount_price, price)'));

        $latestAccounts = GameAccount::with('category')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

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
            'totalAdmins',
            'totalResellers',
            'totalCustomers',
            'totalBanned',
            'totalViews',
            'totalWishlists',
            'totalStockValue',
            'totalSoldValue',
            'latestAccounts',
            'topViewed',
            'recentActivityLogs'
        ));
    }
}
