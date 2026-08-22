<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GameCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = GameCategory::withCount('gameAccounts')->orderBy('order', 'asc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:game_categories,name',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ], [
            'name.required' => 'Nama kategori game wajib diisi.',
            'name.unique' => 'Kategori game ini sudah ada.',
        ]);

        GameCategory::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return back()->with('success', 'Kategori game berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $category = GameCategory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:game_categories,name,' . $category->id,
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $category->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return back()->with('success', "Kategori [{$category->name}] berhasil diperbarui!");
    }

    public function destroy($id)
    {
        $category = GameCategory::withCount('gameAccounts')->findOrFail($id);

        if ($category->game_accounts_count > 0) {
            return back()->with('error', "Tidak dapat menghapus kategori [{$category->name}] karena masih memiliki {$category->game_accounts_count} akun game.");
        }

        $category->delete();

        return back()->with('success', 'Kategori game berhasil dihapus.');
    }
}
