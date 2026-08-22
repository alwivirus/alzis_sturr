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
