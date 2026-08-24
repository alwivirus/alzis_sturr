@extends('layouts.app')

@section('title', 'Masuk Akun - ALZIS STORE')
@section('meta_description', 'Login ke akun ALZIS STORE untuk mengelola profil dan memantau akun game impian Anda.')

@section('content')
<div class="auth-page-wrapper" style="min-height: calc(100vh - 240px); display: flex; align-items: center; justify-content: center; padding: 40px 16px; width: 100%; box-sizing: border-box;">
    <div class="auth-card" style="width: 100%; max-width: 440px; margin: 0 auto; background: var(--bg-card); border: 1px solid var(--border-light); border-radius: 20px; padding: 32px 24px; box-shadow: 0 15px 40px rgba(0,0,0,0.5); position: relative; overflow: hidden; box-sizing: border-box;">
        
        <!-- Top Bar -->
        <div style="position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, transparent, var(--primary, #3b82f6), var(--accent-purple, #8b5cf6), transparent);"></div>

        <!-- Header Brand -->
        <div style="text-align: center; margin-bottom: 22px;">
            <div style="display: flex; align-items: center; justify-content: center; gap: 8px; margin-bottom: 10px;">
                <img src="{{ asset('images/logo.png') }}" width="38" height="38" decoding="async" alt="Logo" style="height: 38px; width: auto; object-fit: contain;">
                <span class="font-heading" style="font-size: 1.25rem; font-weight: 900; color: #fff; letter-spacing: 0.5px;">ALZIS <span style="color: var(--primary, #3b82f6);">STORE</span></span>
            </div>
            <h1 class="font-heading" style="font-size: 1.4rem; font-weight: 900; color: #fff; margin: 0 0 4px;">Masuk ke Akun</h1>
            <p style="font-size: 0.82rem; color: var(--text-muted, #94a3b8); margin: 0; line-height: 1.4;">Login untuk menyimpan wishlist & akses akun game Anda.</p>
        </div>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <!-- Email Field -->
            <div style="margin-bottom: 16px;">
                <label for="email" style="display: block; font-size: 0.82rem; font-weight: 700; color: #cbd5e1; margin-bottom: 6px;">Alamat Email</label>
                <div style="position: relative; display: flex; align-items: center;">
                    <div style="position: absolute; left: 14px; color: var(--text-dim, #64748b); display: flex; align-items: center; pointer-events: none;">
                        <svg style="width: 16px; height: 16px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com" 
                           style="width: 100%; background: var(--bg-surface, #101726); border: 1px solid var(--border-light, rgba(255,255,255,0.12)); border-radius: 12px; color: #fff; padding: 12px 14px 12px 42px; font-size: 0.9rem; outline: none; transition: border-color 0.2s ease;">
                </div>
                @error('email')
                    <div style="color: #fb7185; font-size: 0.78rem; font-weight: 600; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Field -->
            <div style="margin-bottom: 16px;">
                <label for="password" style="display: block; font-size: 0.82rem; font-weight: 700; color: #cbd5e1; margin-bottom: 6px;">Kata Sandi</label>
                <div style="position: relative; display: flex; align-items: center;">
                    <div style="position: absolute; left: 14px; color: var(--text-dim, #64748b); display: flex; align-items: center; pointer-events: none;">
                        <svg style="width: 16px; height: 16px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    </div>
                    <input type="password" id="password" name="password" required placeholder="••••••••" 
                           style="width: 100%; background: var(--bg-surface, #101726); border: 1px solid var(--border-light, rgba(255,255,255,0.12)); border-radius: 12px; color: #fff; padding: 12px 14px 12px 42px; font-size: 0.9rem; outline: none; transition: border-color 0.2s ease;">
                </div>
                @error('password')
                    <div style="color: #fb7185; font-size: 0.78rem; font-weight: 600; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <label style="display: flex; align-items: center; gap: 8px; font-size: 0.82rem; color: var(--text-muted, #94a3b8); cursor: pointer; user-select: none;">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} style="accent-color: var(--primary, #3b82f6); width: 16px; height: 16px; cursor: pointer;">
                    <span>Ingat Saya</span>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; padding: 12px; font-weight: 800; font-size: 0.92rem; border-radius: 12px;">
                <svg style="width: 18px; height: 18px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                <span>Masuk Sekarang</span>
            </button>
        </form>

        <div style="text-align: center; margin-top: 20px; font-size: 0.84rem; color: var(--text-muted, #94a3b8);">
            Belum punya akun? 
            <a href="{{ route('register') }}" style="color: var(--primary, #3b82f6); font-weight: 800; text-decoration: none;">Daftar Akun Baru</a>
        </div>
    </div>
</div>
@endsection
