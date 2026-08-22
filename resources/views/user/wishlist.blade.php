@extends('layouts.app')

@section('title', 'Wishlist Akun Saya - ALzis STURR')

@section('content')
<div class="container" style="padding: 40px 20px 80px;">
    <div style="margin-bottom: 30px;">
        <h1 class="font-gaming" style="font-size: 2.2rem; color: #fff;">
            WISHLIST <span class="text-gradient-cyan">AKUN SULTAN SAYA</span>
        </h1>
        <p style="color: var(--text-muted); font-size: 0.95rem;">
            Daftar akun game favorit yang telah Anda simpan.
        </p>
    </div>

    @if($wishlists->count() > 0)
        <div class="accounts-grid">
            @foreach($wishlists as $item)
                @php $acc = $item->gameAccount; @endphp
                <div class="account-card">
                    <div class="account-media">
                        <img src="{{ $acc->thumbnail_url }}" alt="{{ $acc->title }}" class="account-thumb">
                        
                        @if($acc->status === 'available')
                            <span class="badge-status badge-available">Ready</span>
                        @else
                            <span class="badge-status badge-sold">Sold Out</span>
                        @endif

                        <span class="badge-code">#{{ $acc->code }}</span>
                    </div>

                    <div class="account-body">
                        <div class="account-category-name">{{ $acc->category->name }}</div>
                        <h3 class="account-card-title">
                            <a href="{{ route('account.show', $acc->slug) }}">{{ $acc->title }}</a>
                        </h3>

                        <div class="account-tags-row">
                            <span class="tag-badge tag-server">{{ $acc->server }}</span>
                            <span class="tag-badge tag-bind">{{ Str::limit($acc->login_bind, 18) }}</span>
                        </div>

                        <div class="account-pricing">
                            <div class="price-box">
                                <span class="price-main">{{ $acc->formatted_effective_price }}</span>
                            </div>

                            <div class="account-actions">
                                <button class="btn btn-secondary btn-icon btn-toggle-wishlist" data-id="{{ $acc->id }}" title="Hapus dari Wishlist" style="color: #f43f5e; border-color: #f43f5e;">
                                    <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                                </button>
                                <a href="{{ route('account.show', $acc->slug) }}" class="btn btn-primary btn-sm">
                                    <span>Lihat</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div style="display: flex; justify-content: center; margin-top: 30px;">
            {{ $wishlists->links() }}
        </div>
    @else
        <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 60px 20px; text-align: center;">
            <div style="width: 70px; height: 70px; border-radius: 50%; background: rgba(0, 242, 254, 0.1); border: 1px solid var(--border-glow); display: inline-flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                <i data-lucide="heart-off" style="width: 36px; height: 36px; color: var(--primary);"></i>
            </div>
            <h3 class="font-gaming" style="font-size: 1.8rem; color: #fff; margin-bottom: 8px;">Wishlist Anda Masih Kosong</h3>
            <p style="color: var(--text-muted); max-width: 450px; margin: 0 auto 24px; font-size: 0.95rem;">
                Simpan akun game impian Anda dengan menekan ikon hati di kartu produk agar mudah dipantau kapan saja.
            </p>
            <a href="{{ route('catalog') }}" class="btn btn-primary">
                <i data-lucide="gamepad-2" style="width: 18px; height: 18px;"></i>
                <span>Jelajahi Katalog Game</span>
            </a>
        </div>
    @endif
</div>
@endsection
