@extends('layouts.partner')

@section('title', 'Edit Akun #' . $account->code . ' - Panel Mitra Partner')
@section('page_title', 'EDIT POSTINGAN AKUN: #' . $account->code)

@section('header_actions')
<a href="{{ route('partner.accounts.index') }}" class="btn btn-outline btn-sm">
    <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i>
    <span>Kembali ke Stok Saya</span>
</a>
@endsection

@section('content')

<div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 28px; max-width: 1000px;">
    
    <form action="{{ route('partner.accounts.update', $account->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- 1. Basic Information -->
        <h3 class="font-heading" style="font-size: 1.25rem; color: var(--primary); margin-bottom: 20px; border-bottom: 1px solid var(--border); padding-bottom: 8px; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i data-lucide="gamepad-2" style="width: 20px; height: 20px;"></i>
            1. INFORMASI UTAMA & KATEGORI GAME
        </h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; margin-bottom: 18px;">
            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Kategori Game</label>
                <select name="game_category_id" class="input-control" style="height: 42px;">
                    <option value="">-- Pilih Game yang Ada --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('game_category_id', $account->game_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('game_category_id') <div style="color: var(--danger); font-size: 0.75rem; margin-top: 4px;">{{ $message }}</div> @enderror
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Atau Ubah ke Game Baru</label>
                <input type="text" name="new_game_name" value="{{ old('new_game_name') }}" class="input-control" placeholder="Tulis nama game baru..." style="height: 42px;">
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Kode Akun (SKU) <span style="color: var(--danger);">*</span></label>
                <input type="text" name="code" value="{{ old('code', $account->code) }}" class="input-control" required style="height: 42px; font-family: monospace; font-weight: 700;">
                @error('code') <div style="color: var(--danger); font-size: 0.75rem; margin-top: 4px;">{{ $message }}</div> @enderror
            </div>
        </div>

        <div style="margin-bottom: 22px;">
            <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Judul Postingan Akun <span style="color: var(--danger);">*</span></label>
            <input type="text" name="title" value="{{ old('title', $account->title) }}" class="input-control" required style="height: 44px; font-size: 0.95rem;">
            @error('title') <div style="color: var(--danger); font-size: 0.75rem; margin-top: 4px;">{{ $message }}</div> @enderror
        </div>

        <!-- 2. Pricing & Status -->
        <h3 class="font-heading" style="font-size: 1.25rem; color: var(--primary); margin: 30px 0 20px; border-bottom: 1px solid var(--border); padding-bottom: 8px; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i data-lucide="tag" style="width: 20px; height: 20px;"></i>
            2. PENETAPAN HARGA & STATUS STOK
        </h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; margin-bottom: 22px;">
            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Harga Normal (Rp) <span style="color: var(--danger);">*</span></label>
                <input type="number" name="price" value="{{ old('price', (int)$account->price) }}" class="input-control" required style="height: 42px; font-weight: 700;">
                @error('price') <div style="color: var(--danger); font-size: 0.75rem; margin-top: 4px;">{{ $message }}</div> @enderror
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Harga Promo (Rp) (Opsional)</label>
                <input type="number" name="discount_price" value="{{ old('discount_price', $account->discount_price ? (int)$account->discount_price : '') }}" class="input-control" style="height: 42px;">
                @error('discount_price') <div style="color: var(--danger); font-size: 0.75rem; margin-top: 4px;">{{ $message }}</div> @enderror
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Status Stok <span style="color: var(--danger);">*</span></label>
                <select name="status" class="input-control" required style="height: 42px; font-weight: 700;">
                    <option value="available" {{ old('status', $account->status) == 'available' ? 'selected' : '' }}>🟢 Ready (Tersedia)</option>
                    <option value="sold" {{ old('status', $account->status) == 'sold' ? 'selected' : '' }}>🔴 Terjual (Sold Out)</option>
                    <option value="booked" {{ old('status', $account->status) == 'booked' ? 'selected' : '' }}>🟡 Booked (DP Masuk)</option>
                </select>
                @error('status') <div style="color: var(--danger); font-size: 0.75rem; margin-top: 4px;">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- 3. Bind & Server Configuration -->
        <h3 class="font-heading" style="font-size: 1.25rem; color: var(--primary); margin: 30px 0 20px; border-bottom: 1px solid var(--border); padding-bottom: 8px; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i data-lucide="shield-alert" style="width: 20px; height: 20px;"></i>
            3. PENGATURAN BIND & SERVER
        </h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px; margin-bottom: 22px;">
            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Status Bind / Login Akun <span style="color: var(--danger);">*</span></label>
                <input type="text" id="bindInput" name="login_bind" value="{{ old('login_bind', $account->login_bind) }}" class="input-control" required style="height: 42px;">
                <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-top: 8px;">
                    <button type="button" class="btn btn-outline btn-sm" style="font-size: 0.7rem; padding: 2px 8px;" onclick="document.getElementById('bindInput').value = 'Moonton Sepaket (All Unbind)'">Moonton Sepaket</button>
                    <button type="button" class="btn btn-outline btn-sm" style="font-size: 0.7rem; padding: 2px 8px;" onclick="document.getElementById('bindInput').value = 'Google Play Bersih (Siap Takeover)'">Google Play</button>
                    <button type="button" class="btn btn-outline btn-sm" style="font-size: 0.7rem; padding: 2px 8px;" onclick="document.getElementById('bindInput').value = 'All Unbind / Clean Bind'">All Unbind</button>
                </div>
                @error('login_bind') <div style="color: var(--danger); font-size: 0.75rem; margin-top: 4px;">{{ $message }}</div> @enderror
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Server / Region <span style="color: var(--danger);">*</span></label>
                <input type="text" id="serverInput" name="server" value="{{ old('server', $account->server) }}" class="input-control" required style="height: 42px;">
                <div style="display: flex; gap: 6px; margin-top: 8px;">
                    <button type="button" class="btn btn-outline btn-sm" style="font-size: 0.7rem; padding: 2px 8px;" onclick="document.getElementById('serverInput').value = 'Indonesia'">Indonesia</button>
                    <button type="button" class="btn btn-outline btn-sm" style="font-size: 0.7rem; padding: 2px 8px;" onclick="document.getElementById('serverInput').value = 'Asia'">Asia</button>
                    <button type="button" class="btn btn-outline btn-sm" style="font-size: 0.7rem; padding: 2px 8px;" onclick="document.getElementById('serverInput').value = 'Global'">Global</button>
                </div>
                @error('server') <div style="color: var(--danger); font-size: 0.75rem; margin-top: 4px;">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- 4. Specs & Attributes -->
        <h3 class="font-heading" style="font-size: 1.25rem; color: var(--primary); margin: 30px 0 20px; border-bottom: 1px solid var(--border); padding-bottom: 8px; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i data-lucide="layers" style="width: 20px; height: 20px;"></i>
            4. SPESIFIKASI & ATRIBUT GAME
        </h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin-bottom: 18px;">
            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Rank / Tier</label>
                <input type="text" name="rank_tier" value="{{ old('rank_tier', $account->rank_tier) }}" class="input-control" style="height: 42px;">
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Winrate / Level</label>
                <input type="text" name="winrate" value="{{ old('winrate', $account->winrate) }}" class="input-control" style="height: 42px;">
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Total Skin</label>
                <input type="number" name="skin_count" value="{{ old('skin_count', $account->skin_count) }}" class="input-control" style="height: 42px;">
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Total Hero</label>
                <input type="number" name="hero_count" value="{{ old('hero_count', $account->hero_count) }}" class="input-control" style="height: 42px;">
            </div>
        </div>

        <div style="margin-bottom: 18px;">
            <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Ringkasan Pendek</label>
            <input type="text" name="short_description" value="{{ old('short_description', $account->short_description) }}" class="input-control" style="height: 42px;">
        </div>

        <div style="margin-bottom: 22px;">
            <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Deskripsi Lengkap & Rincian Spek</label>
            <textarea name="full_specs" rows="5" class="input-control">{{ old('full_specs', $account->full_specs) }}</textarea>
        </div>

        <!-- 5. Photos & Screenshots -->
        <h3 class="font-heading" style="font-size: 1.25rem; color: var(--primary); margin: 30px 0 20px; border-bottom: 1px solid var(--border); padding-bottom: 8px; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i data-lucide="image" style="width: 20px; height: 20px;"></i>
            5. FOTO THUMBNAIL & GALERI SCREENSHOT
        </h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 18px; margin-bottom: 20px;">
            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Ganti Foto Thumbnail Utama</label>
                @if($account->thumbnail)
                    <div style="margin-bottom: 10px;">
                        <img src="{{ $account->thumbnail_url }}" alt="Thumbnail" style="width: 120px; height: 80px; object-fit: cover; border-radius: 6px; border: 1px solid var(--border);">
                    </div>
                @endif
                <input type="file" name="thumbnail_file" class="input-control" accept="image/*">
                <input type="url" name="thumbnail_url" value="{{ old('thumbnail_url', str_starts_with($account->thumbnail, 'http') ? $account->thumbnail : '') }}" class="input-control" style="margin-top: 6px; height: 38px;" placeholder="URL foto thumbnail alternatif">
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Tambah Screenshot Baru ke Galeri</label>
                <input type="file" name="screenshots[]" multiple class="input-control" accept="image/*">
                <span style="font-size: 0.72rem; color: var(--text-dim); margin-top: 6px; display: block;">Upload gambar baru untuk menambah galeri screenshot.</span>
            </div>
        </div>

        <!-- Existing Screenshots Gallery with Delete -->
        @if($account->images->count() > 0)
            <div style="margin-bottom: 22px;">
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 8px; text-transform: uppercase;">Galeri Screenshot Saat Ini (Klik tombol merah × untuk hapus):</label>
                <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                    @foreach($account->images as $img)
                        <div style="position: relative; width: 110px; height: 80px; border-radius: 6px; overflow: hidden; border: 1px solid var(--border); background: #0f172a;">
                            <img src="{{ $img->image_url }}" alt="Screenshot" style="width: 100%; height: 100%; object-fit: cover;">
                            <button type="button" onclick="deletePartnerScreenshot({{ $img->id }})" style="position: absolute; top: 4px; right: 4px; z-index: 5; width: 22px; height: 22px; border-radius: 50%; background: rgba(239, 68, 68, 0.9); border: none; color: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; font-weight: bold; font-size: 13px;" title="Hapus foto ini">
                                ×
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Badges & Options -->
        <div style="display: flex; flex-wrap: wrap; gap: 24px; margin: 24px 0; padding: 14px 18px; background: var(--bg-surface); border: 1px solid var(--border); border-radius: 8px;">
            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                <input type="checkbox" name="is_verified" value="1" {{ old('is_verified', $account->is_verified) ? 'checked' : '' }}>
                <span style="font-weight: 700; color: #fff; font-size: 0.85rem;">🛡️ Sertakan Garansi 100% Anti Hackback</span>
            </label>

            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $account->is_featured) ? 'checked' : '' }}>
                <span style="font-weight: 700; color: var(--gold); font-size: 0.85rem;">⭐ Akun Rekomendasi / Sultan</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div style="padding-top: 20px; border-top: 1px solid var(--border); display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
            <button type="submit" class="btn btn-primary" style="padding: 10px 24px;">
                <i data-lucide="save" style="width: 18px; height: 18px;"></i>
                <span>Simpan Perubahan Akun</span>
            </button>
            <a href="{{ route('partner.accounts.index') }}" class="btn btn-outline" style="padding: 10px 20px;">Batal</a>
        </div>
    </form>

    <!-- Hidden Form for Deleting Screenshots -->
    <form id="deletePartnerScreenshotForm" method="POST" action="" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</div>

@push('scripts')
<script>
    function deletePartnerScreenshot(imgId) {
        if (confirm('Hapus foto screenshot ini dari galeri?')) {
            const form = document.getElementById('deletePartnerScreenshotForm');
            form.action = '/partner/accounts/images/' + imgId;
            form.submit();
        }
    }
</script>
@endpush

@endsection
