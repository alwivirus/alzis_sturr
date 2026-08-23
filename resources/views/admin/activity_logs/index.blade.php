@extends('layouts.admin')

@section('title', 'Log Audit Aktivitas - ALzis STURR Owner Hub')
@section('page_title', 'LOG AUDIT AKTIVITAS & KEAMANAN')

@section('header_actions')
@if(Auth::user()->isOwner())
<form action="{{ route('admin.logs.clear') }}" method="POST" onsubmit="return confirm('PERINGATAN! Anda yakin ingin membersihkan log aktivitas yang lebih lama dari 30 hari?');">
    @csrf
    <button type="submit" class="btn btn-danger-outline" style="font-size: 0.82rem;">
        <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i>
        <span>Bersihkan Log Lama</span>
    </button>
</form>
@endif
@endsection

@section('content')
<div style="display: flex; flex-direction: column; gap: 24px;">

    <!-- Summary Stats -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px;">
        <div class="stat-card" style="border-left: 3px solid #f59e0b !important;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-title" style="color: #fbbf24;">Total Aktivitas Tercatat</div>
                    <div class="stat-value" style="color: #fbbf24;">{{ number_format($totalLogs) }}</div>
                </div>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(245, 158, 11, 0.15); color: #fbbf24; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="file-text" style="width: 18px; height: 18px;"></i>
                </div>
            </div>
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 6px;">Riwayat Audit Keamanan</div>
        </div>

        <div class="stat-card" style="border-left: 3px solid var(--primary) !important;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-title" style="color: var(--primary);">Aktivitas Hari Ini</div>
                    <div class="stat-value" style="color: #fff;">{{ number_format($todayLogs) }}</div>
                </div>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(0, 242, 254, 0.15); color: var(--primary); display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="clock" style="width: 18px; height: 18px;"></i>
                </div>
            </div>
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 6px;">Log 24 Jam Terakhir</div>
        </div>

        <div class="stat-card" style="border-left: 3px solid #34d399 !important;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-title" style="color: #34d399;">Status Sistem</div>
                    <div class="stat-value" style="color: #34d399; font-size: 1.3rem;">AKTIF REAL-TIME</div>
                </div>
                <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(52, 211, 153, 0.15); color: #34d399; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="shield-check" style="width: 18px; height: 18px;"></i>
                </div>
            </div>
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 6px;">Semua Aksi Admin Terekam Otomatis</div>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 18px 20px;">
        <form action="{{ route('admin.logs.index') }}" method="GET" style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center; justify-content: space-between;">
            <div style="display: flex; flex-wrap: wrap; gap: 12px; align-items: center; flex: 1; min-width: 280px;">
                <!-- Search Input -->
                <div style="position: relative; flex: 1; min-width: 200px;">
                    <i data-lucide="search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; color: var(--text-muted);"></i>
                    <input type="text" name="q" value="{{ request('q') }}" class="input-control" placeholder="Cari keterangan, nama, atau IP..." style="padding-left: 38px; height: 42px;">
                </div>

                <!-- Action Type Filter -->
                <select name="action" class="input-control" style="width: auto; height: 42px; min-width: 170px;">
                    <option value="all">Semua Jenis Aksi</option>
                    @foreach($actionTypes as $type)
                        <option value="{{ $type }}" {{ request('action') == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>

                <!-- Admin User Filter -->
                <select name="user_id" class="input-control" style="width: auto; height: 42px; min-width: 160px;">
                    <option value="all">Semua Admin / User</option>
                    @foreach($admins as $adminUser)
                        <option value="{{ $adminUser->id }}" {{ request('user_id') == $adminUser->id ? 'selected' : '' }}>
                            {{ $adminUser->name }} ({{ strtoupper($adminUser->role) }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="display: flex; gap: 8px;">
                <button type="submit" class="btn btn-primary" style="height: 42px; padding: 0 18px;">
                    <i data-lucide="filter" style="width: 16px; height: 16px;"></i>
                    <span>Filter Log</span>
                </button>

                @if(request()->hasAny(['q', 'action', 'user_id']))
                <a href="{{ route('admin.logs.index') }}" class="btn btn-outline" style="height: 42px; padding: 0 14px;">
                    <i data-lucide="x" style="width: 16px; height: 16px;"></i>
                    <span>Reset</span>
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Logs Data Table -->
    <div class="data-table-card">
        <div style="padding: 18px 22px; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
            <h3 class="font-gaming" style="font-size: 1.2rem; color: #fff; margin: 0; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="shield-check" style="width: 18px; height: 18px; color: var(--primary);"></i>
                Catatan Riwayat Aktivitas & Perubahan
            </h3>
            <span style="font-size: 0.8rem; color: var(--text-muted);">Menampilkan {{ $logs->firstItem() ?? 0 }}-{{ $logs->lastItem() ?? 0 }} dari {{ $logs->total() }} log</span>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th style="width: 140px;">Waktu & Tanggal</th>
                        <th style="width: 180px;">Pelaku (Admin/User)</th>
                        <th style="width: 150px;">Jenis Aksi</th>
                        <th>Deskripsi Lengkap Aktivitas</th>
                        <th style="width: 130px;">IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                    <tr>
                        <td style="color: var(--text-muted); font-size: 0.8rem; white-space: nowrap;">
                            <div style="font-weight: 700; color: #fff;">{{ $log->created_at->format('H:i:s') }}</div>
                            <div style="font-size: 0.75rem;">{{ $log->created_at->format('d M Y') }}</div>
                        </td>
                        <td>
                            <div style="font-weight: 700; color: #fff; font-size: 0.9rem;">
                                {{ $log->user_name }}
                            </div>
                            <div style="font-size: 0.75rem; margin-top: 2px;">
                                @if(in_array($log->user_role, ['owner', 'super_admin']))
                                    <span style="color: #fbbf24; font-weight: 700;">👑 OWNER</span>
                                @elseif($log->user_role === 'partner')
                                    <span style="color: #00f2fe; font-weight: 700;">🤝 PARTNER</span>
                                @else
                                    <span style="color: #34d399; font-weight: 600;">👤 USER</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            @php
                                $badgeStyle = match($log->action) {
                                    'CREATE_ACCOUNT' => 'background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.4);',
                                    'UPDATE_ACCOUNT', 'UPDATE_SETTINGS' => 'background: rgba(0, 242, 254, 0.15); color: #00f2fe; border: 1px solid rgba(0, 242, 254, 0.4);',
                                    'DELETE_ACCOUNT', 'DELETE_USER', 'BAN_USER' => 'background: rgba(239, 68, 68, 0.15); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.4);',
                                    'CHANGE_ROLE' => 'background: rgba(245, 158, 11, 0.15); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.4);',
                                    'TOGGLE_STATUS' => 'background: rgba(168, 85, 247, 0.15); color: #c084fc; border: 1px solid rgba(168, 85, 247, 0.4);',
                                    'LOGIN' => 'background: rgba(59, 130, 246, 0.15); color: #60a5fa; border: 1px solid rgba(59, 130, 246, 0.4);',
                                    default => 'background: rgba(148, 163, 184, 0.15); color: #cbd5e1; border: 1px solid rgba(148, 163, 184, 0.3);'
                                };
                            @endphp
                            <span class="badge" style="{{ $badgeStyle }} font-size: 0.72rem; padding: 4px 8px; font-weight: 700;">
                                {{ $log->action }}
                            </span>
                        </td>
                        <td style="color: #e2e8f0; font-size: 0.88rem; line-height: 1.4;">
                            {{ $log->description }}
                        </td>
                        <td style="color: var(--text-muted); font-size: 0.8rem; font-family: monospace;">
                            <span style="background: rgba(0,0,0,0.3); padding: 2px 6px; border-radius: 4px; border: 1px solid var(--border-color);">
                                {{ $log->ip_address ?: '127.0.0.1' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px; color: var(--text-muted);">
                            <i data-lucide="shield-check" style="width: 36px; height: 36px; margin: 0 auto 10px; display: block; color: var(--text-sub);"></i>
                            Belum ada catatan aktivitas yang sesuai dengan filter pencarian.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($logs->hasPages())
        <div style="padding: 16px 20px; border-top: 1px solid var(--border-color);">
            {{ $logs->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
