@extends('layouts.partner')

@section('title', 'Edit Produk #' . $account->code . ' - Panel Mitra Partner')
@section('page_title', 'EDIT POSTINGAN PRODUK: #' . $account->code)

@section('header_actions')
<a href="{{ route('partner.accounts.index') }}" class="btn btn-outline btn-sm">
    <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i>
    <span>Kembali ke Stok Saya</span>
</a>
@endsection

@section('content')

<div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 28px; max-width: 960px;">

    <!-- 1. Segmented Product Type Selector -->
    <div style="margin-bottom: 24px;">
        <label style="display: block; font-size: 0.8rem; font-weight: 800; color: var(--text-muted); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">
            TIPE PRODUK POSTINGAN:
        </label>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 10px;">
            <button type="button" id="tab-btn-game" class="partner-type-tab {{ old('product_type', $account->product_type ?? 'game_account') === 'game_account' ? 'active' : '' }}" onclick="switchPartnerProductType('game_account')">
                <span style="font-size: 1.2rem;">🎮</span>
                <div style="text-align: left;">
                    <div style="font-weight: 800; font-size: 0.88rem; color: #fff;">Akun Game</div>
                    <div style="font-size: 0.72rem; color: var(--text-muted);">MLBB, FF, Genshin, PUBGM</div>
                </div>
            </button>

            <button type="button" id="tab-btn-app" class="partner-type-tab {{ old('product_type', $account->product_type ?? '') === 'app_premium' ? 'active' : '' }}" onclick="switchPartnerProductType('app_premium')">
                <span style="font-size: 1.2rem;">📱</span>
                <div style="text-align: left;">
                    <div style="font-weight: 800; font-size: 0.88rem; color: #fff;">Akun Aplikasi</div>
                    <div style="font-size: 0.72rem; color: var(--text-muted);">Canva, CapCut, Spotify, dll.</div>
                </div>
            </button>

            <button type="button" id="tab-btn-service" class="partner-type-tab {{ old('product_type', $account->product_type ?? '') === 'fast_tournament' ? 'active' : '' }}" onclick="switchPartnerProductType('fast_tournament')">
                <span style="font-size: 1.2rem;">🏆</span>
                <div style="text-align: left;">
                    <div style="font-weight: 800; font-size: 0.88rem; color: #fff;">Fast Tournament (FT)</div>
                    <div style="font-size: 0.72rem; color: var(--text-muted);">Slot Turnamen MLBB, FF</div>
                </div>
            </button>
        </div>
    </div>

    <form action="{{ route('partner.accounts.update', $account->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="product_type" id="product_type_input" value="{{ old('product_type', $account->product_type ?? 'game_account') }}">

        <!-- 1. Main Category & Information -->
        <h3 class="font-heading" style="font-size: 1.15rem; color: var(--primary); margin-bottom: 16px; border-bottom: 1px solid var(--border); padding-bottom: 8px; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i data-lucide="info" style="width: 18px; height: 18px;"></i>
            <span>1. INFORMASI PRODUK & KATEGORI</span>
        </h3>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 14px; margin-bottom: 16px;">
            <div class="form-group">
                <label class="form-label">Kategori</label>
                <select name="game_category_id" id="game_category_select" class="input-control" style="height: 42px;">
                    <option value="">-- Pilih Kategori yang Ada --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('game_category_id', $account->game_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('game_category_id') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Atau Ubah / Tulis Kategori Baru</label>
                <input type="text" name="new_game_name" value="{{ old('new_game_name') }}" class="input-control" placeholder="Misal: Canva, CapCut, Roblox..." style="height: 42px;">
            </div>

            <div class="form-group">
                <label class="form-label">Kode SKU Unik <span style="color: var(--danger);">*</span></label>
                <input type="text" name="code" value="{{ old('code', $account->code) }}" class="input-control" required style="height: 42px; font-family: monospace; font-weight: 700;">
                @error('code') <div class="form-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-group" style="margin-bottom: 18px;">
            <label class="form-label" id="partner-title-label">Judul Postingan Produk <span style="color: var(--danger);">*</span></label>
            <input type="text" name="title" id="partner_title_input" value="{{ old('title', $account->title) }}" class="input-control" required style="height: 42px;">
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
                <input type="number" name="price" value="{{ old('price', (int)$account->price) }}" class="input-control" required style="height: 42px; font-weight: 700;">
                @error('price') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Harga Promo / Diskon (Rp) (Opsional)</label>
                <input type="number" name="discount_price" value="{{ old('discount_price', $account->discount_price ? (int)$account->discount_price : '') }}" class="input-control" placeholder="Biarkan kosong jika tidak ada diskon" style="height: 42px;">
                @error('discount_price') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Status Stok <span style="color: var(--danger);">*</span></label>
                <select name="status" class="input-control" required style="height: 42px; font-weight: 700;">
                    <option value="available" {{ old('status', $account->status) == 'available' ? 'selected' : '' }}>🟢 Ready (Tersedia)</option>
                    <option value="sold" {{ old('status', $account->status) == 'sold' ? 'selected' : '' }}>🔴 Terjual (Sold Out)</option>
                    <option value="booked" {{ old('status', $account->status) == 'booked' ? 'selected' : '' }}>🟡 Booked (DP Masuk)</option>
                </select>
                @error('status') <div class="form-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <!-- 3. WhatsApp Contact & Safety Recommendation Banner -->
        <div style="background: linear-gradient(135deg, rgba(30, 41, 59, 0.7) 0%, rgba(15, 23, 42, 0.8) 100%); border: 1px solid rgba(245, 158, 11, 0.3); border-radius: 12px; padding: 18px; margin-bottom: 22px;">
            <div class="form-group" style="margin-bottom: 12px;">
                <label class="form-label" style="color: #fbbf24; font-weight: 800; display: flex; align-items: center; gap: 6px;">
                    <i data-lucide="phone-call" style="width: 16px; height: 16px;"></i>
                    <span>Nomor WhatsApp Anda (Kontak Penjual / Mitra)</span>
                </label>
                <input type="text" name="partner_phone" value="{{ old('partner_phone', Auth::user()->phone) }}" class="input-control" placeholder="Contoh: 081234567890" style="height: 42px;">
                <span class="form-helper">Nomor WhatsApp aktif Anda yang dapat dihubungi pembeli.</span>
            </div>

            <!-- Warning and Recommendation Notice Box -->
            <div style="background: rgba(15, 23, 42, 0.9); border: 1px dashed rgba(245, 158, 11, 0.4); border-radius: 8px; padding: 12px 14px;">
                <div style="font-size: 0.76rem; font-weight: 800; color: #fbbf24; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
                    <i data-lucide="alert-triangle" style="width: 14px; height: 14px;"></i>
                    <span>PERINGATAN SAAT PRODUK MUNCUL DI KATALOG (SETELAH BARANG DI-UPLOAD):</span>
                </div>
                <p style="font-size: 0.74rem; color: #cbd5e1; margin: 0 0 8px 0; line-height: 1.45;">
                    Nomor WhatsApp ini akan tampil pada tombol kontak Mitra di halaman detail produk katalog untuk konsultasi spesifikasi dengan pembeli.
                </p>

                <div style="font-size: 0.76rem; font-weight: 800; color: #34d399; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
                    <i data-lucide="shield-check" style="width: 14px; height: 14px;"></i>
                    <span>SARAN RESMI KEAMANAN TRANSAKSI:</span>
                </div>
                <p style="font-size: 0.74rem; color: #94a3b8; margin: 0; line-height: 1.45;">
                    Utamakan dan sarankan pembeli selalu bertransaksi menggunakan <strong style="color: #fff;">Nomor WhatsApp Admin Utama ALZIS STORE sebagai MC / Rekber Resmi (Anti-Rip)</strong> demi menjaga keamanan transaksi 100% dan mencegah risiko penipuan / sengketa kedua belah pihak.
                </p>
            </div>
        </div>

        <!-- 4A. Khusus Aplikasi (Canva, CapCut, Spotify, Alight Motion) -->
        <div id="section-partner-app" style="display: none; background: rgba(245, 158, 11, 0.05); border: 1px solid rgba(245, 158, 11, 0.25); border-radius: 12px; padding: 18px; margin-bottom: 20px;">
            <div style="font-weight: 800; font-size: 0.92rem; color: #fbbf24; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="smartphone" style="width: 16px; height: 16px;"></i>
                <span>Detail Paket Aplikasi (Canva / CapCut / Spotify / Alight Motion)</span>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px;">
                <div class="form-group">
                    <label class="form-label">Jumlah Stok Ready</label>
                    <input type="number" name="stock_qty" value="{{ old('stock_qty', $account->stock_qty ?: 1) }}" min="1" class="input-control" placeholder="Contoh: 10" style="height: 40px;">
                </div>

                <div class="form-group">
                    <label class="form-label">Durasi / Masa Aktif</label>
                    <input type="number" name="duration_value" value="{{ old('duration_value', $account->duration_value ?: 1) }}" min="1" class="input-control" placeholder="Contoh: 1, 3, 12" style="height: 40px;">
                </div>

                <div class="form-group">
                    <label class="form-label">Satuan Durasi</label>
                    <select name="duration_unit" class="input-control" style="height: 40px;">
                        <option value="Bulan" {{ old('duration_unit', $account->duration_unit) == 'Bulan' ? 'selected' : '' }}>Bulan</option>
                        <option value="Hari" {{ old('duration_unit', $account->duration_unit) == 'Hari' ? 'selected' : '' }}>Hari</option>
                        <option value="Tahun" {{ old('duration_unit', $account->duration_unit) == 'Tahun' ? 'selected' : '' }}>Tahun</option>
                        <option value="Lifetime" {{ old('duration_unit', $account->duration_unit) == 'Lifetime' ? 'selected' : '' }}>Lifetime (Selamanya)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Tipe / Varian</label>
                    <select name="account_variant" class="input-control" style="height: 40px;">
                        <option value="Private (Email Sendiri)" {{ old('account_variant', $account->account_variant) == 'Private (Email Sendiri)' ? 'selected' : '' }}>Private (Email Pembeli)</option>
                        <option value="Sharing (Hemat)" {{ old('account_variant', $account->account_variant) == 'Sharing (Hemat)' ? 'selected' : '' }}>Sharing (Hemat)</option>
                        <option value="Akun Baru (Fresh)" {{ old('account_variant', $account->account_variant) == 'Akun Baru (Fresh)' ? 'selected' : '' }}>Akun Fresh</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- 4B. Khusus Fast Tournament -->
        <div id="section-partner-ft" style="display: none; background: rgba(245, 158, 11, 0.05); border: 1px solid rgba(245, 158, 11, 0.25); border-radius: 12px; padding: 18px; margin-bottom: 20px;">
            <div style="font-weight: 800; font-size: 0.92rem; color: #fbbf24; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="trophy" style="width: 16px; height: 16px;"></i>
                <span>Detail Fast Tournament (FT)</span>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px;">
                <div class="form-group">
                    <label class="form-label">Slot Tersedia</label>
                    <input type="number" name="ft_stock_qty" value="{{ old('stock_qty', $account->stock_qty ?: 16) }}" min="1" class="input-control" placeholder="Contoh: 16, 32" style="height: 40px;" onchange="document.querySelector('input[name=stock_qty]').value = this.value;">
                </div>

                <div class="form-group">
                    <label class="form-label">Format / Ketentuan</label>
                    <input type="text" name="ft_login_bind" value="{{ old('login_bind', $account->login_bind) }}" class="input-control" placeholder="Contoh: Grup WA Peserta" style="height: 40px;" onchange="document.getElementById('partnerBindInput').value = this.value;">
                </div>
            </div>
        </div>

        <!-- 4C. Khusus Akun Game -->
        <div id="section-partner-game">
            <h3 class="font-heading" style="font-size: 1.15rem; color: var(--primary); margin: 24px 0 16px; border-bottom: 1px solid var(--border); padding-bottom: 8px; font-weight: 800; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="shield-check" style="width: 18px; height: 18px;"></i>
                <span>3. PENGATURAN BIND & SERVER GAME</span>
            </h3>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; margin-bottom: 18px;">
                <div class="form-group">
                    <label class="form-label">Status Bind / Login</label>
                    <input type="text" id="partnerBindInput" name="login_bind" value="{{ old('login_bind', $account->login_bind) }}" class="input-control" style="height: 40px;">
                    <div style="display: flex; flex-wrap: wrap; gap: 5px; margin-top: 6px;">
                        <button type="button" class="btn btn-outline btn-sm" style="font-size: 0.68rem; padding: 2px 7px;" onclick="document.getElementById('partnerBindInput').value = 'Moonton Sepaket (All Unbind)'">Moonton Sepaket</button>
                        <button type="button" class="btn btn-outline btn-sm" style="font-size: 0.68rem; padding: 2px 7px;" onclick="document.getElementById('partnerBindInput').value = 'Google Play Bersih'">Google Play</button>
                        <button type="button" class="btn btn-outline btn-sm" style="font-size: 0.68rem; padding: 2px 7px;" onclick="document.getElementById('partnerBindInput').value = 'All Unbind / Clean Bind'">All Unbind</button>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Server / Region</label>
                    <input type="text" id="partnerServerInput" name="server" value="{{ old('server', $account->server) }}" class="input-control" style="height: 40px;">
                    <div style="display: flex; gap: 5px; margin-top: 6px;">
                        <button type="button" class="btn btn-outline btn-sm" style="font-size: 0.68rem; padding: 2px 7px;" onclick="document.getElementById('partnerServerInput').value = 'Indonesia'">Indonesia</button>
                        <button type="button" class="btn btn-outline btn-sm" style="font-size: 0.68rem; padding: 2px 7px;" onclick="document.getElementById('partnerServerInput').value = 'Asia'">Asia</button>
                        <button type="button" class="btn btn-outline btn-sm" style="font-size: 0.68rem; padding: 2px 7px;" onclick="document.getElementById('partnerServerInput').value = 'Global'">Global</button>
                    </div>
                </div>
            </div>

            <!-- Specs Game -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px; margin-bottom: 18px;">
                <div class="form-group">
                    <label class="form-label">Rank / Tier</label>
                    <input type="text" name="rank_tier" value="{{ old('rank_tier', $account->rank_tier) }}" class="input-control" placeholder="Contoh: Mythic" style="height: 40px;">
                </div>

                <div class="form-group">
                    <label class="form-label">Level / Winrate</label>
                    <input type="text" name="winrate" value="{{ old('winrate', $account->winrate) }}" class="input-control" placeholder="Contoh: Level 50" style="height: 40px;">
                </div>

                <div class="form-group">
                    <label class="form-label">Total Skin</label>
                    <input type="number" name="skin_count" value="{{ old('skin_count', $account->skin_count) }}" class="input-control" placeholder="Contoh: 150" style="height: 40px;">
                </div>

                <div class="form-group">
                    <label class="form-label">Total Hero</label>
                    <input type="number" name="hero_count" value="{{ old('hero_count', $account->hero_count) }}" class="input-control" placeholder="Contoh: 100" style="height: 40px;">
                </div>
            </div>
        </div>

        <!-- 5. Deskripsi & Foto -->
        <h3 class="font-heading" style="font-size: 1.15rem; color: var(--primary); margin: 24px 0 16px; border-bottom: 1px solid var(--border); padding-bottom: 8px; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i data-lucide="file-text" style="width: 18px; height: 18px;"></i>
            <span>DESKRIPSI & FOTO</span>
        </h3>

        <div class="form-group" style="margin-bottom: 14px;">
            <label class="form-label">Ringkasan Singkat</label>
            <input type="text" name="short_description" value="{{ old('short_description', $account->short_description) }}" class="input-control" placeholder="Contoh: Garansi resmi, proses cepat." style="height: 40px;">
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label class="form-label">Deskripsi Lengkap & Rincian Fitur</label>
            <textarea name="full_specs" rows="4" class="input-control">{{ old('full_specs', $account->full_specs) }}</textarea>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; margin-bottom: 20px;">
            <div class="form-group">
                <label class="form-label">Ganti Foto Thumbnail</label>
                @if($account->thumbnail)
                <div style="width: 120px; height: 75px; border-radius: 8px; overflow: hidden; margin-bottom: 8px; border: 1px solid var(--border);">
                    <img src="{{ $account->thumbnail_url }}" alt="Current" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                @endif
                <input type="file" name="thumbnail_file" class="input-control" accept="image/*">
                <span class="form-helper">Atau ubah link URL foto:</span>
                <input type="url" name="thumbnail_url" value="{{ old('thumbnail_url', str_starts_with($account->thumbnail ?? '', 'http') ? $account->thumbnail : '') }}" class="input-control" style="margin-top: 6px; height: 40px;" placeholder="https://contoh.com/foto.jpg">
            </div>

            <div class="form-group">
                <label class="form-label">Tambah Screenshot Baru</label>
                <input type="file" name="screenshots[]" multiple class="input-control" accept="image/*">
                <span class="form-helper">Bisa pilih beberapa foto sekaligus.</span>

                @if($account->images->count() > 0)
                <div style="margin-top: 10px;">
                    <span style="font-size: 0.72rem; color: var(--text-muted); display: block; margin-bottom: 4px;">Foto Galeri Saat Ini:</span>
                    <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                        @foreach($account->images as $img)
                        <div style="width: 55px; height: 40px; border-radius: 4px; overflow: hidden; border: 1px solid var(--border);">
                            <img src="{{ $img->image_url }}" alt="Gallery" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        <div style="padding-top: 16px; border-top: 1px solid var(--border); display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
            <button type="submit" class="btn btn-primary btn-lg">
                <i data-lucide="save" style="width: 18px; height: 18px;"></i>
                <span>Simpan Perubahan</span>
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
    background: #0e1524;
    border: 1px solid rgba(255, 255, 255, 0.08);
    cursor: pointer;
    transition: all 0.2s ease;
    width: 100%;
}
.partner-type-tab:hover {
    border-color: rgba(245, 158, 11, 0.35);
    background: #141c2e;
}
.partner-type-tab.active {
    background: rgba(245, 158, 11, 0.12);
    border: 1px solid #d97706;
    box-shadow: 0 4px 12px rgba(217, 119, 6, 0.15);
}
</style>

