@extends('layouts.partner')

@section('title', 'Kelola Akun Saya - Panel Mitra Partner')
@section('page_title', 'Kelola Stok Akun Game Saya')

@section('header_actions')
<a href="{{ route('partner.accounts.create') }}" class="btn btn-primary btn-sm">
    <i data-lucide="plus" style="width: 15px; height: 15px;"></i>
    <span>+ Post Akun Baru</span>
</a>
@endsection

@section('content')

<!-- Search & Filter Bar -->
<div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 14px 16px; margin-bottom: 20px;">
    <form action="{{ route('partner.accounts.index') }}" method="GET" style="display: flex; flex-wrap: wrap; gap: 10px; align-items: center;">
        <div style="flex: 2; min-width: 200px;">
            <input type="text" name="q" value="{{ request('q') }}" class="input-control" placeholder="Cari kode (#AZS-01), judul akun, hero...">
        </div>
        
        <div style="flex: 1; min-width: 140px;">
            <select name="category" class="input-control">
                <option value="">Semua Game</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div style="flex: 1; min-width: 120px;">
            <select name="status" class="input-control">
                <option value="">Semua Status</option>
                <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Ready</option>
                <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Sold</option>
            </select>
        </div>

        <div style="display: flex; gap: 6px;">
            <button type="submit" class="btn btn-primary btn-sm" style="padding: 8px 16px;">
                <i data-lucide="filter" style="width: 15px; height: 15px;"></i>
                <span>Filter</span>
            </button>
            @if(request()->hasAny(['q', 'category', 'status']))
                <a href="{{ route('partner.accounts.index') }}" class="btn btn-outline btn-sm" title="Reset">
                    <i data-lucide="x" style="width: 15px; height: 15px;"></i>
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Table Card -->
<div class="data-table-card">
    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Foto & Kode</th>
                    <th>Judul & Spesifikasi</th>
                    <th>Game / Server</th>
                    <th>Status Bind</th>
                    <th>Harga Net</th>
                    <th>Status Stok</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($accounts as $acc)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="{{ $acc->thumbnail_url }}" alt="{{ $acc->title }}" style="width: 48px; height: 48px; object-fit: cover; border-radius: var(--radius-sm); background: #000; border: 1px solid var(--border);">
                                <div>
                                    <span style="font-family: monospace; font-weight: 800; color: #fff; font-size: 0.88rem;">#{{ $acc->code }}</span>
                                    @if($acc->is_featured)
                                        <div style="font-size: 0.68rem; color: var(--gold); font-weight: 700; margin-top: 2px;">★ SULTAN</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="font-weight: 700; color: #fff; max-width: 260px; line-height: 1.3;">
                                <a href="{{ route('account.show', $acc->slug) }}" target="_blank" style="color: #fff; text-decoration: none;">
                                    {{ $acc->title }}
                                </a>
                            </div>
                            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 3px;">
                                {{ $acc->rank_tier ? 'Rank: ' . $acc->rank_tier : '' }} {{ $acc->skin_count ? '• ' . $acc->skin_count . ' Skin' : '' }}
                            </div>
                        </td>
                        <td>
                            <div style="font-weight: 600; color: var(--primary);">{{ $acc->category->name }}</div>
                            <div style="font-size: 0.75rem; color: var(--text-dim);">{{ $acc->server }}</div>
                        </td>
                        <td>
                            <div style="font-size: 0.8rem; color: var(--text-muted); max-width: 160px;">{{ $acc->login_bind }}</div>
                        </td>
                        <td>
                            <div style="font-family: var(--font-heading); font-size: 1.05rem; font-weight: 800; color: #fff;">
                                {{ $acc->formatted_effective_price }}
                            </div>
                            @if($acc->discount_price)
                                <div style="font-size: 0.7rem; color: var(--text-dim); text-decoration: line-through;">
                                    {{ $acc->formatted_price }}
                                </div>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('partner.accounts.toggle-status', $acc->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm" style="font-size: 0.75rem; padding: 3px 8px; {{ $acc->status === 'available' ? 'background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3);' : 'background: rgba(244,63,94,0.15); color: #fb7185; border: 1px solid rgba(244,63,94,0.3);' }}" title="Klik untuk switch status Ready/Sold">
                                    {{ $acc->status === 'available' ? '🟢 Ready' : '🔴 Sold' }}
                                </button>
                            </form>
                        </td>
                        <td style="text-align: right;">
                            <div style="display: inline-flex; gap: 6px;">
                                <a href="{{ route('partner.accounts.edit', $acc->id) }}" class="btn btn-outline btn-sm" style="padding: 5px 8px;" title="Edit Akun">
                                    <i data-lucide="edit-3" style="width: 14px; height: 14px;"></i>
                                </a>
                                <form action="{{ route('partner.accounts.destroy', $acc->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus postingan akun ini?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline btn-sm" style="padding: 5px 8px; color: var(--danger); border-color: rgba(244, 63, 94, 0.3);" title="Hapus Akun">
                                        <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; color: var(--text-dim); padding: 40px;">
                            <i data-lucide="inbox" style="width: 36px; height: 36px; margin: 0 auto 10px; display: block; opacity: 0.5;"></i>
                            Tidak ada akun game yang ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($accounts->hasPages())
    <div style="padding: 16px 20px; border-top: 1px solid var(--border); display: flex; justify-content: center;">
        {{ $accounts->links() }}
    </div>
    @endif
</div>

@endsection
