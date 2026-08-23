@extends('layouts.app')

@section('title', 'Daftar Akun Baru - ALZIS STORE')
@section('meta_description', 'Daftar akun ALZIS STORE untuk mulai membeli dan menyimpan akun game impian Anda.')

@section('content')
<div class="auth-page-wrapper">
    <div class="auth-card auth-card-wide">
        
        <!-- Glowing Top Bar -->
        <div style="position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, transparent, var(--primary, #00f2fe), var(--accent-purple, #8b5cf6), transparent);"></div>

        <!-- Header Brand -->
        <div style="text-align: center; margin-bottom: 22px;">
            <div style="display: flex; align-items: center; justify-content: center; gap: 8px; margin-bottom: 10px;">
                <img src="{{ asset('images/logo.png') }}" width="38" height="38" decoding="async" alt="Logo" style="height: 38px; width: auto; object-fit: contain; filter: drop-shadow(0 0 10px rgba(0, 242, 254, 0.45));">
                <span class="font-heading" style="font-size: 1.25rem; font-weight: 900; color: #fff; letter-spacing: 0.5px;">ALZIS <span style="color: var(--primary, #00f2fe);">STORE</span></span>
            </div>
            <h1 class="font-heading" style="font-size: 1.4rem; font-weight: 900; color: #fff; margin: 0 0 4px;">Daftar Akun Baru</h1>
            <p style="font-size: 0.82rem; color: var(--text-muted, #94a3b8); margin: 0; line-height: 1.4;">Bergabunglah dengan ribuan gamer di platform ALZIS STORE.</p>
        </div>

        <form action="{{ route('register.post') }}" method="POST">
            @csrf

            <!-- Name Field -->
            <div style="margin-bottom: 14px;">
                <label for="name" style="display: block; font-size: 0.82rem; font-weight: 700; color: #cbd5e1; margin-bottom: 6px;">Nama Lengkap <span style="color: #fb7185;">*</span></label>
                <div style="position: relative; display: flex; align-items: center;">
                    <div style="position: absolute; left: 14px; color: var(--text-dim, #64748b); display: flex; align-items: center; pointer-events: none;">
                        <svg style="width: 16px; height: 16px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="Contoh: Sakaki Gamer" 
                           style="width: 100%; background: var(--bg-surface, #0b1120); border: 1px solid var(--border-light, rgba(255,255,255,0.12)); border-radius: 12px; color: #fff; padding: 12px 14px 12px 42px; font-size: 0.9rem; outline: none; transition: border-color 0.2s ease;">
                </div>
                @error('name')
                    <div style="color: #fb7185; font-size: 0.78rem; font-weight: 600; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Field -->
            <div style="margin-bottom: 14px;">
                <label for="email" style="display: block; font-size: 0.82rem; font-weight: 700; color: #cbd5e1; margin-bottom: 6px;">Alamat Email <span style="color: #fb7185;">*</span></label>
                <div style="position: relative; display: flex; align-items: center;">
                    <div style="position: absolute; left: 14px; color: var(--text-dim, #64748b); display: flex; align-items: center; pointer-events: none;">
                        <svg style="width: 16px; height: 16px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com" 
                           style="width: 100%; background: var(--bg-surface, #0b1120); border: 1px solid var(--border-light, rgba(255,255,255,0.12)); border-radius: 12px; color: #fff; padding: 12px 14px 12px 42px; font-size: 0.9rem; outline: none; transition: border-color 0.2s ease;">
                </div>
                @error('email')
                    <div style="color: #fb7185; font-size: 0.78rem; font-weight: 600; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Phone Field -->
            <div style="margin-bottom: 14px;">
                <label for="phone" style="display: block; font-size: 0.82rem; font-weight: 700; color: #cbd5e1; margin-bottom: 6px;">Nomor HP / WhatsApp (Opsional)</label>
                <div style="position: relative; display: flex; align-items: center;">
                    <div style="position: absolute; left: 14px; color: var(--text-dim, #64748b); display: flex; align-items: center; pointer-events: none;">
                        <svg style="width: 16px; height: 16px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </div>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Contoh: 081234567890" 
                           style="width: 100%; background: var(--bg-surface, #0b1120); border: 1px solid var(--border-light, rgba(255,255,255,0.12)); border-radius: 12px; color: #fff; padding: 12px 14px 12px 42px; font-size: 0.9rem; outline: none; transition: border-color 0.2s ease;">
                </div>
                @error('phone')
                    <div style="color: #fb7185; font-size: 0.78rem; font-weight: 600; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Fields (Responsive Grid) -->
            <div class="auth-grid-2" style="margin-bottom: 20px;">
                <div>
                    <label for="password" style="display: block; font-size: 0.82rem; font-weight: 700; color: #cbd5e1; margin-bottom: 6px;">Kata Sandi <span style="color: #fb7185;">*</span></label>
                    <input type="password" id="password" name="password" required placeholder="Min 6 karakter" 
                           style="width: 100%; background: var(--bg-surface, #0b1120); border: 1px solid var(--border-light, rgba(255,255,255,0.12)); border-radius: 12px; color: #fff; padding: 12px 14px; font-size: 0.88rem; outline: none; transition: border-color 0.2s ease;">
                    @error('password')
                        <div style="color: #fb7185; font-size: 0.75rem; font-weight: 600; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" style="display: block; font-size: 0.82rem; font-weight: 700; color: #cbd5e1; margin-bottom: 6px;">Ulangi Sandi <span style="color: #fb7185;">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi sandi" 
                           style="width: 100%; background: var(--bg-surface, #0b1120); border: 1px solid var(--border-light, rgba(255,255,255,0.12)); border-radius: 12px; color: #fff; padding: 12px 14px; font-size: 0.88rem; outline: none; transition: border-color 0.2s ease;">
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; padding: 12px; font-weight: 800; font-size: 0.92rem; border-radius: 12px;">
                <svg style="width: 18px; height: 18px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                <span>Buat Akun Sekarang</span>
            </button>
        </form>

        <div style="text-align: center; margin-top: 20px; font-size: 0.84rem; color: var(--text-muted, #94a3b8);">
            Sudah punya akun? 
            <a href="{{ route('login') }}" style="color: var(--primary, #00f2fe); font-weight: 800; text-decoration: none;">Masuk di Sini</a>
        </div>
    </div>
</div>
@endsection
