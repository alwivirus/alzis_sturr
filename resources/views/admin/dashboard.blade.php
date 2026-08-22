@extends('layouts.admin')

@section('title', 'Dashboard Utama - ALzis STURR')
@section('page_title', 'PUSAT KONTROL & DASHBOARD')

@section('header_actions')
<div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
    @if(Auth::user()->isOwner())
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm" style="color: #38bdf8; border-color: rgba(56, 189, 248, 0.35); background: rgba(56, 189, 248, 0.08);">
        <i data-lucide="users" style="width: 16px; height: 16px;"></i>
        <span>Kelola Role User</span>
    </a>
    @endif
    <a href="{{ route('admin.accounts.create') }}" class="btn btn-primary btn-sm" style="box-shadow: 0 4px 15px rgba(0, 242, 254, 0.3);">
        <i data-lucide="plus-circle" style="width: 16px; height: 16px;"></i>
        <span>+ Tambah Stok Baru</span>
    </a>
</div>
@endsection

@section('content')
<div style="display: flex; flex-direction: column; gap: 28px;">

    <!-- Metrics Cards Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 18px;">
        
        <!-- Stok Ready -->
        <div style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.12) 0%, rgba(15, 23, 42, 0.8) 100%); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 16px; padding: 22px; position: relative; overflow: hidden; backdrop-filter: blur(10px); box-shadow: 0 8px 24px -6px rgba(0, 0, 0, 0.5);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div style="font-size: 0.8rem; font-weight: 700; color: #34d399; text-transform: uppercase; letter-spacing: 0.8px;">Stok Tersedia (Ready)</div>
                    <div style="font-size: 1.8rem; font-weight: 800; color: #fff; font-family: var(--font-gaming); margin-top: 4px;">
                        {{ $availableAccounts }} <span style="font-size: 0.9rem; color: var(--text-muted); font-family: var(--font-body); font-weight: 500;">/ {{ $totalAccounts }} Akun</span>
                    </div>
                </div>
                <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(16, 185, 129, 0.2); border: 1px solid rgba(16, 185, 129, 0.4); display: flex; align-items: center; justify-content: center; color: #34d399;">
                    <i data-lucide="check-circle-2" style="width: 22px; height: 22px;"></i>
                </div>
            </div>
            <div style="display: flex; align-items: center; gap: 6px; margin-top: 14px; padding-top: 10px; border-top: 1px solid rgba(255, 255, 255, 0.08); font-size: 0.8rem; color: #a7f3d0; font-weight: 600;">
                <span>Est. Nilai:</span>
                <span style="color: #fff; font-weight: 700;">Rp {{ number_format($totalStockValue, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Akun Terjual -->
        <div style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.12) 0%, rgba(15, 23, 42, 0.8) 100%); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 16px; padding: 22px; position: relative; overflow: hidden; backdrop-filter: blur(10px); box-shadow: 0 8px 24px -6px rgba(0, 0, 0, 0.5);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div style="font-size: 0.8rem; font-weight: 700; color: #f87171; text-transform: uppercase; letter-spacing: 0.8px;">Akun Terjual (Sold)</div>
                    <div style="font-size: 1.8rem; font-weight: 800; color: #fff; font-family: var(--font-gaming); margin-top: 4px;">
                        {{ $soldAccounts }} <span style="font-size: 0.9rem; color: var(--text-muted); font-family: var(--font-body); font-weight: 500;">Transaksi</span>
                    </div>
                </div>
                <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(239, 68, 68, 0.2); border: 1px solid rgba(239, 68, 68, 0.4); display: flex; align-items: center; justify-content: center; color: #f87171;">
                    <i data-lucide="shopping-bag" style="width: 22px; height: 22px;"></i>
                </div>
            </div>
            <div style="display: flex; align-items: center; gap: 6px; margin-top: 14px; padding-top: 10px; border-top: 1px solid rgba(255, 255, 255, 0.08); font-size: 0.8rem; color: #fca5a5; font-weight: 600;">
                <span>Omset Sold:</span>
                <span style="color: #fff; font-weight: 700;">Rp {{ number_format($totalSoldValue, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Total Pengguna -->
        <div style="background: linear-gradient(135deg, rgba(56, 189, 248, 0.12) 0%, rgba(15, 23, 42, 0.8) 100%); border: 1px solid rgba(56, 189, 248, 0.3); border-radius: 16px; padding: 22px; position: relative; overflow: hidden; backdrop-filter: blur(10px); box-shadow: 0 8px 24px -6px rgba(0, 0, 0, 0.5);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div style="font-size: 0.8rem; font-weight: 700; color: #38bdf8; text-transform: uppercase; letter-spacing: 0.8px;">Pengguna & Mitra</div>
                    <div style="font-size: 1.8rem; font-weight: 800; color: #fff; font-family: var(--font-gaming); margin-top: 4px;">
                        {{ $totalUsers }} <span style="font-size: 0.9rem; color: var(--text-muted); font-family: var(--font-body); font-weight: 500;">Terdaftar</span>
                    </div>
                </div>
                <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(56, 189, 248, 0.2); border: 1px solid rgba(56, 189, 248, 0.4); display: flex; align-items: center; justify-content: center; color: #38bdf8;">
                    <i data-lucide="users" style="width: 22px; height: 22px;"></i>
                </div>
            </div>
            <div style="margin-top: 14px; padding-top: 10px; border-top: 1px solid rgba(255, 255, 255, 0.08); font-size: 0.78rem; color: #7dd3fc; font-weight: 500;">
                <span style="color: #fbbf24; font-weight: 700;">{{ $totalAdmins }} Admin</span> • <span style="color: #a855f7; font-weight: 700;">{{ $totalResellers }} Reseller</span> • {{ $totalCustomers }} User
            </div>
        </div>

        <!-- Trafik Views & Wishlist -->
        <div style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.12) 0%, rgba(15, 23, 42, 0.8) 100%); border: 1px solid rgba(245, 158, 11, 0.3); border-radius: 16px; padding: 22px; position: relative; overflow: hidden; backdrop-filter: blur(10px); box-shadow: 0 8px 24px -6px rgba(0, 0, 0, 0.5);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div style="font-size: 0.8rem; font-weight: 700; color: #fbbf24; text-transform: uppercase; letter-spacing: 0.8px;">Trafik & Minat Pembeli</div>
                    <div style="font-size: 1.8rem; font-weight: 800; color: #fff; font-family: var(--font-gaming); margin-top: 4px;">
                        {{ number_format($totalViews) }} <span style="font-size: 0.9rem; color: var(--text-muted); font-family: var(--font-body); font-weight: 500;">Views</span>
                    </div>
                </div>
                <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(245, 158, 11, 0.2); border: 1px solid rgba(245, 158, 11, 0.4); display: flex; align-items: center; justify-content: center; color: #fbbf24;">
                    <i data-lucide="heart" style="width: 22px; height: 22px;"></i>
                </div>
            </div>
            <div style="margin-top: 14px; padding-top: 10px; border-top: 1px solid rgba(255, 255, 255, 0.08); font-size: 0.78rem; color: #fde68a; font-weight: 600;">
                ⭐ {{ $totalWishlists }} Akun Disimpan ke Wishlist
            </div>
        </div>

    </div>

    <!-- Layout 2 Kolom: Stok Terkini & Live Audit Feed -->
    <div style="display: grid; grid-template-columns: 1.35fr 1fr; gap: 24px; align-items: start;">
        
        <!-- Kolom Kiri: Postingan Stok Terkini -->
        <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 18px; overflow: hidden; box-shadow: var(--shadow-card);">
            <div style="padding: 20px 24px; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; background: rgba(15, 23, 42, 0.6);">
                <h3 class="font-gaming" style="font-size: 1.2rem; color: #fff; margin: 0; display: flex; align-items: center; gap: 10px;">
                    <i data-lucide="gamepad-2" style="width: 20px; height: 20px; color: var(--primary);"></i>
                    Postingan Stok Terkini
                </h3>
                <a href="{{ route('admin.accounts.index') }}" style="font-size: 0.82rem; color: var(--primary); font-weight: 700; display: flex; align-items: center; gap: 4px;">
                    <span>Lihat Semua</span>
                    <i data-lucide="arrow-right" style="width: 14px; height: 14px;"></i>
                </a>
            </div>

            <div style="display: flex; flex-direction: column;">
                @forelse($latestAccounts as $acc)
                    <div style="padding: 16px 20px; border-bottom: 1px solid rgba(255, 255, 255, 0.05); display: flex; align-items: center; justify-content: space-between; gap: 16px; transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                        <div style="display: flex; align-items: center; gap: 14px; min-width: 0; flex: 1;">
                            <img src="{{ $acc->thumbnail_url }}" alt="{{ $acc->title }}" style="width: 48px; height: 48px; object-fit: cover; border-radius: 10px; border: 1px solid var(--border-color); flex-shrink: 0; background: #0f172a;">
                            <div style="min-width: 0; flex: 1;">
                                <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                    <span style="font-family: var(--font-gaming); font-weight: 700; color: var(--primary); font-size: 0.9rem;">#{{ $acc->code }}</span>
                                    <span style="font-size: 0.7rem; padding: 2px 8px; border-radius: 6px; background: rgba(147, 51, 234, 0.2); color: #c084fc; font-weight: 600;">{{ $acc->category->name }}</span>
                                </div>
                                <div style="font-weight: 600; color: #fff; font-size: 0.9rem; margin-top: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $acc->title }}">
                                    {{ $acc->title }}
                                </div>
                                <div style="font-size: 0.75rem; color: #94a3b8; margin-top: 2px;">
                                    Bind: <span style="color: #38bdf8;">{{ $acc->login_bind }}</span>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; gap: 16px; flex-shrink: 0;">
                            <div style="text-align: right;">
                                <div style="font-size: 1rem; font-weight: 800; color: #00f2fe; font-family: var(--font-gaming);">
                                    {{ $acc->formatted_effective_price }}
                                </div>
                                @if($acc->has_discount)
                                    <div style="font-size: 0.72rem; color: #94a3b8; text-decoration: line-through;">
                                        {{ $acc->formatted_price }}
                                    </div>
                                @endif
                            </div>

                            <form action="{{ route('admin.accounts.toggle-status', $acc->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" style="padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; cursor: pointer; border: 1px solid {{ $acc->status === 'available' ? 'rgba(16, 185, 129, 0.4)' : 'rgba(239, 68, 68, 0.4)' }}; background: {{ $acc->status === 'available' ? 'rgba(16, 185, 129, 0.15)' : 'rgba(239, 68, 68, 0.15)' }}; color: {{ $acc->status === 'available' ? '#34d399' : '#f87171' }}; display: flex; align-items: center; gap: 6px;" title="Klik untuk ubah status Ready/Sold">
                                    <span style="width: 7px; height: 7px; border-radius: 50%; background: {{ $acc->status === 'available' ? '#34d399' : '#f87171' }}; box-shadow: 0 0 8px {{ $acc->status === 'available' ? '#34d399' : '#f87171' }};"></span>
                                    <span>{{ $acc->status === 'available' ? 'Ready' : 'Sold' }}</span>
                                </button>
                            </form>

                            <a href="{{ route('admin.accounts.edit', $acc->id) }}" class="btn btn-secondary btn-sm" style="padding: 6px 10px;" title="Edit Akun">
                                <i data-lucide="edit-3" style="width: 15px; height: 15px;"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; color: var(--text-sub); padding: 40px;">
                        <i data-lucide="inbox" style="width: 36px; height: 36px; margin-bottom: 8px; opacity: 0.5;"></i>
                        <div>Belum ada stok akun terdaftar.</div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Kolom Kanan: Live Security & Activity Timeline -->
        <div style="display: flex; flex-direction: column; gap: 24px;">
            
            <!-- Audit Activity Widget -->
            <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 18px; padding: 22px; box-shadow: var(--shadow-card);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; padding-bottom: 12px; border-bottom: 1px solid var(--border-color);">
                    <h3 class="font-gaming" style="font-size: 1.15rem; color: #fff; margin: 0; display: flex; align-items: center; gap: 8px;">
                        <i data-lucide="shield-alert" style="width: 18px; height: 18px; color: #f59e0b;"></i>
                        Log Aktivitas Terkini
                    </h3>
                    <a href="{{ route('admin.logs.index') }}" style="font-size: 0.78rem; color: #fbbf24; font-weight: 700; display: flex; align-items: center; gap: 4px;">
                        <span>Semua Log</span>
                        <i data-lucide="arrow-right" style="width: 12px; height: 12px;"></i>
                    </a>
                </div>

                <div style="display: flex; flex-direction: column; gap: 10px;">
                    @forelse($recentActivityLogs as $log)
                        <div style="background: rgba(15, 23, 42, 0.7); border: 1px solid rgba(255, 255, 255, 0.06); border-radius: 10px; padding: 12px 14px; transition: border-color 0.2s;" onmouseover="this.style.borderColor='rgba(0, 242, 254, 0.3)'" onmouseout="this.style.borderColor='rgba(255, 255, 255, 0.06)'">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                <div style="display: flex; align-items: center; gap: 6px;">
                                    <span style="font-size: 0.82rem; font-weight: 700; color: #fff;">{{ $log->user_name }}</span>
                                    <span style="font-size: 0.65rem; padding: 1px 6px; border-radius: 4px; font-weight: 700; letter-spacing: 0.5px; {{ in_array($log->user_role, ['owner', 'super_admin']) ? 'background: rgba(245, 158, 11, 0.2); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.4);' : (in_array($log->user_role, ['admin']) ? 'background: rgba(56, 189, 248, 0.2); color: #38bdf8; border: 1px solid rgba(56, 189, 248, 0.4);' : 'background: rgba(148, 163, 184, 0.2); color: #cbd5e1;') }}">
                                        {{ strtoupper($log->user_role) }}
                                    </span>
                                </div>
                                <span style="font-size: 0.7rem; color: var(--text-muted);">
                                    {{ $log->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <div style="font-size: 0.8rem; color: #cbd5e1; line-height: 1.4;">
                                {{ $log->description }}
                            </div>
                        </div>
                    @empty
                        <div style="text-align: center; color: var(--text-sub); padding: 24px; font-size: 0.85rem;">
                            Belum ada catatan aktivitas admin terbaru.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Top Viewed Accounts -->
            <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 18px; padding: 22px; box-shadow: var(--shadow-card);">
                <h3 class="font-gaming" style="font-size: 1.15rem; color: #fff; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                    <i data-lucide="trending-up" style="width: 18px; height: 18px; color: var(--primary);"></i>
                    Akun Paling Banyak Dilihat
                </h3>

                <div style="display: flex; flex-direction: column; gap: 10px;">
                    @foreach($topViewed as $index => $top)
                        <div style="background: rgba(15, 23, 42, 0.7); border: 1px solid rgba(255, 255, 255, 0.06); border-radius: 10px; padding: 10px 12px; display: flex; align-items: center; gap: 12px;">
                            <div style="font-family: var(--font-gaming); font-size: 1rem; font-weight: 800; color: {{ $index === 0 ? '#fbbf24' : ($index === 1 ? '#94a3b8' : '#cd7f32') }}; width: 16px; text-align: center;">
                                #{{ $index + 1 }}
                            </div>
                            <img src="{{ $top->thumbnail_url }}" alt="{{ $top->title }}" style="width: 44px; height: 44px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border-color); flex-shrink: 0; background: #0f172a;">
                            <div style="flex: 1; min-width: 0;">
                                <div style="font-size: 0.72rem; color: var(--primary); font-weight: 700;">#{{ $top->code }} • {{ $top->category->name }}</div>
                                <div style="font-size: 0.85rem; font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $top->title }}</div>
                                <div style="font-size: 0.78rem; color: #00f2fe; font-weight: 700;">{{ $top->formatted_effective_price }}</div>
                            </div>
                            <div style="font-size: 0.85rem; color: var(--accent-gold); font-weight: 800; text-align: right; flex-shrink: 0;">
                                {{ $top->views_count }}
                                <div style="font-size: 0.65rem; color: var(--text-muted); font-weight: 500;">Views</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
