@extends('layouts.admin')

@section('title', 'Kelola Stok Akun - ALzis STURR Admin')
@section('page_title', 'KELOLA SEMUA STOK AKUN GAME')

@section('header_actions')
<a href="{{ route('admin.accounts.create') }}" class="btn btn-primary btn-sm">
    <i data-lucide="plus" style="width: 16px; height: 16px;"></i>
    <span>+ Tambah Akun Baru</span>
</a>
@endsection

@section('content')

<!-- Search & Filter Bar -->
<div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 18px; margin-bottom: 24px;">
    <form action="{{ route('admin.accounts.index') }}" method="GET" style="display: grid; grid-template-columns: 2fr 1.5fr 1fr auto; gap: 12px; align-items: center;">
        <input type="text" name="q" value="{{ request('q') }}" class="input-control" placeholder="Cari kode akun (#AZS-01) atau judul...">
        
        <select name="category" class="input-control">
            <option value="">Semua Kategori Game</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>

        <select name="status" class="input-control">
            <option value="">Semua Status</option>
            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>🟢 Ready (Tersedia)</option>
            <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>🔴 Terjual (Sold)</option>
        </select>

        <button type="submit" class="btn btn-secondary">
            <i data-lucide="filter" style="width: 16px; height: 16px;"></i>
            <span>Filter</span>
        </button>
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
                    <th>Kategori / Server</th>
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
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <img src="{{ $acc->thumbnail_url }}" alt="{{ $acc->title }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: var(--radius-sm);">
                                <div>
                                    <span class="badge-code" style="position: static; padding: 2px 8px; font-size: 0.8rem;">#{{ $acc->code }}</span>
                                    @if($acc->is_featured)
                                        <div style="font-size: 0.65rem; color: var(--accent-gold); font-weight: 700; margin-top: 2px;">★ FEATURED</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="font-weight: 600; color: #fff; max-width: 250px; line-height: 1.3;">
                                <a href="{{ route('account.show', $acc->slug) }}" target="_blank" style="color: #fff; hover:color: var(--primary);">
                                    {{ $acc->title }}
                                </a>
                            </div>
                            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px;">
                                {{ $acc->rank_tier ? 'Rank: ' . $acc->rank_tier : '' }} {{ $acc->skin_count ? '• ' . $acc->skin_count . ' Skin' : '' }}
                            </div>
                        </td>
                        <td>
                            <div style="font-weight: 600; color: var(--primary);">{{ $acc->category->name }}</div>
                            <div style="font-size: 0.75rem; color: #7dd3fc;">Server: {{ $acc->server }}</div>
                        </td>
                        <td>
                            <div style="font-size: 0.8rem; color: #d8b4fe; max-width: 180px;">{{ $acc->login_bind }}</div>
                        </td>
                        <td>
                            <div style="font-family: var(--font-gaming); font-size: 1.1rem; font-weight: 700; color: #38bdf8;">
                                {{ $acc->formatted_effective_price }}
                            </div>
                            @if($acc->discount_price)
                                <div style="font-size: 0.7rem; color: var(--text-sub); text-decoration: line-through;">
                                    {{ $acc->formatted_price }}
                                </div>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.accounts.toggle-status', $acc->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm {{ $acc->status === 'available' ? 'btn-whatsapp' : 'btn-secondary' }}" style="font-size: 0.75rem; padding: 4px 10px;" title="Klik untuk switch status">
                                    {{ $acc->status === 'available' ? '🟢 Ready' : '🔴 Sold' }}
                                </button>
                            </form>
                        </td>
                        <td style="text-align: right;">
                            <div style="display: inline-flex; gap: 6px;">
                                <a href="{{ route('account.show', $acc->slug) }}" target="_blank" class="btn btn-secondary btn-icon" style="width: 32px; height: 32px;" title="Lihat Toko">
                                    <i data-lucide="eye" style="width: 14px; height: 14px;"></i>
                                </a>
                                <a href="{{ route('admin.accounts.edit', $acc->id) }}" class="btn btn-secondary btn-icon" style="width: 32px; height: 32px;" title="Edit Akun">
                                    <i data-lucide="edit" style="width: 14px; height: 14px;"></i>
                                </a>
                                <form action="{{ route('admin.accounts.destroy', $acc->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun [{{ $acc->code }}]? Data yang dihapus tidak dapat dikembalikan.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-secondary btn-icon" style="width: 32px; height: 32px; color: var(--danger);" title="Hapus Akun">
                                        <i data-lucide="trash" style="width: 14px; height: 14px;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; color: var(--text-sub); padding: 40px;">Tidak ada akun game ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div style="padding: 20px; display: flex; justify-content: center;">
        {{ $accounts->links() }}
    </div>
</div>

@endsection
