@extends('layouts.app')

@section('title', 'Daftar Akun Baru - ALzis STURR')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <div class="brand-logo" style="justify-content: center; margin-bottom: 8px;">
                <span class="text-gradient-cyan">ALZIS</span>
                <span class="logo-badge">STURR</span>
            </div>
            <h1 class="auth-title">DAFTAR AKUN BARU</h1>
            <p class="auth-subtitle">Bergabung dengan ribuan gamer sultan di ALzis STURR.</p>
        </div>

        <!-- Google OAuth Button -->
        <a href="{{ route('auth.google') }}" class="btn btn-google" style="width: 100%; margin-bottom: 20px; display: flex; align-items: center; justify-content: center; gap: 10px;">
            <svg width="18" height="18" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
            </svg>
            <span>Daftar Cepat via Google</span>
        </a>

        <div class="divider-text">
            <span>atau isi form pendaftaran</span>
        </div>

        <form action="{{ route('register.post') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label" for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="input-control" placeholder="Contoh: Sakaki Gamer" required autofocus>
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="input-control" placeholder="nama@email.com" required>
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="phone">Nomor HP / Kontak (Opsional)</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="input-control" placeholder="Contoh: 081234567890">
                @error('phone')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" class="input-control" placeholder="Minimal 6 karakter" required>
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="input-control" placeholder="Ulangi kata sandi" required>
            </div>

            <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; margin-top: 10px;">
                <i data-lucide="user-plus" style="width: 18px; height: 18px;"></i>
                <span>Buat Akun Sekarang</span>
            </button>
        </form>

        <div style="text-align: center; margin-top: 24px; font-size: 0.875rem; color: var(--text-muted);">
            Sudah punya akun? 
            <a href="{{ route('login') }}" style="color: var(--primary); font-weight: 700;">Masuk di Sini</a>
        </div>
    </div>
</div>
@endsection
