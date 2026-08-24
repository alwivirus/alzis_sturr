@extends('layouts.partner')

@section('title', 'Posting Produk / Akun Baru - Partner Area')
@section('page_title', 'POSTING PRODUK ATAU AKUN BARU')

@section('header_actions')
<a href="{{ route('partner.accounts.index') }}" class="btn btn-secondary btn-sm">
    <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i>
    <span>Kembali ke Stok Saya</span>
</a>
@endsection

@section('content')

<div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 24px; max-width: 960px;">

    <!-- 1. Segmented Product Type Selector -->
    <div style="margin-bottom: 24px;">
        <label style="display: block; font-size: 0.8rem; font-weight: 800; color: var(--text-muted); margin-bottom: 8px; text-transform: uppercase;">
            PILIH TIPE PRODUK:
        </label>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px;">
            <button type="button" id="tab-btn-game" class="partner-type-tab active" onclick="switchPartnerProductType('game_account')">
                <span style="font-size: 1.2rem;">🎮</span>
                <div style="text-align: left;">
                    <div style="font-weight: 800; font-size: 0.88rem; color: #fff;">Akun Game</div>
                    <div style="font-size: 0.72rem; color: var(--text-muted);">MLBB, FF, Genshin, PUBGM</div>
                </div>
            </button>

            <button type="button" id="tab-btn-app" class="partner-type-tab" onclick="switchPartnerProductType('app_premium')">
                <span style="font-size: 1.2rem;">📱</span>
                <div style="text-align: left;">
                    <div style="font-weight: 800; font-size: 0.88rem; color: #fff;">Akun Aplikasi</div>
                    <div style="font-size: 0.72rem; color: var(--text-muted);">CapCut, Alight Motion, Spotify</div>
                </div>
            </button>

            <button type="button" id="tab-btn-service" class="partner-type-tab" onclick="switchPartnerProductType('fast_tournament')">
                <span style="font-size: 1.2rem;">🏆</span>
                <div style="text-align: left;">
                    <div style="font-weight: 800; font-size: 0.88rem; color: #fff;">Fast Tournament & Jasa</div>
                    <div style="font-size: 0.72rem; color: var(--text-muted);">Slot FT, Poster Turnamen</div>
                </div>
            </button>
        </div>
    </div>

    <form action="{{ route('partner.accounts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="product_type" id="product_type_input" value="{{ old('product_type', 'game_account') }}">

        <!-- 1. Main Category & Information -->
        <h3 class="font-heading" style="font-size: 1.15rem; color: var(--primary); margin-bottom: 16px; border-bottom: 1px solid var(--border); padding-bottom: 8px; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i data-lucide="info" style="width: 18px; height: 18px;"></i>
            <span>1. INFORMASI PRODUK</span>
        </h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 14px; margin-bottom: 16px;">
            <div class="form-group">
                <label class="form-label">Kategori</label>
                <select name="game_category_id" id="game_category_select" class="input-control" style="height: 42px;">
                    <option value="">-- Pilih Kategori yang Ada --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('game_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('game_category_id') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Atau Tulis Kategori Baru</label>
                <input type="text" name="new_game_name" value="{{ old('new_game_name') }}" class="input-control" placeholder="Misal: Alight Motion, CapCut..." style="height: 42px;">
            </div>

            <div class="form-group">
                <label class="form-label">Kode SKU Unik <span style="color: var(--danger);">*</span></label>
                <input type="text" name="code" value="{{ old('code', 'AZS-' . strtoupper(Str::random(5))) }}" class="input-control" placeholder="Contoh: AZS-PTR-01" required style="height: 42px;">
                @error('code') <div class="form-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-group" style="margin-bottom: 18px;">
            <label class="form-label" id="partner-title-label">Judul Postingan Produk <span style="color: var(--danger);">*</span></label>
            <input type="text" name="title" id="partner_title_input" value="{{ old('title') }}" class="input-control" placeholder="Contoh: MLBB Mythical Glory 100★ | 5 Collector" required style="height: 42px;">
            @error('title') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <!-- 2. Pricing & Status -->
        <h3 class="font-heading" style="font-size: 1.15rem; color: var(--primary); margin: 24px 0 16px; border-bottom: 1px solid var(--border); padding-bottom: 8px; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i data-lucide="tag" style="width: 18px; height: 18px;"></i>
            <span>2. PENETAPAN HARGA & STATUS</span>
        </h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px; margin-bottom: 18px;">
            <div class="form-group">
                <label class="form-label">Harga Normal (Rp) <span style="color: var(--danger);">*</span></label>
                <input type="number" name="price" value="{{ old('price') }}" class="input-control" placeholder="Contoh: 35000" required style="height: 42px;">
                @error('price') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Harga Promo / Diskon (Rp) (Opsional)</label>
                <input type="number" name="discount_price" value="{{ old('discount_price') }}" class="input-control" placeholder="Contoh: 25000" style="height: 42px;">
                @error('discount_price') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Status Stok <span style="color: var(--danger);">*</span></label>
                <select name="status" class="input-control" required style="height: 42px;">
                    <option value="available" {{ old('status', 'available') == 'available' ? 'selected' : '' }}>🟢 Ready (Tersedia)</option>
                    <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>🔴 Terjual</option>
                    <option value="booked" {{ old('status') == 'booked' ? 'selected' : '' }}>🟡 Booked</option>
                </select>
                @error('status') <div class="form-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- 3A. Khusus Aplikasi (CapCut, Alight Motion, Spotify) -->
        <div id="section-partner-app" style="display: none; background: rgba(245, 158, 11, 0.05); border: 1px solid rgba(245, 158, 11, 0.25); border-radius: 12px; padding: 18px; margin-bottom: 20px;">
            <div style="font-weight: 800; font-size: 0.92rem; color: #fbbf24; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="smartphone" style="width: 16px; height: 16px;"></i>
                <span>Detail Paket Aplikasi (CapCut / Spotify / Alight Motion)</span>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px;">
                <div class="form-group">
                    <label class="form-label">Jumlah Stok Ready</label>
                    <input type="number" name="stock_qty" value="{{ old('stock_qty', 1) }}" min="1" class="input-control" placeholder="Contoh: 10" style="height: 40px;">
                </div>

                <div class="form-group">
                    <label class="form-label">Durasi / Masa Aktif</label>
                    <input type="number" name="duration_value" value="{{ old('duration_value', 1) }}" min="1" class="input-control" placeholder="Contoh: 1, 3, 12" style="height: 40px;">
                </div>

                <div class="form-group">
                    <label class="form-label">Satuan Durasi</label>
                    <select name="duration_unit" class="input-control" style="height: 40px;">
                        <option value="Bulan">Bulan</option>
                        <option value="Hari">Hari</option>
                        <option value="Tahun">Tahun</option>
                        <option value="Lifetime">Lifetime</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Tipe / Varian</label>
                    <select name="account_variant" class="input-control" style="height: 40px;">
                        <option value="Private (Email Sendiri)">Private (Email Pembeli)</option>
                        <option value="Sharing (Hemat)">Sharing (Hemat)</option>
                        <option value="Akun Baru (Fresh)">Akun Fresh</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- 3B. Khusus Akun Game -->
        <div id="section-partner-game">
            <h3 class="font-heading" style="font-size: 1.15rem; color: var(--primary); margin: 24px 0 16px; border-bottom: 1px solid var(--border); padding-bottom: 8px; font-weight: 800; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="shield-check" style="width: 18px; height: 18px;"></i>
                <span>3. PENGATURAN BIND & SERVER GAME</span>
            </h3>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; margin-bottom: 18px;">
                <div class="form-group">
                    <label class="form-label">Status Bind / Login</label>
                    <input type="text" id="partnerBindInput" name="login_bind" value="{{ old('login_bind', 'Moonton Sepaket (All Unbind)') }}" class="input-control" style="height: 40px;">
                </div>

                <div class="form-group">
                    <label class="form-label">Server / Region</label>
                    <input type="text" id="partnerServerInput" name="server" value="{{ old('server', 'Indonesia') }}" class="input-control" style="height: 40px;">
                </div>
            </div>

            <!-- Specs Game -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px; margin-bottom: 18px;">
                <div class="form-group">
                    <label class="form-label">Rank / Tier</label>
                    <input type="text" name="rank_tier" value="{{ old('rank_tier') }}" class="input-control" placeholder="Contoh: Mythic" style="height: 40px;">
                </div>

                <div class="form-group">
                    <label class="form-label">Level Akun</label>
                    <input type="text" name="winrate" value="{{ old('winrate') }}" class="input-control" placeholder="Contoh: Level 50" style="height: 40px;">
                </div>

                <div class="form-group">
                    <label class="form-label">Total Skin</label>
                    <input type="number" name="skin_count" value="{{ old('skin_count') }}" class="input-control" placeholder="Contoh: 150" style="height: 40px;">
                </div>

                <div class="form-group">
                    <label class="form-label">Total Hero</label>
                    <input type="number" name="hero_count" value="{{ old('hero_count') }}" class="input-control" placeholder="Contoh: 100" style="height: 40px;">
                </div>
            </div>
        </div>

        <!-- 4. Deskripsi & Foto -->
        <h3 class="font-heading" style="font-size: 1.15rem; color: var(--primary); margin: 24px 0 16px; border-bottom: 1px solid var(--border); padding-bottom: 8px; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i data-lucide="file-text" style="width: 18px; height: 18px;"></i>
            <span>DESKRIPSI & FOTO</span>
        </h3>

        <div class="form-group" style="margin-bottom: 14px;">
            <label class="form-label">Ringkasan Singkat</label>
            <input type="text" name="short_description" value="{{ old('short_description') }}" class="input-control" placeholder="Contoh: Garansi resmi, proses cepat." style="height: 40px;">
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label class="form-label">Deskripsi Lengkap & Rincian Fitur</label>
            <textarea name="full_specs" rows="4" class="input-control" placeholder="• Detail spesifikasi produk...">{{ old('full_specs') }}</textarea>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; margin-bottom: 20px;">
            <div class="form-group">
                <label class="form-label">Foto Thumbnail Utama</label>
                <input type="file" name="thumbnail_file" class="input-control" accept="image/*">
            </div>

            <div class="form-group">
                <label class="form-label">Screenshot Tambahan</label>
                <input type="file" name="screenshots[]" multiple class="input-control" accept="image/*">
            </div>
        </div>

        <!-- Submit Button -->
        <div style="padding-top: 18px; border-top: 1px solid var(--border); display: flex; align-items: center; gap: 12px;">
            <button type="submit" class="btn btn-primary btn-lg">
                <i data-lucide="plus-circle" style="width: 18px; height: 18px;"></i>
                <span>Simpan & Terbitkan</span>
            </button>
            <a href="{{ route('partner.accounts.index') }}" class="btn btn-secondary btn-lg">Batal</a>
        </div>
    </form>
</div>

<style>
.partner-type-tab {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 14px;
    border-radius: 10px;
    background: #0c121c;
    border: 1px solid rgba(255, 255, 255, 0.08);
    cursor: pointer;
    transition: all 0.2s ease;
    width: 100%;
}
.partner-type-tab.active {
    background: rgba(245, 158, 11, 0.12);
    border: 1px solid #d97706;
}
</style>

@push('scripts')
<script>
    function switchPartnerProductType(type) {
        document.getElementById('product_type_input').value = type;

        document.getElementById('tab-btn-game').classList.remove('active');
        document.getElementById('tab-btn-app').classList.remove('active');
        document.getElementById('tab-btn-service').classList.remove('active');

        const gameBox = document.getElementById('section-partner-game');
        const appBox = document.getElementById('section-partner-app');
        const titleLabel = document.getElementById('partner-title-label');
        const titleInput = document.getElementById('partner_title_input');

        if (type === 'game_account') {
            document.getElementById('tab-btn-game').classList.add('active');
            gameBox.style.display = 'block';
            appBox.style.display = 'none';
            titleLabel.innerHTML = 'Judul Postingan Akun Game <span style="color: var(--danger);">*</span>';
            titleInput.placeholder = 'Contoh: MLBB Mythical Glory 100★ | 5 Collector';
            document.getElementById('partnerBindInput').value = 'Moonton Sepaket (All Unbind)';
            document.getElementById('partnerServerInput').value = 'Indonesia';
        } else if (type === 'app_premium') {
            document.getElementById('tab-btn-app').classList.add('active');
            gameBox.style.display = 'none';
            appBox.style.display = 'block';
            titleLabel.innerHTML = 'Nama Produk / Akun Aplikasi <span style="color: var(--danger);">*</span>';
            titleInput.placeholder = 'Contoh: CapCut Pro 1 Tahun / Spotify Premium 3 Bulan';
            document.getElementById('partnerBindInput').value = 'Email Pembeli / Akun Private';
            document.getElementById('partnerServerInput').value = 'Global';
        } else if (type === 'fast_tournament') {
            document.getElementById('tab-btn-service').classList.add('active');
            gameBox.style.display = 'none';
            appBox.style.display = 'none';
            titleLabel.innerHTML = 'Nama Layanan / Turnamen <span style="color: var(--danger);">*</span>';
            titleInput.placeholder = 'Contoh: Slot Fast Tournament MLBB / Jasa Desain Poster FT';
            document.getElementById('partnerBindInput').value = 'File HD PNG/PDF + Format Bracket';
            document.getElementById('partnerServerInput').value = 'Online Delivery';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        switchPartnerProductType('game_account');
    });
</script>
@endpush
@endsection
