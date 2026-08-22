@extends('layouts.app')

@section('title', 'Profil Akun Saya - ALzis STURR')

@section('content')
<div class="container" style="padding: 40px 20px 80px; max-width: 960px;">
    <!-- Profile Header Banner -->
    <div style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.9) 0%, rgba(30, 27, 75, 0.8) 100%); border: 1px solid var(--border-glow); border-radius: var(--radius-lg); padding: 28px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px; margin-bottom: 30px; box-shadow: var(--shadow-glow);">
        <div style="display: flex; align-items: center; gap: 20px;">
            <div style="width: 68px; height: 68px; border-radius: 50%; background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%); display: flex; align-items: center; justify-content: center; font-family: var(--font-gaming); font-size: 1.8rem; font-weight: 800; color: #090d16; box-shadow: 0 0 20px rgba(0, 242, 254, 0.4);">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 4px;">
                    <h2 class="font-gaming" style="font-size: 1.6rem; color: #fff; line-height: 1;">{{ $user->name }}</h2>
                    @if($user->isAdmin())
                        <span class="badge-status badge-available" style="position: static; font-size: 0.75rem; padding: 3px 10px; background: rgba(0, 242, 254, 0.15); color: #38bdf8; border: 1px solid rgba(0, 242, 254, 0.4);">
                            👑 ADMIN UTAMA
                        </span>
                    @else
                        <span class="badge-status" style="position: static; font-size: 0.75rem; padding: 3px 10px; background: rgba(148, 163, 184, 0.15); color: #cbd5e1; border: 1px solid rgba(148, 163, 184, 0.3);">
                            🎮 MEMBER
                        </span>
                    @endif
                </div>
                <div style="color: var(--text-muted); font-size: 0.9rem;">
                    {{ $user->email }} &bull; Bergabung: {{ $user->created_at->translatedFormat('d F Y') }}
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 12px;">
            @if($user->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm">
                    <i data-lucide="layout-dashboard" style="width: 16px; height: 16px;"></i>
                    <span>Masuk Admin Panel</span>
                </a>
            @endif
            <a href="{{ route('wishlist.index') }}" class="btn btn-secondary btn-sm">
                <i data-lucide="heart" style="width: 16px; height: 16px; color: #f43f5e;"></i>
                <span>Wishlist ({{ $wishlistsCount ?? 0 }})</span>
            </a>
        </div>
    </div>

    <!-- Forms Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 24px;">
        <!-- Profil Data -->
        <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 28px;">
            <h3 class="font-gaming" style="font-size: 1.3rem; color: #fff; margin-bottom: 6px; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="user-cog" style="width: 20px; height: 20px; color: var(--primary);"></i>
                Informasi & Email Login
            </h3>
            <p style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 20px;">
                Ganti nama, email login akun admin/pribadi, dan nomor kontak Anda di sini.
            </p>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">Nama Akun <span style="color: var(--danger);">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input-control" required placeholder="Nama Anda">
                    @error('name') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Alamat Email Login <span style="color: var(--danger);">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="input-control" required placeholder="emailpribadi@gmail.com">
                    <span class="form-helper">Email ini digunakan untuk login masuk ke sistem website/admin.</span>
                    @error('email') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Nomor Kontak / HP (Opsional)</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="input-control" placeholder="08xxxxxxxxxx">
                    @error('phone') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary" style="margin-top: 10px; width: 100%;">
                    <i data-lucide="save" style="width: 16px; height: 16px;"></i>
                    <span>Simpan Perubahan Profil</span>
                </button>
            </form>
        </div>

        <!-- Password Update -->
        <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 28px;">
            <h3 class="font-gaming" style="font-size: 1.3rem; color: #fff; margin-bottom: 6px; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="key" style="width: 20px; height: 20px; color: var(--secondary);"></i>
                Keamanan & Ganti Password
            </h3>
            <p style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 20px;">
                Pastikan menggunakan kata sandi yang kuat dan tidak mudah ditebak.
            </p>

            <form action="{{ route('profile.password') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">Kata Sandi Saat Ini <span style="color: var(--danger);">*</span></label>
                    <input type="password" name="current_password" class="input-control" required placeholder="Masukkan password lama">
                    @error('current_password') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Kata Sandi Baru <span style="color: var(--danger);">*</span></label>
                    <input type="password" name="password" class="input-control" required placeholder="Minimal 6 karakter">
                    @error('password') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Ulangi Kata Sandi Baru <span style="color: var(--danger);">*</span></label>
                    <input type="password" name="password_confirmation" class="input-control" required placeholder="Ulangi kata sandi baru">
                </div>

                <button type="submit" class="btn btn-secondary" style="margin-top: 10px; width: 100%;">
                    <i data-lucide="shield-check" style="width: 16px; height: 16px;"></i>
                    <span>Perbarui Kata Sandi</span>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
