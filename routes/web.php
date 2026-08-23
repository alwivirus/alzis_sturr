<?php

use App\Http\Controllers\Admin\AdminActivityLogController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminGameAccountController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Partner\PartnerDashboardController;
use App\Http\Controllers\Partner\PartnerGameAccountController;
use Illuminate\Support\Facades\Route;

// --- PUBLIC STORE ROUTES ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/katalog', [HomeController::class, 'catalog'])->name('catalog');
Route::get('/akun/{slug}', [HomeController::class, 'show'])->name('account.show');
Route::get('/cara-beli', [HomeController::class, 'howToBuy'])->name('how.to.buy');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');

// --- AUTHENTICATION ROUTES ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::post('/wishlist/{id}', [HomeController::class, 'toggleWishlist'])->name('wishlist.toggle');

// --- AUTHENTICATED USER ROUTES ---
Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [HomeController::class, 'myWishlist'])->name('wishlist.index');
    Route::get('/profil', [AuthController::class, 'profile'])->name('profile');
    Route::put('/profil', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profil/password', [AuthController::class, 'updatePassword'])->name('profile.password');
});

// --- DEDICATED PARTNER PORTAL ROUTES ---
Route::prefix('partner')->name('partner.')->middleware(['auth', 'partner'])->group(function () {
    Route::get('/', [PartnerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [PartnerDashboardController::class, 'index']);

    // Partner Game Account Management
    Route::resource('accounts', PartnerGameAccountController::class)->except(['show']);
    Route::post('accounts/{id}/toggle-status', [PartnerGameAccountController::class, 'toggleStatus'])->name('accounts.toggle-status');
    Route::delete('accounts/images/{id}', [PartnerGameAccountController::class, 'deleteImage'])->name('accounts.delete-image');
});

// --- ADMIN & OWNER MANAGEMENT ROUTES ---
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [AdminDashboardController::class, 'index']);

    // Game Accounts Management
    Route::resource('accounts', AdminGameAccountController::class)->except(['show']);
    Route::post('accounts/{id}/toggle-status', [AdminGameAccountController::class, 'toggleStatus'])->name('accounts.toggle-status');
    Route::delete('accounts/images/{id}', [AdminGameAccountController::class, 'deleteImage'])->name('accounts.delete-image');

    // Categories Management
    Route::resource('categories', AdminCategoryController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::get('categories/create', function() {
        return redirect()->route('admin.categories.index');
    });

    // Site Settings
    Route::get('settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [AdminSettingController::class, 'update'])->name('settings.update');

    // User & Role Management (Pelanggan, Partner, Owner)
    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::post('users/{id}/role', [AdminUserController::class, 'updateRole'])->name('users.role');
    Route::post('users/{id}/ban', [AdminUserController::class, 'toggleBan'])->name('users.ban');
    Route::post('users/{id}/password', [AdminUserController::class, 'updatePassword'])->name('users.password');
    Route::delete('users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    // Security & Activity Audit Logs
    Route::get('logs', [AdminActivityLogController::class, 'index'])->name('logs.index');
    Route::post('logs/clear', [AdminActivityLogController::class, 'clear'])->name('logs.clear');
});

// --- HOSTING STORAGE DELIVERY FALLBACK ---
Route::get('/storage/{path}', function ($path) {
    $fullPath = storage_path('app/public/' . $path);
    if (!file_exists($fullPath)) {
        abort(404);
    }
    return response()->file($fullPath);
})->where('path', '.*')->name('storage.fallback');

