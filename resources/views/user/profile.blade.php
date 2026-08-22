@extends('layouts.app')

@section('title', 'Profil Akun Saya - ALzis STURR')

@section('content')
<div class="container" style="padding: 40px 20px 90px; max-width: 1040px;">
    <!-- Profile Header Banner -->
    <div style="background: linear-gradient(135deg, rgba(14, 22, 38, 0.9) 0%, rgba(9, 13, 22, 0.95) 100%); border: 1px solid rgba(0, 242, 254, 0.25); border-radius: 24px; padding: 32px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 24px; margin-bottom: 36px; box-shadow: 0 16px 40px rgba(0,0,0,0.7); position: relative; overflow: hidden;">
        <div style="position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, transparent, #00f2fe, #a855f7, transparent);"></div>

        <div style="display: flex; align-items: center; gap: 22px;">
            <div style="width: 72px; height: 72px; border-radius: 50%; background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%); display: flex; align-items: center; justify-content: center; font-family: var(--font-gaming); font-size: 2rem; font-weight: 800; color: #090d16; box-shadow: 0 0 25px rgba(0, 242, 254, 0.45);">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px;">
                    <h2 class="font-gaming" style="font-size: 1.8rem; color: #fff; line-height: 1;">{{ $user->name }}</h2>
                    @if($user->isOwner())
                        <span style="font-size: 0.75rem; padding: 4px 12px; background: rgba(245, 158, 11, 0.15); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.5); border-radius: var(--radius-full); font-weight: 700;">
                            👑 OWNER TOKO
                        </span>
                    @elseif($user->isAdmin())
                        <span style="font-size: 0.75rem; padding: 4px 12px; background: rgba(0, 242, 254, 0.15); color: #00f2fe; border: 1px solid rgba(0, 242, 254, 0.4); border-radius: var(--radius-full); font-weight: 700;">
                            🛡️ ADMIN RESMI
                        </span>
                    @else
                        <span style="font-size: 0.75rem; padding: 4px 12px; background: rgba(148, 163, 184, 0.15); color: #cbd5e1; border: 1px solid rgba(148, 163, 184, 0.3); border-radius: var(--radius-full); font-weight: 700;">
                            🎮 MEMBER SULTAN
                        </span>
                    @endif
                </div>
                <div style="color: #94a3b8; font-size: 0.92rem;">
                    {{ $user->email }} &bull; Terdaftar sejak: {{ $user->created_at->translatedFormat('d F Y') }}
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 12px; flex-wrap: wrap;">
            @if($user->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm" style="border-radius: var(--radius-full); padding: 8px 20px;">
                    <i data-lucide="layout-dashboard" style="width: 16px; height: 16px;"></i>
                    <span>Masuk Panel Admin</span>
                </a>
            @endif
            <a href="{{ route('wishlist.index') }}" class="btn btn-secondary btn-sm" style="border-radius: var(--radius-full); padding: 8px 18px;">
                <i data-lucide="heart" style="width: 16px; height: 16px; color: #f43f5e;"></i>
                <span>Wishlist ({{ $wishlistsCount ?? 0 }})</span>
            </a>
        </div>
    </div>

    <!-- Forms Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(360px, 1fr)); gap: 28px;">
        <!-- Profil Data -->
        <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 20px; padding: 32px;">
            <h3 class="font-gaming" style="font-size: 1.4rem; color: #fff; margin-bottom: 6px; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="user-cog" style="width: 20px; height: 20px; color: var(--primary);"></i>
                INFORMASI & EMAIL LOGIN
            </h3>
            <p style="color: #94a3b8; font-size: 0.88rem; margin-bottom: 24px; line-height: 1.5;">
                Ganti nama tampilan, email login, dan nomor WhatsApp Anda di bawah ini.
            </p>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group" style="margin-bottom: 18px;">
                    <label class="form-label">Nama Akun <span style="color: var(--danger);">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input-control" required placeholder="Nama Anda">
                    @error('name') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group" style="margin-bottom: 18px;">
                    <label class="form-label">Alamat Email Login <span style="color: var(--danger);">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="input-control" required placeholder="emailpribadi@gmail.com">
                    <span class="form-helper" style="font-size: 0.78rem; color: #64748b; margin-top: 4px; display: block;">Email ini digunakan saat masuk / login ke website.</span>
                    @error('email') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group" style="margin-bottom: 24px;">
                    <label class="form-label">Nomor Kontak / WhatsApp (Opsional)</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="input-control" placeholder="08xxxxxxxxxx">
                    @error('phone') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; border-radius: 12px; padding: 12px;">
                    <i data-lucide="save" style="width: 16px; height: 16px;"></i>
                    <span>Simpan Perubahan Profil</span>
                </button>
            </form>
        </div>

        <!-- Password Update -->
        <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 20px; padding: 32px;">
            <h3 class="font-gaming" style="font-size: 1.4rem; color: #fff; margin-bottom: 6px; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="key" style="width: 20px; height: 20px; color: #a855f7;"></i>
                KEAMANAN & GANTI PASSWORD
            </h3>
            <p style="color: #94a3b8; font-size: 0.88rem; margin-bottom: 24px; line-height: 1.5;">
                Gunakan kata sandi baru yang kuat minimal 8 karakter dengan kombinasi huruf & angka.
            </p>

            <form action="{{ route('profile.password') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group" style="margin-bottom: 18px;">
                    <label class="form-label">Password Saat Ini <span style="color: var(--danger);">*</span></label>
                    <input type="password" name="current_password" class="input-control" required placeholder="Masukkan password lama">
                    @error('current_password') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group" style="margin-bottom: 18px;">
                    <label class="form-label">Password Baru <span style="color: var(--danger);">*</span></label>
                    <input type="password" name="password" class="input-control" required placeholder="Minimal 8 karakter">
                    @error('password') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group" style="margin-bottom: 24px;">
                    <label class="form-label">Konfirmasi Password Baru <span style="color: var(--danger);">*</span></label>
                    <input type="password" name="password_confirmation" class="input-control" required placeholder="Ulangi password baru">
                </div>

                <button type="submit" class="btn btn-secondary" style="width: 100%; border-radius: 12px; padding: 12px; border-color: rgba(168,85,247,0.4);">
                    <i data-lucide="shield-check" style="width: 16px; height: 16px; color: #a855f7;"></i>
                    <span>Perbarui Kata Sandi</span>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
