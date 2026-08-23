@extends('layouts.app')

@section('title', 'Profil & Pengaturan Akun - ALZIS STORE')
@section('meta_description', 'Kelola informasi akun profil, foto avatar, wishlist game favorit, dan keamanan kata sandi di ALZIS STORE.')

@section('content')
<div class="container" style="padding: 36px 18px 80px; max-width: 1100px;">

    <!-- Top Profile Banner Card -->
    <div style="background: var(--bg-card); border: 1px solid var(--border-light); border-radius: var(--radius-xl); padding: 32px; margin-bottom: 28px; position: relative; overflow: hidden; box-shadow: var(--shadow-lg), 0 0 30px rgba(0, 242, 254, 0.08);">
        <div style="position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, transparent, var(--primary), var(--accent-purple), transparent);"></div>

        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 24px;">
            <!-- Left: Avatar & Info -->
            <div style="display: flex; align-items: center; gap: 24px; flex-wrap: wrap;">
                <!-- Avatar with glow circle -->
                <div style="position: relative;">
                    <img id="header-avatar-preview" src="{{ $user->avatar_url }}" alt="{{ $user->name }}" width="84" height="84" style="width: 84px; height: 84px; border-radius: 50%; object-fit: cover; border: 2.5px solid var(--primary); box-shadow: 0 0 25px rgba(0, 242, 254, 0.35);">
                    <label for="avatar-input" style="position: absolute; bottom: 0; right: 0; width: 28px; height: 28px; border-radius: 50%; background: var(--primary); color: #050811; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 2px 8px rgba(0,0,0,0.5);" title="Ganti Foto Profil">
                        <svg style="width: 14px; height: 14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                    </label>
                </div>

                <div>
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px; flex-wrap: wrap;">
                        <h1 class="font-heading" style="font-size: 1.85rem; color: #fff; font-weight: 900; line-height: 1.1; margin: 0;">
                            {{ $user->name }}
                        </h1>
                        @if($user->isOwner())
                            <span style="font-size: 0.75rem; padding: 4px 12px; background: rgba(245, 158, 11, 0.15); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.5); border-radius: var(--radius-full); font-weight: 800; display: inline-flex; align-items: center; gap: 4px;">
                                👑 OWNER TOKO
                            </span>
                        @elseif($user->isAdmin())
                            <span style="font-size: 0.75rem; padding: 4px 12px; background: rgba(0, 242, 254, 0.15); color: var(--primary); border: 1px solid rgba(0, 242, 254, 0.4); border-radius: var(--radius-full); font-weight: 800; display: inline-flex; align-items: center; gap: 4px;">
                                🛡️ ADMIN RESMI
                            </span>
                        @else
                            <span style="font-size: 0.75rem; padding: 4px 12px; background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.4); border-radius: var(--radius-full); font-weight: 800; display: inline-flex; align-items: center; gap: 4px;">
                                🎮 MEMBER SULTAN
                            </span>
                        @endif
                    </div>

                    <div style="color: var(--text-muted); font-size: 0.88rem; display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                        <span>{{ $user->email }}</span>
                        <span>&bull;</span>
                        <span>Terdaftar sejak: <strong>{{ $user->created_at ? $user->created_at->translatedFormat('d F Y') : '-' }}</strong></span>
                    </div>
                </div>
            </div>

            <!-- Right: Action Buttons -->
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                @if($user->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm" style="border-radius: var(--radius-full); padding: 8px 20px;">
                        <svg style="width: 15px; height: 15px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>
                        <span>Masuk Panel Admin</span>
                    </a>
                @endif
                <a href="{{ route('wishlist.index') }}" class="btn btn-secondary btn-sm" style="border-radius: var(--radius-full); padding: 8px 18px;">
                    <svg style="width: 15px; height: 15px; color: var(--danger); fill: var(--danger);" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    <span>Wishlist ({{ $wishlistsCount ?? 0 }})</span>
                </a>
            </div>
        </div>

        <!-- Metric Badges Row -->
        <div class="profile-metrics-grid">
            <div style="background: var(--bg-surface); padding: 12px 16px; border-radius: var(--radius-md); border: 1px solid var(--border); display: flex; align-items: center; gap: 10px;">
                <div style="width: 32px; height: 32px; border-radius: var(--radius-sm); background: rgba(0, 242, 254, 0.12); color: var(--primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg style="width: 16px; height: 16px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
                </div>
                <div>
                    <div style="font-size: 0.72rem; color: var(--text-dim); text-transform: uppercase; font-weight: 700;">Status Akun</div>
                    <div style="font-size: 0.85rem; font-weight: 800; color: #fff;">Terverifikasi</div>
                </div>
            </div>

            <div style="background: var(--bg-surface); padding: 12px 16px; border-radius: var(--radius-md); border: 1px solid var(--border); display: flex; align-items: center; gap: 10px;">
                <div style="width: 32px; height: 32px; border-radius: var(--radius-sm); background: rgba(244, 63, 94, 0.12); color: var(--danger); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg style="width: 16px; height: 16px; fill: currentColor;" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                </div>
                <div>
                    <div style="font-size: 0.72rem; color: var(--text-dim); text-transform: uppercase; font-weight: 700;">Akun Wishlist</div>
                    <div style="font-size: 0.85rem; font-weight: 800; color: #fff;">{{ $wishlistsCount ?? 0 }} Tersimpan</div>
                </div>
            </div>

            <div style="background: var(--bg-surface); padding: 12px 16px; border-radius: var(--radius-md); border: 1px solid var(--border); display: flex; align-items: center; gap: 10px;">
                <div style="width: 32px; height: 32px; border-radius: var(--radius-sm); background: rgba(139, 92, 246, 0.12); color: var(--accent-purple); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg style="width: 16px; height: 16px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <div>
                    <div style="font-size: 0.72rem; color: var(--text-dim); text-transform: uppercase; font-weight: 700;">Keamanan Login</div>
                    <div style="font-size: 0.85rem; font-weight: 800; color: #fff;">Password Aktif</div>
                </div>
            </div>

            <div style="background: var(--bg-surface); padding: 12px 16px; border-radius: var(--radius-md); border: 1px solid var(--border); display: flex; align-items: center; gap: 10px;">
                <div style="width: 32px; height: 32px; border-radius: var(--radius-sm); background: rgba(251, 191, 36, 0.12); color: var(--gold); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg style="width: 16px; height: 16px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                </div>
                <div>
                    <div style="font-size: 0.72rem; color: var(--text-dim); text-transform: uppercase; font-weight: 700;">Garansi Toko</div>
                    <div style="font-size: 0.85rem; font-weight: 800; color: #fff;">Anti HB 100%</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Forms Grid: Profile & Security -->
    <div class="profile-forms-grid">
        
        <!-- Form 1: Edit Profile & Avatar Upload -->
        <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-xl); padding: 28px; box-shadow: var(--shadow-card);">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px;">
                <div style="width: 36px; height: 36px; border-radius: var(--radius-sm); background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg style="width: 18px; height: 18px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <h3 class="font-heading" style="font-size: 1.25rem; color: #fff; font-weight: 800; margin: 0;">
                    Edit Informasi Profil
                </h3>
            </div>
            <p style="color: var(--text-muted); font-size: 0.84rem; margin-bottom: 22px; line-height: 1.5;">
                Ubah nama akun, foto profil avatar, alamat email login, dan nomor WhatsApp kontak.
            </p>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Avatar Upload Section -->
                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="form-label">Foto Profil / Avatar</label>
                    <div style="display: flex; align-items: center; gap: 16px; background: var(--bg-surface); padding: 14px; border-radius: var(--radius-md); border: 1px dashed var(--border-light);">
                        <img id="form-avatar-preview" src="{{ $user->avatar_url }}" alt="Preview" width="56" height="56" style="width: 56px; height: 56px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary); flex-shrink: 0;">
                        <div style="flex: 1;">
                            <input type="file" id="avatar-input" name="avatar" accept="image/png,image/jpeg,image/jpg,image/webp" style="display: none;" onchange="previewAvatar(this)">
                            <label for="avatar-input" class="btn btn-secondary btn-sm" style="cursor: pointer; display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px;">
                                <svg style="width: 14px; height: 14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                <span>Pilih Foto Baru</span>
                            </label>
                            <div style="font-size: 0.72rem; color: var(--text-dim); margin-top: 4px;">JPG, PNG, atau WEBP (Maksimal 3MB)</div>
                        </div>
                    </div>
                    @error('avatar') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="name">Nama Akun <span style="color: var(--danger);">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="input-control" required placeholder="Contoh: Sakaki Gamer">
                    @error('name') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Alamat Email Login <span style="color: var(--danger);">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="input-control" required placeholder="nama@email.com">
                    <span style="font-size: 0.76rem; color: var(--text-dim); margin-top: 4px; display: block;">Email ini digunakan saat masuk / login ke website.</span>
                    @error('email') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group" style="margin-bottom: 24px;">
                    <label class="form-label" for="phone">Nomor WhatsApp / Kontak (Opsional)</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" class="input-control" placeholder="Contoh: 081234567890">
                    <span style="font-size: 0.76rem; color: var(--text-dim); margin-top: 4px; display: block;">Untuk kemudahan koordinasi transaksi akun game.</span>
                    @error('phone') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; border-radius: var(--radius-md); padding: 12px;">
                    <svg style="width: 16px; height: 16px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span>Simpan Perubahan Profil</span>
                </button>
            </form>
        </div>

        <!-- Form 2: Password Security -->
        <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-xl); padding: 28px; box-shadow: var(--shadow-card);">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px;">
                <div style="width: 36px; height: 36px; border-radius: var(--radius-sm); background: rgba(139, 92, 246, 0.12); color: var(--accent-purple); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg style="width: 18px; height: 18px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <h3 class="font-heading" style="font-size: 1.25rem; color: #fff; font-weight: 800; margin: 0;">
                    Keamanan & Ganti Password
                </h3>
            </div>
            <p style="color: var(--text-muted); font-size: 0.84rem; margin-bottom: 22px; line-height: 1.5;">
                Gunakan kata sandi yang kuat dan unik minimal 6 karakter untuk melindungi akun Anda.
            </p>

            <form action="{{ route('profile.password') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label" for="current_password">Password Saat Ini <span style="color: var(--danger);">*</span></label>
                    <input type="password" id="current_password" name="current_password" class="input-control" required placeholder="Masukkan password lama">
                    @error('current_password') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="new_password">Password Baru <span style="color: var(--danger);">*</span></label>
                    <input type="password" id="new_password" name="password" class="input-control" required placeholder="Minimal 6 karakter">
                    @error('password') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group" style="margin-bottom: 24px;">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password Baru <span style="color: var(--danger);">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="input-control" required placeholder="Ulangi password baru">
                </div>

                <button type="submit" class="btn btn-secondary" style="width: 100%; border-radius: var(--radius-md); padding: 12px; border-color: rgba(139, 92, 246, 0.4); color: #fff;">
                    <svg style="width: 16px; height: 16px; color: var(--accent-purple);" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
                    <span>Perbarui Kata Sandi</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Wishlist Quick Banner -->
    <div style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius-xl); padding: 24px; margin-top: 28px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
        <div style="display: flex; align-items: center; gap: 14px;">
            <div style="width: 44px; height: 44px; border-radius: var(--radius-md); background: rgba(244, 63, 94, 0.12); color: var(--danger); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg style="width: 22px; height: 22px; fill: currentColor;" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
            </div>
            <div>
                <h4 style="font-size: 1.05rem; font-weight: 800; color: #fff; margin: 0;">Wishlist Akun Game Favorit Anda</h4>
                <p style="font-size: 0.84rem; color: var(--text-muted); margin: 2px 0 0;">Anda memiliki {{ $wishlistsCount ?? 0 }} akun yang ditandai agar mudah dipantau statusnya.</p>
            </div>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('wishlist.index') }}" class="btn btn-secondary btn-sm" style="border-radius: var(--radius-full); padding: 8px 18px;">
                <span>Buka Wishlist</span>
                <svg style="width: 14px; height: 14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
            <a href="{{ route('catalog') }}" class="btn btn-primary btn-sm" style="border-radius: var(--radius-full); padding: 8px 18px;">
                <span>Cari Akun Lain</span>
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const headerImg = document.getElementById('header-avatar-preview');
                const formImg = document.getElementById('form-avatar-preview');
                if (headerImg) headerImg.src = e.target.result;
                if (formImg) formImg.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection
