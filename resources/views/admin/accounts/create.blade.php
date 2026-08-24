@extends('layouts.admin')

@section('title', 'Tambah Stok Akun Game - ALzis STURR Admin')
@section('page_title', 'TAMBAH POSTINGAN STOK AKUN BARU')

@section('header_actions')
<a href="{{ route('admin.accounts.index') }}" class="btn btn-secondary btn-sm">
    <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i>
    <span>Kembali ke Daftar</span>
</a>
@endsection

@section('content')

<div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 32px; max-width: 1000px;">
    
    <form action="{{ route('admin.accounts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Basic Information -->
        <h3 class="font-gaming" style="font-size: 1.3rem; color: var(--primary); margin-bottom: 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
            1. INFORMASI UTAMA & GAME
        </h3>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px;">
            <div class="form-group">
                <label class="form-label">Pilih Kategori Game</label>
                <select name="game_category_id" id="game_category_select" class="input-control">
                    <option value="">-- Pilih Game yang Ada --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('game_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('game_category_id') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Atau Tulis Game Baru (Bebas)</label>
                <input type="text" name="new_game_name" value="{{ old('new_game_name') }}" class="input-control" placeholder="Misal: Roblox, FC Mobile, Honkai, PB, Steam...">
                <span class="form-helper" style="font-size: 0.725rem; color: #38bdf8;">Tulis nama game baru jika tidak ada di list atas.</span>
            </div>

            <div class="form-group">
                <label class="form-label">Kode Akun (SKU Unik) <span style="color: var(--danger);">*</span></label>
                <input type="text" name="code" value="{{ old('code', 'AZS-' . strtoupper(Str::random(5))) }}" class="input-control" placeholder="Contoh: AZS-ML-05" required>
                @error('code') <div class="form-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Judul Postingan Akun <span style="color: var(--danger);">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" class="input-control" placeholder="Contoh: MLBB Mythical Glory 100★ | 5 Collector + 2 KOF + Lesley Aspirants" required>
            @error('title') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <!-- Pricing & Status -->
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label class="form-label">Harga Normal (Rp) <span style="color: var(--danger);">*</span></label>
                <input type="number" name="price" value="{{ old('price') }}" class="input-control" placeholder="Contoh: 35000" required>
                @error('price') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Harga Promo / Diskon (Rp) (Opsional)</label>
                <input type="number" name="discount_price" value="{{ old('discount_price') }}" class="input-control" placeholder="Contoh: 25000">
                <span class="form-helper">Biarkan kosong jika tidak ada diskon</span>
                @error('discount_price') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Status Stok <span style="color: var(--danger);">*</span></label>
                <select name="status" class="input-control" required>
                    <option value="available" {{ old('status', 'available') == 'available' ? 'selected' : '' }}>🟢 Ready (Tersedia)</option>
                    <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>🔴 Terjual (Sold Out)</option>
                    <option value="booked" {{ old('status') == 'booked' ? 'selected' : '' }}>🟡 Booked (DP Masuk)</option>
                </select>
                @error('status') <div class="form-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- Khusus Produk Aplikasi / Digital (CapCut, Spotify, Alight Motion, FT) -->
        <div style="background: rgba(245, 158, 11, 0.05); border: 1px dashed rgba(245, 158, 11, 0.3); border-radius: 12px; padding: 18px 20px; margin: 24px 0;">
            <div style="font-weight: 800; font-size: 0.95rem; color: #fbbf24; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="sparkles" style="width: 18px; height: 18px;"></i>
                <span>Pengaturan Khusus Aplikasi & Digital (CapCut / Alight Motion / Spotify / FT)</span>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 14px;">
                <div class="form-group">
                    <label class="form-label">Jumlah Stok Ready</label>
                    <input type="number" name="stock_qty" value="{{ old('stock_qty', 1) }}" min="1" class="input-control" placeholder="Contoh: 10">
                    <span class="form-helper">Jumlah akun/slot yang tersedia</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Durasi / Masa Aktif</label>
                    <input type="number" name="duration_value" value="{{ old('duration_value') }}" min="1" class="input-control" placeholder="Contoh: 1, 3, 12, 30">
                    <span class="form-helper">Berapa hari/bulan/tahun</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Satuan Durasi</label>
                    <select name="duration_unit" class="input-control">
                        <option value="Bulan" {{ old('duration_unit') == 'Bulan' ? 'selected' : '' }}>Bulan</option>
                        <option value="Hari" {{ old('duration_unit') == 'Hari' ? 'selected' : '' }}>Hari</option>
                        <option value="Tahun" {{ old('duration_unit') == 'Tahun' ? 'selected' : '' }}>Tahun</option>
                        <option value="Lifetime" {{ old('duration_unit') == 'Lifetime' ? 'selected' : '' }}>Lifetime (Selamanya)</option>
                        <option value="Slot" {{ old('duration_unit') == 'Slot' ? 'selected' : '' }}>Per Slot (Turnamen)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Tipe / Varian Akun</label>
                    <select name="account_variant" class="input-control">
                        <option value="Private (Email Sendiri)" {{ old('account_variant') == 'Private (Email Sendiri)' ? 'selected' : '' }}>Private (Email Sendiri)</option>
                        <option value="Sharing (Hemat)" {{ old('account_variant') == 'Sharing (Hemat)' ? 'selected' : '' }}>Sharing (Hemat)</option>
                        <option value="Akun Baru (Fresh)" {{ old('account_variant') == 'Akun Baru (Fresh)' ? 'selected' : '' }}>Akun Baru (Fresh)</option>
                        <option value="Jasa / Slot FT" {{ old('account_variant') == 'Jasa / Slot FT' ? 'selected' : '' }}>Jasa / Slot FT</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Bind & Server Configuration -->
        <h3 class="font-gaming" style="font-size: 1.3rem; color: var(--primary); margin: 30px 0 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
            2. PENGATURAN BIND & SERVER
        </h3>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label class="form-label">Status Bind / Login Akun <span style="color: var(--danger);">*</span></label>
                <input type="text" id="bindInput" name="login_bind" value="{{ old('login_bind') }}" class="input-control" placeholder="Contoh: Moonton Sepaket (All Unbind)" required>
                <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-top: 8px;">
                    <span style="font-size: 0.7rem; color: var(--text-sub);">Preset Cepat:</span>
                    <button type="button" class="btn btn-secondary btn-sm" style="font-size: 0.7rem; padding: 2px 8px;" onclick="document.getElementById('bindInput').value = 'Moonton Sepaket (All Unbind)'">Moonton Sepaket</button>
                    <button type="button" class="btn btn-secondary btn-sm" style="font-size: 0.7rem; padding: 2px 8px;" onclick="document.getElementById('bindInput').value = 'Google Play Bersih (Siap Takeover)'">Google Play</button>
                    <button type="button" class="btn btn-secondary btn-sm" style="font-size: 0.7rem; padding: 2px 8px;" onclick="document.getElementById('bindInput').value = 'All Unbind / Clean Bind (Siap Kaitkan)'">All Unbind / Clean</button>
                    <button type="button" class="btn btn-secondary btn-sm" style="font-size: 0.7rem; padding: 2px 8px;" onclick="document.getElementById('bindInput').value = 'Single Login Facebook (FB Nonaktif)'">Single FB</button>
                    <button type="button" class="btn btn-secondary btn-sm" style="font-size: 0.7rem; padding: 2px 8px;" onclick="document.getElementById('bindInput').value = 'Riot Games / Hoyoverse Single Email'">Riot/Hoyoverse</button>
                </div>
                @error('login_bind') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Server / Region <span style="color: var(--danger);">*</span></label>
                <input type="text" id="serverInput" name="server" value="{{ old('server', 'Indonesia') }}" class="input-control" placeholder="Contoh: Indonesia, Asia, Global" required>
                <div style="display: flex; gap: 6px; margin-top: 8px;">
                    <span style="font-size: 0.7rem; color: var(--text-sub);">Preset:</span>
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
                <input type="text" name="rank_tier" value="{{ old('rank_tier') }}" class="input-control" placeholder="Contoh: Mythical Glory">
            </div>

            <div class="form-group">
                <label class="form-label">Level Akun</label>
                <input type="text" name="winrate" value="{{ old('winrate') }}" class="input-control" placeholder="Contoh: Level 66 / Lv 100">
            </div>

            <div class="form-group">
                <label class="form-label">Total Skin</label>
                <input type="number" name="skin_count" value="{{ old('skin_count') }}" class="input-control" placeholder="Contoh: 280">
            </div>

            <div class="form-group">
                <label class="form-label">Total Hero</label>
                <input type="number" name="hero_count" value="{{ old('hero_count') }}" class="input-control" placeholder="Contoh: 124">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Ringkasan Pendek (Short Highlight)</label>
            <input type="text" name="short_description" value="{{ old('short_description') }}" class="input-control" placeholder="Contoh: Akun pribadi tangan pertama, full skin collector siap mabar!">
        </div>

        <div class="form-group">
            <label class="form-label">Deskripsi Lengkap & Rincian Spek (Baris per Baris)</label>
            <textarea name="full_specs" rows="6" class="input-control" placeholder="• Rank: Mythical Glory&#10;• Total Skin: 300+ Skin&#10;• Skin Mewah: Collector Chou, KOF Gusion&#10;• Bind: Moonton All Unbind&#10;• Garansi: Anti Hackback seumur hidup">{{ old('full_specs') }}</textarea>
        </div>

        <!-- Photos & Screenshots -->
        <h3 class="font-gaming" style="font-size: 1.3rem; color: var(--primary); margin: 30px 0 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
            4. FOTO THUMBNAIL & GALERI SCREENSHOT
        </h3>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label class="form-label">Upload Foto Thumbnail Utama</label>
                <input type="file" name="thumbnail_file" class="input-control" accept="image/*">
                <span class="form-helper">Atau masukkan link URL foto jika tidak upload file:</span>
                <input type="url" name="thumbnail_url" value="{{ old('thumbnail_url') }}" class="input-control" style="margin-top: 6px;" placeholder="https://contoh-gambar.com/foto.jpg">
            </div>

            <div class="form-group">
                <label class="form-label">Upload Screenshot Tambahan (Multi Foto)</label>
                <input type="file" name="screenshots[]" multiple class="input-control" accept="image/*">
                <span class="form-helper">Bisa pilih beberapa foto sekaligus (Lobby, Vault, Skin, Emblem, dsb).</span>
            </div>
        </div>

        <!-- Badges & Options -->
        <div style="display: flex; gap: 30px; margin: 24px 0;">
            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                <input type="checkbox" name="is_verified" value="1" {{ old('is_verified', '1') ? 'checked' : '' }}>
                <span style="font-weight: 600; color: #fff;">🛡️ Tampilkan Badge Garansi 100% Anti Hackback</span>
            </label>

            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                <span style="font-weight: 600; color: var(--accent-gold);">⭐ Jadikan Akun Rekomendasi (Featured di Beranda)</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div style="padding-top: 20px; border-top: 1px solid var(--border-color); display: flex; align-items: center; gap: 12px;">
            <button type="submit" id="submitAccountBtn" class="btn btn-primary btn-lg">
                <i data-lucide="plus-circle" style="width: 20px; height: 20px;"></i>
                <span id="submitBtnText">Simpan & Terbitkan Akun</span>
            </button>
            <a href="{{ route('admin.accounts.index') }}" class="btn btn-secondary btn-lg">Batal</a>
            <span id="uploadProgressText" style="display: none; color: var(--primary); font-size: 0.85rem; font-weight: 700;">
                ⏳ Mengoptimalkan & Mengunggah Foto...
            </span>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Client-side automatic image compression helper
    async function compressImageFile(file, maxWidth = 1920, quality = 0.85) {
        if (!file || !file.type.startsWith('image/')) return file;
        return new Promise((resolve) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = (event) => {
                const img = new Image();
                img.src = event.target.result;
                img.onload = () => {
                    let width = img.width;
                    let height = img.height;
                    if (width > maxWidth) {
                        height = Math.round((height * maxWidth) / width);
                        width = maxWidth;
                    }
                    const canvas = document.createElement('canvas');
                    canvas.width = width;
                    canvas.height = height;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, width, height);
                    canvas.toBlob((blob) => {
                        if (blob && blob.size < file.size) {
                            const newFile = new File([blob], file.name.replace(/\.[^/.]+$/, "") + ".jpg", {
                                type: 'image/jpeg',
                                lastModified: Date.now()
                            });
                            resolve(newFile);
                        } else {
                            resolve(file);
                        }
                    }, 'image/jpeg', quality);
                };
                img.onerror = () => resolve(file);
            };
            reader.onerror = () => resolve(file);
        });
    }

    const accountForm = document.querySelector('form[action="{{ route('admin.accounts.store') }}"]');
    if (accountForm) {
        let isCompressing = false;
        accountForm.addEventListener('submit', async function(e) {
            if (isCompressing) return;
            
            const thumbInput = document.querySelector('input[name="thumbnail_file"]');
            const screenshotsInput = document.querySelector('input[name="screenshots[]"]');
            
            const hasThumb = thumbInput && thumbInput.files && thumbInput.files.length > 0;
            const hasScreenshots = screenshotsInput && screenshotsInput.files && screenshotsInput.files.length > 0;
            
            if (hasThumb || hasScreenshots) {
                e.preventDefault();
                isCompressing = true;
                
                const submitBtn = document.getElementById('submitAccountBtn');
                const progressText = document.getElementById('uploadProgressText');
                if (submitBtn) submitBtn.disabled = true;
                if (progressText) progressText.style.display = 'inline';

                try {
                    // Compress thumbnail if present
                    if (hasThumb) {
                        const compressedThumb = await compressImageFile(thumbInput.files[0], 1280, 0.85);
                        const dt = new DataTransfer();
                        dt.items.add(compressedThumb);
                        thumbInput.files = dt.files;
                    }

                    // Compress multi screenshots
                    if (hasScreenshots) {
                        const dt = new DataTransfer();
                        for (let i = 0; i < screenshotsInput.files.length; i++) {
                            const compressed = await compressImageFile(screenshotsInput.files[i], 1920, 0.82);
                            dt.items.add(compressed);
                        }
                        screenshotsInput.files = dt.files;
                    }
                } catch (err) {
                    console.error("Compression error:", err);
                }

                accountForm.submit();
            }
        });
    }
</script>
@endpush
@endsection
