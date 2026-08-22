@extends('layouts.app')

@section('title', 'Masuk Akun - ALzis STURR')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <div class="brand-logo" style="justify-content: center; margin-bottom: 8px;">
                <span class="text-gradient-cyan">ALZIS</span>
                <span class="logo-badge">STURR</span>
            </div>
            <h1 class="auth-title">MASUK KE AKUN</h1>
            <p class="auth-subtitle">Login untuk menyimpan wishlist & memantau status akun impian Anda.</p>
        </div>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label" for="email">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="input-control" placeholder="nama@email.com" required autofocus>
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                    <label class="form-label" for="password" style="margin-bottom: 0;">Kata Sandi</label>
                </div>
                <input type="password" id="password" name="password" class="input-control" placeholder="••••••••" required>
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <label style="display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: var(--text-muted); cursor: pointer;">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span>Ingat Saya</span>
                </label>
            </div>

            <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                <i data-lucide="log-in" style="width: 18px; height: 18px;"></i>
                <span>Masuk Sekarang</span>
            </button>
        </form>

        <div style="text-align: center; margin-top: 24px; font-size: 0.875rem; color: var(--text-muted);">
            Belum punya akun? 
            <a href="{{ route('register') }}" style="color: var(--primary); font-weight: 700;">Daftar Akun Baru</a>
        </div>
    </div>
</div>
@endsection
