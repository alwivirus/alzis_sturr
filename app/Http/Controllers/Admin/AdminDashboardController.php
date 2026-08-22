<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GameAccount;
use App\Models\GameCategory;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalAccounts = GameAccount::count();
        $availableAccounts = GameAccount::where('status', 'available')->count();
        $soldAccounts = GameAccount::where('status', 'sold')->count();
        $totalCategories = GameCategory::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalViews = GameAccount::sum('views_count');
        $totalWishlists = Wishlist::count();

        $latestAccounts = GameAccount::with('category')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $topViewed = GameAccount::with('category')
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalAccounts',
            'availableAccounts',
            'soldAccounts',
            'totalCategories',
            'totalUsers',
            'totalViews',
            'totalWishlists',
            'latestAccounts',
            'topViewed'
        ));
    }
}
