@extends('layouts.admin')

@section('title', 'Kategori Game - ALzis STURR Admin')
@section('page_title', 'KELOLA KATEGORI GAME')

@section('content')
<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px; align-items: start;">
    
    <!-- Form Tambah Kategori -->
    <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 24px;">
        <h3 class="font-gaming" style="font-size: 1.3rem; color: #fff; margin-bottom: 18px; display: flex; align-items: center; gap: 8px;">
            <i data-lucide="plus-circle" style="width: 18px; height: 18px; color: var(--primary);"></i>
            Tambah Kategori Baru
        </h3>

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Nama Game <span style="color: var(--danger);">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" class="input-control" placeholder="Contoh: Mobile Legends" required>
                @error('name') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi Singkat</label>
                <textarea name="description" rows="3" class="input-control" placeholder="Deskripsi jenis akun game ini">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Urutan Tampil (Order)</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" class="input-control">
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #fff; cursor: pointer;">
                    <input type="checkbox" name="is_active" value="1" checked>
                    <span>Status Aktif (Tampil di Katalog)</span>
                </label>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <i data-lucide="save" style="width: 16px; height: 16px;"></i>
                <span>Simpan Kategori</span>
            </button>
        </form>
    </div>

    <!-- Daftar Kategori Table -->
    <div class="data-table-card">
        <div style="padding: 20px; border-bottom: 1px solid var(--border-color);">
            <h3 class="font-gaming" style="font-size: 1.3rem; color: #fff;">Daftar Kategori Game Aktif</h3>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Urutan</th>
                        <th>Nama Game</th>
                        <th>Slug</th>
                        <th>Total Akun</th>
                        <th>Status</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $cat)
                        <tr>
                            <td>
                                <span class="badge-code" style="position: static; font-size: 0.8rem; padding: 2px 8px;">#{{ $cat->order }}</span>
                            </td>
                            <td>
                                <strong style="color: #fff; font-size: 0.95rem;">{{ $cat->name }}</strong>
                                @if($cat->description)
                                    <div style="font-size: 0.75rem; color: var(--text-muted); max-width: 250px;">{{ Str::limit($cat->description, 40) }}</div>
                                @endif
                            </td>
                            <td>
                                <span style="font-family: monospace; font-size: 0.8rem; color: #7dd3fc;">{{ $cat->slug }}</span>
                            </td>
                            <td>
                                <span style="font-weight: 700; color: var(--primary);">{{ $cat->game_accounts_count }} Akun</span>
                            </td>
                            <td>
                                @if($cat->is_active)
                                    <span style="color: var(--success); font-size: 0.8rem; font-weight: 600;">🟢 Aktif</span>
                                @else
                                    <span style="color: var(--text-sub); font-size: 0.8rem;">⚪ Nonaktif</span>
                                @endif
                            </td>
                            <td style="text-align: right;">
                                <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Hapus kategori [{{ $cat->name }}]?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-secondary btn-icon" style="width: 32px; height: 32px; color: var(--danger);" {{ $cat->game_accounts_count > 0 ? 'disabled style=opacity:0.3;cursor:not-allowed;' : '' }} title="Hapus Kategori">
                                        <i data-lucide="trash" style="width: 14px; height: 14px;"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: var(--text-sub); padding: 30px;">Belum ada kategori game dibuat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
