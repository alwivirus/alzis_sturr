@extends('layouts.admin')

@section('title', 'Tambah Stok Produk & Akun - ALZIS STORE Admin')
@section('page_title', 'TAMBAH POSTINGAN PRODUK & STOK BARU')

@section('header_actions')
<a href="{{ route('admin.accounts.index') }}" class="btn btn-secondary btn-sm">
    <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i>
    <span>Kembali ke Daftar</span>
</a>
@endsection

@section('content')

<div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 24px; max-width: 1000px;">
    
    <!-- 1. Product Type Segmented Selector -->
    <div style="margin-bottom: 24px;">
        <label style="display: block; font-size: 0.8rem; font-weight: 800; color: var(--text-muted); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">
            PILIH TIPE PRODUK YANG INGIN DITAMBAHKAN:
        </label>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px;">
            <button type="button" id="tab-btn-game" class="type-switcher-tab active" onclick="switchProductType('game_account')">
                <span style="font-size: 1.25rem;">🎮</span>
                <div style="text-align: left;">
                    <div style="font-weight: 800; font-size: 0.9rem; color: #fff;">Akun Game</div>
                    <div style="font-size: 0.72rem; color: var(--text-muted);">MLBB, FF, Genshin, PUBGM, dll.</div>
                </div>
            </button>

            <button type="button" id="tab-btn-app" class="type-switcher-tab" onclick="switchProductType('app_premium')">
                <span style="font-size: 1.25rem;">📱</span>
                <div style="text-align: left;">
                    <div style="font-weight: 800; font-size: 0.9rem; color: #fff;">Akun Aplikasi</div>
                    <div style="font-size: 0.72rem; color: var(--text-muted);">CapCut, Alight Motion, Spotify, dll.</div>
                </div>
            </button>

            <button type="button" id="tab-btn-service" class="type-switcher-tab" onclick="switchProductType('fast_tournament')">
                <span style="font-size: 1.25rem;">🏆</span>
                <div style="text-align: left;">
                    <div style="font-weight: 800; font-size: 0.9rem; color: #fff;">Fast Tournament (FT)</div>
                    <div style="font-size: 0.72rem; color: var(--text-muted);">Slot Turnamen MLBB, FF, PUBGM</div>
                </div>
            </button>
        </div>
    </div>

    <form action="{{ route('admin.accounts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="product_type" id="product_type_input" value="{{ old('product_type', 'game_account') }}">

        <!-- 2. Informasi Utama Produk -->
        <h3 class="font-heading" style="font-size: 1.15rem; color: var(--primary); margin-bottom: 16px; border-bottom: 1px solid var(--border); padding-bottom: 8px; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i data-lucide="info" style="width: 18px; height: 18px;"></i>
            <span id="section1-title">1. INFORMASI UTAMA & KATEGORI</span>
        </h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 14px; margin-bottom: 16px;">
            <div class="form-group">
                <label class="form-label" id="category-select-label">Pilih Kategori</label>
                <select name="game_category_id" id="game_category_select" class="input-control">
                    <option value="">-- Pilih Kategori yang Ada --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('game_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('game_category_id') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" id="new-category-label">Atau Tulis Kategori / Nama Baru</label>
                <input type="text" name="new_game_name" value="{{ old('new_game_name') }}" class="input-control" placeholder="Misal: Alight Motion, CapCut, Roblox, Steam...">
                <span class="form-helper" style="font-size: 0.72rem; color: #fbbf24;">Tulis nama jika belum ada di pilihan list.</span>
            </div>

            <div class="form-group">
                <label class="form-label">Kode SKU / Kode Produk <span style="color: var(--danger);">*</span></label>
                <input type="text" name="code" value="{{ old('code', 'AZS-' . strtoupper(Str::random(5))) }}" class="input-control" placeholder="Contoh: AZS-CAPCUT-01" required>
                @error('code') <div class="form-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-group" style="margin-bottom: 18px;">
            <label class="form-label" id="product-title-label">Judul Postingan Produk <span style="color: var(--danger);">*</span></label>
            <input type="text" name="title" id="product_title_input" value="{{ old('title') }}" class="input-control" placeholder="Contoh: MLBB Mythical Glory 100★ | 5 Collector + 2 KOF" required>
            @error('title') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <!-- 3. Penetapan Harga & Status Stok -->
        <h3 class="font-heading" style="font-size: 1.15rem; color: var(--primary); margin: 24px 0 16px; border-bottom: 1px solid var(--border); padding-bottom: 8px; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i data-lucide="tag" style="width: 18px; height: 18px;"></i>
            <span>2. PENETAPAN HARGA & STATUS STOK</span>
        </h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px; margin-bottom: 18px;">
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
                <label class="form-label">Status Ketersediaan <span style="color: var(--danger);">*</span></label>
                <select name="status" class="input-control" required>
                    <option value="available" {{ old('status', 'available') == 'available' ? 'selected' : '' }}>🟢 Ready (Tersedia)</option>
                    <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>🔴 Terjual (Sold Out)</option>
                    <option value="booked" {{ old('status') == 'booked' ? 'selected' : '' }}>🟡 Booked (DP Masuk)</option>
                </select>
                @error('status') <div class="form-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- 4A. KHUSUS PRODUK APLIKASI (CapCut, Alight Motion, Spotify) -->
        <div id="section-app-details" style="display: none; background: rgba(245, 158, 11, 0.05); border: 1px solid rgba(245, 158, 11, 0.25); border-radius: 12px; padding: 18px; margin-bottom: 20px;">
            <div style="font-weight: 800; font-size: 0.95rem; color: #fbbf24; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="smartphone" style="width: 18px; height: 18px;"></i>
                <span>Detail Paket Aplikasi (CapCut / Alight Motion / Spotify)</span>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px;">
                <div class="form-group">
                    <label class="form-label">Jumlah Stok Ready (Akun)</label>
                    <input type="number" name="stock_qty" value="{{ old('stock_qty', 1) }}" min="1" class="input-control" placeholder="Contoh: 10">
                    <span class="form-helper">Berapa akun ready untuk dijual</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Durasi / Masa Aktif</label>
                    <input type="number" name="duration_value" value="{{ old('duration_value', 1) }}" min="1" class="input-control" placeholder="Contoh: 1, 3, 12, 30">
                    <span class="form-helper">Angka durasi</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Satuan Durasi</label>
                    <select name="duration_unit" class="input-control">
                        <option value="Bulan" {{ old('duration_unit') == 'Bulan' ? 'selected' : '' }}>Bulan</option>
                        <option value="Hari" {{ old('duration_unit') == 'Hari' ? 'selected' : '' }}>Hari</option>
                        <option value="Tahun" {{ old('duration_unit') == 'Tahun' ? 'selected' : '' }}>Tahun</option>
                        <option value="Lifetime" {{ old('duration_unit') == 'Lifetime' ? 'selected' : '' }}>Lifetime (Selamanya)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Tipe / Varian Akun</label>
                    <select name="account_variant" class="input-control">
                        <option value="Private (Email Sendiri)" {{ old('account_variant') == 'Private (Email Sendiri)' ? 'selected' : '' }}>Private (Email Pembeli)</option>
                        <option value="Sharing (Hemat)" {{ old('account_variant') == 'Sharing (Hemat)' ? 'selected' : '' }}>Sharing (Hemat)</option>
                        <option value="Akun Baru (Fresh)" {{ old('account_variant') == 'Akun Baru (Fresh)' ? 'selected' : '' }}>Akun Fresh (Dari Penjual)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- 4B. KHUSUS FAST TOURNAMENT (Slot Turnamen FT) -->
        <div id="section-ft-details" style="display: none; background: rgba(245, 158, 11, 0.05); border: 1px solid rgba(245, 158, 11, 0.25); border-radius: 12px; padding: 18px; margin-bottom: 20px;">
            <div style="font-weight: 800; font-size: 0.95rem; color: #fbbf24; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="trophy" style="width: 18px; height: 18px;"></i>
                <span>Detail Fast Tournament (FT)</span>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px;">
                <div class="form-group">
                    <label class="form-label">Slot Tersedia / Kapasitas</label>
                    <input type="number" name="ft_stock_qty" value="{{ old('stock_qty', 16) }}" min="1" class="input-control" placeholder="Contoh: 16, 32 Slot" onchange="document.querySelector('input[name=stock_qty]').value = this.value;">
                    <span class="form-helper">Jumlah slot yang dibuka</span>
                </div>

                <div class="form-group">
                    <label class="form-label">Format / Ketentuan Turnamen</label>
                    <input type="text" name="ft_login_bind" value="{{ old('login_bind', 'Slot Tim / Grup WhatsApp Peserta') }}" class="input-control" placeholder="Contoh: Grup WA Peserta" onchange="document.getElementById('bindInput').value = this.value;">
                </div>
            </div>
        </div>

        <!-- 4C. KHUSUS AKUN GAME (Bind & Server & Game Specs) -->
        <div id="section-game-details">
            <h3 class="font-heading" style="font-size: 1.15rem; color: var(--primary); margin: 24px 0 16px; border-bottom: 1px solid var(--border); padding-bottom: 8px; font-weight: 800; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="shield-check" style="width: 18px; height: 18px;"></i>
                <span>3. PENGATURAN BIND & SERVER GAME</span>
            </h3>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; margin-bottom: 18px;">
                <div class="form-group">
                    <label class="form-label">Status Bind / Login Akun</label>
                    <input type="text" id="bindInput" name="login_bind" value="{{ old('login_bind', 'Moonton Sepaket (All Unbind)') }}" class="input-control" placeholder="Contoh: Moonton Sepaket (All Unbind)">
                    <div style="display: flex; flex-wrap: wrap; gap: 5px; margin-top: 6px;">
                        <button type="button" class="btn btn-secondary btn-sm" style="font-size: 0.68rem; padding: 2px 7px;" onclick="document.getElementById('bindInput').value = 'Moonton Sepaket (All Unbind)'">Moonton Sepaket</button>
                        <button type="button" class="btn btn-secondary btn-sm" style="font-size: 0.68rem; padding: 2px 7px;" onclick="document.getElementById('bindInput').value = 'Google Play Bersih'">Google Play</button>
                        <button type="button" class="btn btn-secondary btn-sm" style="font-size: 0.68rem; padding: 2px 7px;" onclick="document.getElementById('bindInput').value = 'All Unbind / Clean Bind'">All Unbind</button>
                        <button type="button" class="btn btn-secondary btn-sm" style="font-size: 0.68rem; padding: 2px 7px;" onclick="document.getElementById('bindInput').value = 'Riot / Hoyoverse Single Email'">Riot/Hoyoverse</button>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Server / Region Game</label>
                    <input type="text" id="serverInput" name="server" value="{{ old('server', 'Indonesia') }}" class="input-control" placeholder="Contoh: Indonesia, Asia, Global">
                    <div style="display: flex; gap: 5px; margin-top: 6px;">
                        <button type="button" class="btn btn-secondary btn-sm" style="font-size: 0.68rem; padding: 2px 7px;" onclick="document.getElementById('serverInput').value = 'Indonesia'">Indonesia</button>
                        <button type="button" class="btn btn-secondary btn-sm" style="font-size: 0.68rem; padding: 2px 7px;" onclick="document.getElementById('serverInput').value = 'Asia'">Asia</button>
                        <button type="button" class="btn btn-secondary btn-sm" style="font-size: 0.68rem; padding: 2px 7px;" onclick="document.getElementById('serverInput').value = 'Global'">Global</button>
                    </div>
                </div>
            </div>

            <!-- Specs Game -->
            <h3 class="font-heading" style="font-size: 1.15rem; color: var(--primary); margin: 24px 0 16px; border-bottom: 1px solid var(--border); padding-bottom: 8px; font-weight: 800; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="swords" style="width: 18px; height: 18px;"></i>
                <span>4. ATRIBUT & SPESIFIKASI GAME</span>
            </h3>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px; margin-bottom: 18px;">
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
        </div>

        <!-- 5. Deskripsi & Rincian Produk -->
        <h3 class="font-heading" style="font-size: 1.15rem; color: var(--primary); margin: 24px 0 16px; border-bottom: 1px solid var(--border); padding-bottom: 8px; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i data-lucide="file-text" style="width: 18px; height: 18px;"></i>
            <span>DESKRIPSI & RINCIAN ITEM</span>
        </h3>

        <div class="form-group" style="margin-bottom: 14px;">
            <label class="form-label">Ringkasan Singkat (Short Highlight)</label>
            <input type="text" name="short_description" value="{{ old('short_description') }}" class="input-control" placeholder="Contoh: Garansi resmi full, proses cepat 5 menit langsung aktif.">
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label class="form-label">Deskripsi Lengkap & Rincian Fitur (Baris per Baris)</label>
            <textarea name="full_specs" id="full_specs_textarea" rows="5" class="input-control" placeholder="• Masa Aktif: 1 Tahun&#10;• Fitur: Unlock Semua Fitur Pro, No Watermark&#10;• Garansi: Anti Drop / Garansi Ganti Baru">{{ old('full_specs') }}</textarea>
        </div>

        <!-- 6. Foto Thumbnail & Galeri -->
        <h3 class="font-heading" style="font-size: 1.15rem; color: var(--primary); margin: 24px 0 16px; border-bottom: 1px solid var(--border); padding-bottom: 8px; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i data-lucide="image" style="width: 18px; height: 18px;"></i>
            <span>FOTO THUMBNAIL & GALERI</span>
        </h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; margin-bottom: 20px;">
            <div class="form-group">
                <label class="form-label">Upload Foto Thumbnail Utama</label>
                <input type="file" name="thumbnail_file" class="input-control" accept="image/*">
                <span class="form-helper">Atau link URL foto langsung:</span>
                <input type="url" name="thumbnail_url" value="{{ old('thumbnail_url') }}" class="input-control" style="margin-top: 6px;" placeholder="https://contoh-gambar.com/foto.jpg">
            </div>

            <div class="form-group">
                <label class="form-label">Upload Screenshot Tambahan (Opsional)</label>
                <input type="file" name="screenshots[]" multiple class="input-control" accept="image/*">
                <span class="form-helper">Bisa pilih beberapa foto sekaligus.</span>
            </div>
        </div>

        <!-- Badges & Options -->
        <div style="display: flex; flex-wrap: wrap; gap: 20px; margin: 20px 0;">
            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                <input type="checkbox" name="is_verified" value="1" {{ old('is_verified', '1') ? 'checked' : '' }}>
                <span style="font-weight: 600; color: #fff; font-size: 0.88rem;">🛡️ Tampilkan Badge Garansi Transaksi Resmi</span>
            </label>

            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                <span style="font-weight: 600; color: #fbbf24; font-size: 0.88rem;">⭐ Tampilkan di Bagian Rekomendasi Populer</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div style="padding-top: 18px; border-top: 1px solid var(--border); display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
            <button type="submit" id="submitAccountBtn" class="btn btn-primary btn-lg">
                <i data-lucide="plus-circle" style="width: 18px; height: 18px;"></i>
                <span id="submitBtnText">Simpan & Terbitkan Produk</span>
            </button>
            <a href="{{ route('admin.accounts.index') }}" class="btn btn-secondary btn-lg">Batal</a>
            <span id="uploadProgressText" style="display: none; color: var(--primary); font-size: 0.85rem; font-weight: 700;">
                ⏳ Mengunggah Foto...
            </span>
        </div>
    </form>
</div>

<style>
.type-switcher-tab {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 14px;
    border-radius: 12px;
    background: #0c121c;
    border: 1px solid rgba(255, 255, 255, 0.08);
    cursor: pointer;
    transition: all 0.2s ease;
    width: 100%;
}
.type-switcher-tab:hover {
    border-color: rgba(245, 158, 11, 0.3);
    background: #111827;
}
.type-switcher-tab.active {
    background: rgba(245, 158, 11, 0.12);
    border: 1px solid #d97706;
    box-shadow: 0 4px 14px rgba(217, 119, 6, 0.15);
}
</style>

@push('scripts')
<script>
    function switchProductType(type) {
        document.getElementById('product_type_input').value = type;

        document.getElementById('tab-btn-game').classList.remove('active');
        document.getElementById('tab-btn-app').classList.remove('active');
        document.getElementById('tab-btn-service').classList.remove('active');

        const gameDetails = document.getElementById('section-game-details');
        const appDetails = document.getElementById('section-app-details');
        const ftDetails = document.getElementById('section-ft-details');

        const titleLabel = document.getElementById('product-title-label');
        const titleInput = document.getElementById('product_title_input');
        const specsArea = document.getElementById('full_specs_textarea');

        if (type === 'game_account') {
            document.getElementById('tab-btn-game').classList.add('active');
            gameDetails.style.display = 'block';
            appDetails.style.display = 'none';
            ftDetails.style.display = 'none';

            titleLabel.innerHTML = 'Judul Postingan Akun Game <span style="color: var(--danger);">*</span>';
            titleInput.placeholder = 'Contoh: MLBB Mythical Glory 100★ | 5 Collector + 2 KOF';
            document.getElementById('bindInput').value = 'Moonton Sepaket (All Unbind)';
            document.getElementById('serverInput').value = 'Indonesia';
        } else if (type === 'app_premium') {
            document.getElementById('tab-btn-app').classList.add('active');
            gameDetails.style.display = 'none';
            appDetails.style.display = 'block';
            ftDetails.style.display = 'none';

            titleLabel.innerHTML = 'Nama Produk / Akun Aplikasi <span style="color: var(--danger);">*</span>';
            titleInput.placeholder = 'Contoh: CapCut Pro 1 Tahun Private Email Sendiri / Spotify Premium 3 Bulan';
            document.getElementById('bindInput').value = 'Email Pembeli / Akun Private';
            document.getElementById('serverInput').value = 'Global';
        } else if (type === 'fast_tournament') {
            document.getElementById('tab-btn-service').classList.add('active');
            gameDetails.style.display = 'none';
            appDetails.style.display = 'none';
            ftDetails.style.display = 'block';

            titleLabel.innerHTML = 'Nama Layanan / Turnamen <span style="color: var(--danger);">*</span>';
            titleInput.placeholder = 'Contoh: Slot Fast Tournament MLBB Season 5 / Jasa Desain Poster FT HD';
            document.getElementById('bindInput').value = 'File HD PNG/PDF + Format Bracket';
            document.getElementById('serverInput').value = 'Online Delivery (WA/Discord)';
        }
    }

    // Initialize initial state on load
    document.addEventListener('DOMContentLoaded', function() {
        const currentType = document.getElementById('product_type_input').value || 'game_account';
        switchProductType(currentType);
    });
</script>
@endpush
@endsection
