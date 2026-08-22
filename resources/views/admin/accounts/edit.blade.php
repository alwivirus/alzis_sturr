@extends('layouts.admin')

@section('title', 'Edit Stok Akun #' . $account->code . ' - ALzis STURR Admin')
@section('page_title', 'EDIT POSTINGAN AKUN: #' . $account->code)

@section('header_actions')
<a href="{{ route('admin.accounts.index') }}" class="btn btn-secondary btn-sm">
    <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i>
    <span>Kembali ke Daftar</span>
</a>
@endsection

@section('content')

<div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 32px; max-width: 1000px;">
    
    <form action="{{ route('admin.accounts.update', $account->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Basic Information -->
        <h3 class="font-gaming" style="font-size: 1.3rem; color: var(--primary); margin-bottom: 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
            1. INFORMASI UTAMA & GAME
        </h3>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label class="form-label">Kategori Game <span style="color: var(--danger);">*</span></label>
                <select name="game_category_id" class="input-control" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('game_category_id', $account->game_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('game_category_id') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Kode Akun (SKU) <span style="color: var(--danger);">*</span></label>
                <input type="text" name="code" value="{{ old('code', $account->code) }}" class="input-control" required>
                @error('code') <div class="form-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Judul Postingan Akun <span style="color: var(--danger);">*</span></label>
            <input type="text" name="title" value="{{ old('title', $account->title) }}" class="input-control" required>
            @error('title') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <!-- Pricing & Status -->
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label class="form-label">Harga Asli (Rp) <span style="color: var(--danger);">*</span></label>
                <input type="number" name="price" value="{{ old('price', (int)$account->price) }}" class="input-control" required>
                @error('price') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Harga Promo (Rp) (Opsional)</label>
                <input type="number" name="discount_price" value="{{ old('discount_price', $account->discount_price ? (int)$account->discount_price : '') }}" class="input-control">
                @error('discount_price') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Status Stok <span style="color: var(--danger);">*</span></label>
                <select name="status" class="input-control" required>
                    <option value="available" {{ old('status', $account->status) == 'available' ? 'selected' : '' }}>🟢 Ready (Tersedia)</option>
                    <option value="sold" {{ old('status', $account->status) == 'sold' ? 'selected' : '' }}>🔴 Terjual (Sold Out)</option>
                    <option value="booked" {{ old('status', $account->status) == 'booked' ? 'selected' : '' }}>🟡 Booked (DP Masuk)</option>
                </select>
                @error('status') <div class="form-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- Bind & Server Configuration -->
        <h3 class="font-gaming" style="font-size: 1.3rem; color: var(--primary); margin: 30px 0 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
            2. PENGATURAN BIND & SERVER
        </h3>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label class="form-label">Status Bind / Login Akun <span style="color: var(--danger);">*</span></label>
                <input type="text" id="bindInput" name="login_bind" value="{{ old('login_bind', $account->login_bind) }}" class="input-control" required>
                <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-top: 8px;">
                    <span style="font-size: 0.7rem; color: var(--text-sub);">Preset Cepat:</span>
                    <button type="button" class="btn btn-secondary btn-sm" style="font-size: 0.7rem; padding: 2px 8px;" onclick="document.getElementById('bindInput').value = 'Moonton Sepaket (All Unbind)'">Moonton Sepaket</button>
                    <button type="button" class="btn btn-secondary btn-sm" style="font-size: 0.7rem; padding: 2px 8px;" onclick="document.getElementById('bindInput').value = 'Google Play Bersih (Siap Takeover)'">Google Play</button>
                    <button type="button" class="btn btn-secondary btn-sm" style="font-size: 0.7rem; padding: 2px 8px;" onclick="document.getElementById('bindInput').value = 'All Unbind / Clean Bind (Siap Kaitkan)'">All Unbind</button>
                </div>
                @error('login_bind') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Server / Region <span style="color: var(--danger);">*</span></label>
                <input type="text" id="serverInput" name="server" value="{{ old('server', $account->server) }}" class="input-control" required>
                <div style="display: flex; gap: 6px; margin-top: 8px;">
                    <button type="button" class="btn btn-secondary btn-sm" style="font-size: 0.7rem; padding: 2px 8px;" onclick="document.getElementById('serverInput').value = 'Indonesia'">Indonesia</button>
                    <button type="button" class="btn btn-secondary btn-sm" style="font-size: 0.7rem; padding: 2px 8px;" onclick="document.getElementById('serverInput').value = 'Asia'">Asia</button>
                    <button type="button" class="btn btn-secondary btn-sm" style="font-size: 0.7rem; padding: 2px 8px;" onclick="document.getElementById('serverInput').value = 'Global'">Global</button>
                </div>
                @error('server') <div class="form-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- Specs & Attributes -->
        <h3 class="font-gaming" style="font-size: 1.3rem; color: var(--primary); margin: 30px 0 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
            3. SPESIFIKASI & ATRIBUT GAME
        </h3>

        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px;">
            <div class="form-group">
                <label class="form-label">Rank / Tier</label>
                <input type="text" name="rank_tier" value="{{ old('rank_tier', $account->rank_tier) }}" class="input-control">
            </div>

            <div class="form-group">
                <label class="form-label">Winrate</label>
                <input type="text" name="winrate" value="{{ old('winrate', $account->winrate) }}" class="input-control">
            </div>

            <div class="form-group">
                <label class="form-label">Total Skin</label>
                <input type="number" name="skin_count" value="{{ old('skin_count', $account->skin_count) }}" class="input-control">
            </div>

            <div class="form-group">
                <label class="form-label">Total Hero</label>
                <input type="number" name="hero_count" value="{{ old('hero_count', $account->hero_count) }}" class="input-control">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Ringkasan Pendek</label>
            <input type="text" name="short_description" value="{{ old('short_description', $account->short_description) }}" class="input-control">
        </div>

        <div class="form-group">
            <label class="form-label">Deskripsi Lengkap & Rincian Spek</label>
            <textarea name="full_specs" rows="6" class="input-control">{{ old('full_specs', $account->full_specs) }}</textarea>
        </div>

        <!-- Photos & Screenshots -->
        <h3 class="font-gaming" style="font-size: 1.3rem; color: var(--primary); margin: 30px 0 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
            4. FOTO THUMBNAIL & GALERI SCREENSHOT
        </h3>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <label class="form-label">Ganti Foto Thumbnail Utama</label>
                @if($account->thumbnail)
                    <div style="margin-bottom: 10px;">
                        <img src="{{ $account->thumbnail_url }}" alt="Thumbnail" style="width: 120px; height: 80px; object-fit: cover; border-radius: var(--radius-sm); border: 1px solid var(--border-color);">
                    </div>
                @endif
                <input type="file" name="thumbnail_file" class="input-control" accept="image/*">
                <input type="url" name="thumbnail_url" value="{{ old('thumbnail_url', str_starts_with($account->thumbnail, 'http') ? $account->thumbnail : '') }}" class="input-control" style="margin-top: 6px;" placeholder="URL foto thumbnail alternatif">
            </div>

            <div>
                <label class="form-label">Tambah Screenshot Baru (Multi Foto)</label>
                <input type="file" name="screenshots[]" multiple class="input-control" accept="image/*">
                <span class="form-helper">Upload gambar baru untuk menambah ke galeri.</span>
            </div>
        </div>

        <!-- Existing Screenshots Gallery with Delete -->
        @if($account->images->count() > 0)
            <div class="form-group">
                <label class="form-label">Galeri Foto Saat Ini (Klik × untuk hapus foto):</label>
                <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                    @foreach($account->images as $img)
                        <div style="position: relative; width: 110px; height: 80px; border-radius: var(--radius-sm); overflow: hidden; border: 1px solid var(--border-color); background: #0f172a;">
                            <img src="{{ $img->image_url }}" alt="Screenshot" style="width: 100%; height: 100%; object-fit: cover;">
                            <form action="{{ route('admin.accounts.delete-image', $img->id) }}" method="POST" onsubmit="return confirm('Hapus foto screenshot ini?')" style="position: absolute; top: 4px; right: 4px; z-index: 5;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="width: 24px; height: 24px; border-radius: 50%; background: rgba(239, 68, 68, 0.9); border: none; color: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; font-weight: bold; font-size: 14px;" title="Hapus foto ini">
                                    ×
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Badges & Options -->
        <div style="display: flex; gap: 30px; margin: 24px 0;">
            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                <input type="checkbox" name="is_verified" value="1" {{ old('is_verified', $account->is_verified) ? 'checked' : '' }}>
                <span style="font-weight: 600; color: #fff;">🛡️ Tampilkan Badge Garansi 100% Anti Hackback</span>
            </label>

            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $account->is_featured) ? 'checked' : '' }}>
                <span style="font-weight: 600; color: var(--accent-gold);">⭐ Jadikan Akun Rekomendasi (Featured)</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div style="padding-top: 20px; border-top: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; gap: 12px;">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i data-lucide="save" style="width: 20px; height: 20px;"></i>
                    <span>Simpan Perubahan Akun</span>
                </button>
                <a href="{{ route('admin.accounts.index') }}" class="btn btn-secondary btn-lg">Batal</a>
            </div>
        </div>
    </form>

    <!-- Separate Delete Form for Safety -->
    <div style="margin-top: 24px; padding-top: 20px; border-top: 1px dashed rgba(239, 68, 68, 0.3); display: flex; justify-content: space-between; align-items: center;">
        <div>
            <div style="color: #fca5a5; font-weight: 600;">Zona Bahaya</div>
            <div style="color: var(--text-sub); font-size: 0.85rem;">Hapus akun ini secara permanen dari katalog dan database.</div>
        </div>
        <form action="{{ route('admin.accounts.destroy', $account->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun [{{ $account->code }}]? Data akun dan foto akan dihapus permanen.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-secondary" style="color: var(--danger); border-color: rgba(239, 68, 68, 0.4);">
                <i data-lucide="trash" style="width: 16px; height: 16px;"></i>
                <span>Hapus Akun Ini</span>
            </button>
        </form>
    </div>
</div>

@endsection
