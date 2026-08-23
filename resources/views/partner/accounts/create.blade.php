@extends('layouts.partner')

@section('title', 'Posting Akun Game Baru - Panel Mitra Partner')
@section('page_title', 'POSTING STOK AKUN GAME BARU')

@section('header_actions')
<a href="{{ route('partner.accounts.index') }}" class="btn btn-outline btn-sm">
    <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i>
    <span>Kembali ke Stok Saya</span>
</a>
@endsection

@section('content')

<div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 28px; max-width: 1000px;">
    
    <form action="{{ route('partner.accounts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 1. Basic Information -->
        <h3 class="font-heading" style="font-size: 1.25rem; color: var(--primary); margin-bottom: 20px; border-bottom: 1px solid var(--border); padding-bottom: 8px; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i data-lucide="gamepad-2" style="width: 20px; height: 20px;"></i>
            1. INFORMASI UTAMA & KATEGORI GAME
        </h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; margin-bottom: 18px;">
            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Pilih Kategori Game</label>
                <select name="game_category_id" id="game_category_select" class="input-control" style="height: 42px;">
                    <option value="">-- Pilih Game yang Ada --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('game_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('game_category_id') <div style="color: var(--danger); font-size: 0.75rem; margin-top: 4px;">{{ $message }}</div> @enderror
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Atau Game Baru (Custom)</label>
                <input type="text" name="new_game_name" value="{{ old('new_game_name') }}" class="input-control" placeholder="Misal: Roblox, FC Mobile, Honkai, PB..." style="height: 42px;">
                <span style="font-size: 0.72rem; color: #38bdf8; margin-top: 4px; display: block;">Tulis jika nama game belum ada di pilihan.</span>
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Kode Akun (SKU Unik) <span style="color: var(--danger);">*</span></label>
                <input type="text" name="code" value="{{ old('code', 'PTR-' . strtoupper(Str::random(5))) }}" class="input-control" placeholder="Contoh: PTR-ML-01" required style="height: 42px; font-family: monospace; font-weight: 700;">
                @error('code') <div style="color: var(--danger); font-size: 0.75rem; margin-top: 4px;">{{ $message }}</div> @enderror
            </div>
        </div>

        <div style="margin-bottom: 22px;">
            <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Judul Postingan Akun <span style="color: var(--danger);">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" class="input-control" placeholder="Contoh: MLBB Mythical Glory 100★ | 5 Collector + 2 KOF + Lesley Aspirants" required style="height: 44px; font-size: 0.95rem;">
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
                <input type="number" name="price" value="{{ old('price') }}" class="input-control" placeholder="Contoh: 750000" required style="height: 42px; font-weight: 700;">
                @error('price') <div style="color: var(--danger); font-size: 0.75rem; margin-top: 4px;">{{ $message }}</div> @enderror
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Harga Promo / Diskon (Rp) (Opsional)</label>
                <input type="number" name="discount_price" value="{{ old('discount_price') }}" class="input-control" placeholder="Contoh: 599000" style="height: 42px;">
                <span style="font-size: 0.72rem; color: var(--text-dim); margin-top: 4px; display: block;">Biarkan kosong jika tanpa diskon</span>
                @error('discount_price') <div style="color: var(--danger); font-size: 0.75rem; margin-top: 4px;">{{ $message }}</div> @enderror
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Status Stok <span style="color: var(--danger);">*</span></label>
                <select name="status" class="input-control" required style="height: 42px; font-weight: 700;">
                    <option value="available" {{ old('status', 'available') == 'available' ? 'selected' : '' }}>🟢 Ready (Tersedia)</option>
                    <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>🔴 Terjual (Sold Out)</option>
                    <option value="booked" {{ old('status') == 'booked' ? 'selected' : '' }}>🟡 Booked (DP Masuk)</option>
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
                <input type="text" id="bindInput" name="login_bind" value="{{ old('login_bind') }}" class="input-control" placeholder="Contoh: Moonton Sepaket (All Unbind)" required style="height: 42px;">
                <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-top: 8px;">
                    <span style="font-size: 0.7rem; color: var(--text-dim);">Preset:</span>
                    <button type="button" class="btn btn-outline btn-sm" style="font-size: 0.7rem; padding: 2px 8px;" onclick="document.getElementById('bindInput').value = 'Moonton Sepaket (All Unbind)'">Moonton Sepaket</button>
                    <button type="button" class="btn btn-outline btn-sm" style="font-size: 0.7rem; padding: 2px 8px;" onclick="document.getElementById('bindInput').value = 'Google Play Bersih (Siap Takeover)'">Google Play</button>
                    <button type="button" class="btn btn-outline btn-sm" style="font-size: 0.7rem; padding: 2px 8px;" onclick="document.getElementById('bindInput').value = 'All Unbind / Clean Bind'">All Unbind</button>
                    <button type="button" class="btn btn-outline btn-sm" style="font-size: 0.7rem; padding: 2px 8px;" onclick="document.getElementById('bindInput').value = 'Single Email Bersih'">Single Email</button>
                </div>
                @error('login_bind') <div style="color: var(--danger); font-size: 0.75rem; margin-top: 4px;">{{ $message }}</div> @enderror
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Server / Region <span style="color: var(--danger);">*</span></label>
                <input type="text" id="serverInput" name="server" value="{{ old('server', 'Indonesia') }}" class="input-control" placeholder="Contoh: Indonesia, Asia, Global" required style="height: 42px;">
                <div style="display: flex; gap: 6px; margin-top: 8px;">
                    <span style="font-size: 0.7rem; color: var(--text-dim);">Preset:</span>
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
                <input type="text" name="rank_tier" value="{{ old('rank_tier') }}" class="input-control" placeholder="Contoh: Mythical Glory" style="height: 42px;">
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Winrate / Level</label>
                <input type="text" name="winrate" value="{{ old('winrate') }}" class="input-control" placeholder="Contoh: 68.5% / Lv 70" style="height: 42px;">
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Total Skin</label>
                <input type="number" name="skin_count" value="{{ old('skin_count') }}" class="input-control" placeholder="Contoh: 280" style="height: 42px;">
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Total Hero</label>
                <input type="number" name="hero_count" value="{{ old('hero_count') }}" class="input-control" placeholder="Contoh: 124" style="height: 42px;">
            </div>
        </div>

        <div style="margin-bottom: 18px;">
            <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Ringkasan Pendek (Highlight Akun)</label>
            <input type="text" name="short_description" value="{{ old('short_description') }}" class="input-control" placeholder="Contoh: Akun pribadi tangan pertama, full skin collector siap mabar!" style="height: 42px;">
        </div>

        <div style="margin-bottom: 22px;">
            <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Deskripsi Lengkap & Rincian Spek (Baris per Baris)</label>
            <textarea name="full_specs" rows="5" class="input-control" placeholder="• Rank: Mythical Glory&#10;• Total Skin: 300+ Skin&#10;• Skin Mewah: Collector Chou, KOF Gusion&#10;• Bind: Moonton All Unbind">{{ old('full_specs') }}</textarea>
        </div>

        <!-- 5. Photos & Screenshots -->
        <h3 class="font-heading" style="font-size: 1.25rem; color: var(--primary); margin: 30px 0 20px; border-bottom: 1px solid var(--border); padding-bottom: 8px; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i data-lucide="image" style="width: 20px; height: 20px;"></i>
            5. FOTO THUMBNAIL & GALERI SCREENSHOT
        </h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 18px; margin-bottom: 22px;">
            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Upload Foto Thumbnail Utama</label>
                <input type="file" name="thumbnail_file" class="input-control" accept="image/*">
                <span style="font-size: 0.72rem; color: var(--text-dim); margin: 6px 0 4px; display: block;">Atau masukkan link URL gambar:</span>
                <input type="url" name="thumbnail_url" value="{{ old('thumbnail_url') }}" class="input-control" placeholder="https://contoh-gambar.com/foto.jpg" style="height: 38px;">
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Upload Screenshot Galeri (Banyak Foto)</label>
                <input type="file" name="screenshots[]" multiple class="input-control" accept="image/*">
                <span style="font-size: 0.72rem; color: var(--text-dim); margin-top: 6px; display: block;">Bisa pilih beberapa foto sekaligus (Profil, Skin, Vault, Emblem, dsb).</span>
            </div>
        </div>

        <!-- Badges & Options -->
        <div style="display: flex; flex-wrap: wrap; gap: 24px; margin: 24px 0; padding: 14px 18px; background: var(--bg-surface); border: 1px solid var(--border); border-radius: 8px;">
            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                <input type="checkbox" name="is_verified" value="1" {{ old('is_verified', '1') ? 'checked' : '' }}>
                <span style="font-weight: 700; color: #fff; font-size: 0.85rem;">🛡️ Sertakan Garansi 100% Anti Hackback</span>
            </label>

            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                <span style="font-weight: 700; color: var(--gold); font-size: 0.85rem;">⭐ Akun Rekomendasi / Sultan</span>
            </label>
        </div>

        <!-- Submit Buttons -->
        <div style="padding-top: 20px; border-top: 1px solid var(--border); display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
            <button type="submit" id="submitPartnerAccountBtn" class="btn btn-primary" style="padding: 10px 24px;">
                <i data-lucide="plus-circle" style="width: 18px; height: 18px;"></i>
                <span>Posting Akun Sekarang</span>
            </button>
            <a href="{{ route('partner.accounts.index') }}" class="btn btn-outline" style="padding: 10px 20px;">Batal</a>
            <span id="partnerUploadProgress" style="display: none; color: var(--primary); font-size: 0.85rem; font-weight: 700;">
                ⏳ Mengunggah foto akun...
            </span>
        </div>
    </form>
</div>

@push('scripts')
<script>
    const partnerForm = document.querySelector('form[action="{{ route('partner.accounts.store') }}"]');
    if (partnerForm) {
        partnerForm.addEventListener('submit', function() {
            const btn = document.getElementById('submitPartnerAccountBtn');
            const progress = document.getElementById('partnerUploadProgress');
            if (btn) btn.disabled = true;
            if (progress) progress.style.display = 'inline';
        });
    }
</script>
@endpush
@endsection