@push('scripts')
<script>
    function switchPartnerProductType(type) {
        document.getElementById('product_type_input').value = type;

        document.getElementById('tab-btn-game').classList.remove('active');
        document.getElementById('tab-btn-app').classList.remove('active');
        document.getElementById('tab-btn-service').classList.remove('active');

        const gameSec = document.getElementById('section-partner-game');
        const appSec = document.getElementById('section-partner-app');
        const ftSec = document.getElementById('section-partner-ft');

        const titleLabel = document.getElementById('partner-title-label');
        const titleInput = document.getElementById('partner_title_input');

        if (type === 'game_account') {
            document.getElementById('tab-btn-game').classList.add('active');
            gameSec.style.display = 'block';
            appSec.style.display = 'none';
            ftSec.style.display = 'none';

            titleLabel.innerHTML = 'Judul Postingan Akun Game <span style="color: var(--danger);">*</span>';
            titleInput.placeholder = 'Contoh: MLBB Mythical Glory 100★ | 5 Collector';
        } else if (type === 'app_premium') {
            document.getElementById('tab-btn-app').classList.add('active');
            gameSec.style.display = 'none';
            appSec.style.display = 'block';
            ftSec.style.display = 'none';

            titleLabel.innerHTML = 'Nama Produk / Akun Aplikasi <span style="color: var(--danger);">*</span>';
            titleInput.placeholder = 'Contoh: Canva Pro 1 Tahun Private Email / Spotify Premium';
        } else if (type === 'fast_tournament') {
            document.getElementById('tab-btn-service').classList.add('active');
            gameSec.style.display = 'none';
            appSec.style.display = 'none';
            ftSec.style.display = 'block';

            titleLabel.innerHTML = 'Nama Layanan / Turnamen <span style="color: var(--danger);">*</span>';
            titleInput.placeholder = 'Contoh: Slot Fast Tournament MLBB Season 5';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const currentType = document.getElementById('product_type_input').value || '{{ $account->product_type ?? "game_account" }}';
        switchPartnerProductType(currentType);
    });
</script>
@endpush
@endsection
