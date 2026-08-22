<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountImage;
use App\Models\ActivityLog;
use App\Models\GameAccount;
use App\Models\GameCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminGameAccountController extends Controller
{
    public function index(Request $request)
    {
        $query = GameAccount::with(['category', 'images']);

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('game_category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $accounts = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $categories = GameCategory::all();

        return view('admin.accounts.index', compact('accounts', 'categories'));
    }

    public function create()
    {
        $categories = GameCategory::where('is_active', true)->orderBy('name')->get();
        return view('admin.accounts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_category_id' => 'nullable|exists:game_categories,id',
            'new_game_name' => 'nullable|string|max:100',
            'code' => 'required|string|max:50|unique:game_accounts,code',
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'login_bind' => 'required|string|max:255',
            'server' => 'required|string|max:255',
            'status' => 'required|in:available,sold,booked',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'thumbnail_url' => 'nullable|url',
            'screenshots.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'short_description' => 'nullable|string',
            'full_specs' => 'nullable|string',
            'hero_count' => 'nullable|integer|min:0',
            'skin_count' => 'nullable|integer|min:0',
            'rank_tier' => 'nullable|string|max:100',
            'winrate' => 'nullable|string|max:50',
            'is_verified' => 'boolean',
            'is_featured' => 'boolean',
        ], [
            'code.required' => 'Kode akun (SKU) wajib diisi.',
            'code.unique' => 'Kode akun ini sudah digunakan, gunakan kode unik.',
            'title.required' => 'Judul postingan akun wajib diisi.',
            'price.required' => 'Harga akun wajib diisi.',
            'discount_price.lt' => 'Harga promo harus lebih kecil dari harga normal.',
            'login_bind.required' => 'Status login/bind akun wajib diisi.',
            'server.required' => 'Server / Region wajib diisi.',
        ]);

        $categoryId = $request->input('game_category_id');

        // Handle Custom / New Game Input
        if ($request->filled('new_game_name')) {
            $newGameName = trim($request->input('new_game_name'));
            $catSlug = Str::slug($newGameName);
            if (empty($catSlug)) {
                $catSlug = 'game-' . Str::random(5);
            }
            $category = GameCategory::firstOrCreate(
                ['slug' => $catSlug],
                [
                    'name' => $newGameName,
                    'icon' => 'gamepad-2',
                    'is_active' => true,
                    'order' => (GameCategory::max('order') ?? 0) + 1,
                ]
            );
            $categoryId = $category->id;
        }

        if (empty($categoryId)) {
            return back()->withErrors(['game_category_id' => 'Pilih kategori game yang tersedia atau tulis nama game baru.'])->withInput();
        }

        // Ensure directories exist
        @mkdir(storage_path('app/public/accounts/thumbnails'), 0775, true);
        @mkdir(storage_path('app/public/accounts/gallery'), 0775, true);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail_file')) {
            $thumbnailPath = $request->file('thumbnail_file')->store('accounts/thumbnails', 'public');
        } elseif ($request->filled('thumbnail_url')) {
            $thumbnailPath = $request->thumbnail_url;
        }

        $account = GameAccount::create([
            'game_category_id' => $categoryId,
            'code' => strtoupper($validated['code']),
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title'] . '-' . $validated['code']),
            'price' => $validated['price'],
            'discount_price' => $validated['discount_price'] ?? null,
            'login_bind' => $validated['login_bind'],
            'server' => $validated['server'],
            'status' => $validated['status'],
            'thumbnail' => $thumbnailPath,
            'short_description' => $validated['short_description'] ?? null,
            'full_specs' => $validated['full_specs'] ?? null,
            'hero_count' => $validated['hero_count'] ?? null,
            'skin_count' => $validated['skin_count'] ?? null,
            'rank_tier' => $validated['rank_tier'] ?? null,
            'winrate' => $validated['winrate'] ?? null,
            'is_verified' => $request->boolean('is_verified', true),
            'is_featured' => $request->boolean('is_featured', false),
        ]);

        // Upload additional screenshots if provided
        if ($request->hasFile('screenshots')) {
            $order = 1;
            foreach ($request->file('screenshots') as $screenshot) {
                $path = $screenshot->store('accounts/gallery', 'public');
                AccountImage::create([
                    'game_account_id' => $account->id,
                    'image_path' => $path,
                    'sort_order' => $order++,
                ]);
            }
        }

        ActivityLog::record(
            'CREATE_ACCOUNT',
            "Menambahkan postingan akun game baru [{$account->code}] - '{$account->title}' seharga " . $account->formatted_effective_price . ".",
            ['account_id' => $account->id, 'code' => $account->code]
        );

        return redirect()->route('admin.accounts.index')->with('success', "Akun game [{$account->code}] berhasil ditambahkan ke katalog!");
    }

    public function edit($id)
    {
        $account = ($id instanceof GameAccount) ? $id : GameAccount::with('images')->findOrFail($id);
        $categories = GameCategory::where('is_active', true)->orderBy('name')->get();
        return view('admin.accounts.edit', compact('account', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $account = ($id instanceof GameAccount) ? $id : GameAccount::findOrFail($id);

        $validated = $request->validate([
            'game_category_id' => 'nullable|exists:game_categories,id',
            'new_game_name' => 'nullable|string|max:100',
            'code' => 'required|string|max:50|unique:game_accounts,code,' . $account->id,
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'login_bind' => 'required|string|max:255',
            'server' => 'required|string|max:255',
            'status' => 'required|in:available,sold,booked',
            'thumbnail_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'thumbnail_url' => 'nullable|url',
            'screenshots.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'short_description' => 'nullable|string',
            'full_specs' => 'nullable|string',
            'hero_count' => 'nullable|integer|min:0',
            'skin_count' => 'nullable|integer|min:0',
            'rank_tier' => 'nullable|string|max:100',
            'winrate' => 'nullable|string|max:50',
            'is_verified' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ]);

        $categoryId = $request->input('game_category_id');

        // Handle Custom / New Game Input
        if ($request->filled('new_game_name')) {
            $newGameName = trim($request->input('new_game_name'));
            $catSlug = Str::slug($newGameName);
            if (empty($catSlug)) {
                $catSlug = 'game-' . Str::random(5);
            }
            $category = GameCategory::firstOrCreate(
                ['slug' => $catSlug],
                [
                    'name' => $newGameName,
                    'icon' => 'gamepad-2',
                    'is_active' => true,
                    'order' => (GameCategory::max('order') ?? 0) + 1,
                ]
            );
            $categoryId = $category->id;
        }

        if (empty($categoryId)) {
            $categoryId = $account->game_category_id;
        }

        // Ensure directories exist
        @mkdir(storage_path('app/public/accounts/thumbnails'), 0775, true);
        @mkdir(storage_path('app/public/accounts/gallery'), 0775, true);

        $thumbnailPath = $account->thumbnail;
        if ($request->hasFile('thumbnail_file')) {
            // Delete old file if local
            if ($account->thumbnail && !str_starts_with($account->thumbnail, 'http') && Storage::disk('public')->exists($account->thumbnail)) {
                Storage::disk('public')->delete($account->thumbnail);
            }
            $thumbnailPath = $request->file('thumbnail_file')->store('accounts/thumbnails', 'public');
        } elseif ($request->filled('thumbnail_url')) {
            $thumbnailPath = $request->thumbnail_url;
        }

        $account->update([
            'game_category_id' => $categoryId,
            'code' => strtoupper($validated['code']),
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title'] . '-' . $validated['code']),
            'price' => $validated['price'],
            'discount_price' => $validated['discount_price'] ?? null,
            'login_bind' => $validated['login_bind'],
            'server' => $validated['server'],
            'status' => $validated['status'],
            'thumbnail' => $thumbnailPath,
            'short_description' => $validated['short_description'] ?? null,
            'full_specs' => $validated['full_specs'] ?? null,
            'hero_count' => $validated['hero_count'] ?? null,
            'skin_count' => $validated['skin_count'] ?? null,
            'rank_tier' => $validated['rank_tier'] ?? null,
            'winrate' => $validated['winrate'] ?? null,
            'is_verified' => $request->boolean('is_verified', true),
            'is_featured' => $request->boolean('is_featured', false),
        ]);

        // Upload additional screenshots
        if ($request->hasFile('screenshots')) {
            $lastOrder = $account->images()->max('sort_order') ?? 0;
            foreach ($request->file('screenshots') as $screenshot) {
                $lastOrder++;
                $path = $screenshot->store('accounts/gallery', 'public');
                AccountImage::create([
                    'game_account_id' => $account->id,
                    'image_path' => $path,
                    'sort_order' => $lastOrder,
                ]);
            }
        }

        ActivityLog::record(
            'UPDATE_ACCOUNT',
            "Memperbarui data dan spesifikasi akun game [{$account->code}] - '{$account->title}'.",
            ['account_id' => $account->id, 'code' => $account->code]
        );

        return redirect()->route('admin.accounts.index')->with('success', "Akun [{$account->code}] berhasil diperbarui!");
    }

    public function destroy($id)
    {
        $account = ($id instanceof GameAccount) ? $id : GameAccount::findOrFail($id);
        $code = $account->code;
        $title = $account->title;

        // Delete wishlists to prevent foreign key errors
        $account->wishlists()->delete();

        // Delete thumbnail file if local
        if ($account->thumbnail && !str_starts_with($account->thumbnail, 'http') && Storage::disk('public')->exists($account->thumbnail)) {
            Storage::disk('public')->delete($account->thumbnail);
        }

        // Delete all gallery screenshots
        foreach ($account->images as $img) {
            if (!str_starts_with($img->image_path, 'http') && Storage::disk('public')->exists($img->image_path)) {
                Storage::disk('public')->delete($img->image_path);
            }
            $img->delete();
        }

        $account->delete();

        ActivityLog::record(
            'DELETE_ACCOUNT',
            "Menghapus permanen akun game [{$code}] - '{$title}' dari database.",
            ['deleted_code' => $code]
        );

        return redirect()->route('admin.accounts.index')->with('success', "Akun [{$code}] berhasil dihapus dari katalog.");
    }

    public function toggleStatus($id)
    {
        $account = ($id instanceof GameAccount) ? $id : GameAccount::findOrFail($id);
        $account->status = ($account->status === 'available') ? 'sold' : 'available';
        $account->save();

        $statusLabel = ($account->status === 'available') ? 'Tersedia (Ready)' : 'Terjual (Sold Out)';

        ActivityLog::record(
            'TOGGLE_STATUS',
            "Mengubah status stok akun [{$account->code}] menjadi: {$statusLabel}.",
            ['account_id' => $account->id, 'new_status' => $account->status]
        );

        return back()->with('success', "Status akun [{$account->code}] diubah menjadi: {$statusLabel}.");
    }

    public function deleteImage($id)
    {
        $image = AccountImage::findOrFail($id);
        $accCode = $image->gameAccount?->code ?? 'N/A';
        if (!str_starts_with($image->image_path, 'http') && Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }
        $image->delete();

        ActivityLog::record(
            'DELETE_IMAGE',
            "Menghapus salah satu screenshot galeri pada akun [{$accCode}]."
        );

        return back()->with('success', 'Foto screenshot berhasil dihapus.');
    }
}
