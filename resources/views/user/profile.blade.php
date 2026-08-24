@extends('layouts.app')

@section('title', 'Profil & Pengaturan Akun - ALZIS STORE')
@section('meta_description', 'Kelola informasi akun profil, foto avatar, wishlist game favorit, dan keamanan kata sandi di ALZIS STORE.')

@section('content')
<div class="container" style="padding: 28px 16px 80px; max-width: 880px; margin: 0 auto;">

    <!-- Top Profile Header Card -->
    <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 22px 24px; margin-bottom: 22px; position: relative; overflow: hidden; box-shadow: var(--shadow-md);">
        <div style="position: absolute; top: 0; left: 0; right: 0; height: 3px; background: var(--border);, var(--accent-purple), transparent);"></div>

        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
            <!-- Left: Avatar & Info -->
            <div style="display: flex; align-items: center; gap: 16px; min-width: 0;">
                <!-- Avatar with glow circle -->
                <div style="position: relative; flex-shrink: 0;">
                    <img id="header-avatar-preview" src="{{ $user->avatar_url }}" alt="{{ $user->name }}" width="64" height="64" style="width: 64px; height: 64px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary); box-shadow: var(--shadow-glow);">
                    <label for="avatar-input" style="position: absolute; bottom: -2px; right: -2px; width: 24px; height: 24px; border-radius: 50%; background: var(--primary); color: #050811; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 2px 6px rgba(0,0,0,0.6);" title="Ganti Foto Profil">
                        <svg style="width: 12px; height: 12px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                    </label>
                </div>

                <div style="min-width: 0;">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 3px; flex-wrap: wrap;">
                        <h1 class="font-heading" style="font-size: 1.35rem; color: #fff; font-weight: 800; line-height: 1.2; margin: 0;">
                            {{ $user->name }}
                        </h1>
                        @if($user->isOwner())
                            <span style="font-size: 0.68rem; padding: 2px 8px; background: rgba(245, 158, 11, 0.15); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.4); border-radius: var(--radius-full); font-weight: 800; display: inline-flex; align-items: center; gap: 4px;">
                                👑 OWNER TOKO
                            </span>
                        @elseif($user->isPartner())
                            <span style="font-size: 0.68rem; padding: 2px 8px; background: var(--primary-light); color: var(--primary); border: 1px solid var(--primary-border); border-radius: var(--radius-full); font-weight: 800; display: inline-flex; align-items: center; gap: 4px;">
                                🤝 MITRA PARTNER
                            </span>
                        @else
                            <span style="font-size: 0.68rem; padding: 2px 8px; background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.4); border-radius: var(--radius-full); font-weight: 800; display: inline-flex; align-items: center; gap: 4px;">
                                🎮 MEMBER RESMI
                            </span>
                        @endif
                    </div>

                    <div style="color: var(--text-muted); font-size: 0.8rem; display: flex; align-items: center; gap: 6px; flex-wrap: wrap;">
                        <span>{{ $user->email }}</span>
                        <span>•</span>
                        <span>Member sejak <strong>{{ $user->created_at ? $user->created_at->translatedFormat('d M Y') : '-' }}</strong></span>
                    </div>
                </div>
            </div>

            <!-- Right: Action Buttons -->
            <div style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
                @if($user->isOwner())
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm" style="border-radius: 8px; padding: 6px 14px; font-size: 0.78rem;">
                        <svg style="width: 14px; height: 14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></svg>
                        <span>Panel Owner</span>
                    </a>
                @elseif($user->isPartner())
                    <a href="{{ route('partner.dashboard') }}" class="btn btn-primary btn-sm" style="border-radius: 8px; padding: 6px 14px; font-size: 0.78rem;">
                        <svg style="width: 14px; height: 14px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        <span>Panel Partner</span>
                    </a>
                @endif
                <a href="{{ route('wishlist.index') }}" class="btn btn-secondary btn-sm" style="border-radius: 8px; padding: 6px 14px; font-size: 0.78rem;">
                    <svg style="width: 13px; height: 13px; color: var(--danger); fill: var(--danger);" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    <span>Wishlist ({{ $wishlistsCount ?? 0 }})</span>
                </a>
            </div>
        </div>

        <!-- Metric Badges 4-Grid Horizontal (Compact & Dynamic Theme) -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin-top: 18px; padding-top: 16px; border-top: 1px solid var(--border);" class="profile-chips-grid">
            <div style="background: var(--bg-surface); padding: 8px 12px; border-radius: 8px; border: 1px solid var(--border); display: flex; align-items: center; gap: 8px;">
                <div style="width: 26px; height: 26px; border-radius: 6px; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg style="width: 13px; height: 13px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
                </div>
                <div style="min-width: 0; overflow: hidden;">
                    <div style="font-size: 0.65rem; color: var(--text-dim); text-transform: uppercase; font-weight: 700; line-height: 1;">Status</div>
                    <div style="font-size: 0.78rem; font-weight: 800; color: #34d399; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Aktif / Verif</div>
                </div>
            </div>

            <div style="background: var(--bg-surface); padding: 8px 12px; border-radius: 8px; border: 1px solid var(--border); display: flex; align-items: center; gap: 8px;">
                <div style="width: 26px; height: 26px; border-radius: 6px; background: rgba(244, 63, 94, 0.12); color: var(--danger); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg style="width: 13px; height: 13px; fill: currentColor;" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                </div>
                <div style="min-width: 0; overflow: hidden;">
                    <div style="font-size: 0.65rem; color: var(--text-dim); text-transform: uppercase; font-weight: 700; line-height: 1;">Wishlist</div>
                    <div style="font-size: 0.78rem; font-weight: 800; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $wishlistsCount ?? 0 }} Akun</div>
                </div>
            </div>

            <div style="background: var(--bg-surface); padding: 8px 12px; border-radius: 8px; border: 1px solid var(--border); display: flex; align-items: center; gap: 8px;">
                <div style="width: 26px; height: 26px; border-radius: 6px; background: rgba(139, 92, 246, 0.12); color: var(--accent-purple); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg style="width: 13px; height: 13px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <div style="min-width: 0; overflow: hidden;">
                    <div style="font-size: 0.65rem; color: var(--text-dim); text-transform: uppercase; font-weight: 700; line-height: 1;">Keamanan</div>
                    <div style="font-size: 0.78rem; font-weight: 800; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Password Aktif</div>
                </div>
            </div>

            <div style="background: var(--bg-surface); padding: 8px 12px; border-radius: 8px; border: 1px solid var(--border); display: flex; align-items: center; gap: 8px;">
                <div style="width: 26px; height: 26px; border-radius: 6px; background: rgba(251, 191, 36, 0.12); color: var(--gold); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg style="width: 13px; height: 13px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                </div>
                <div style="min-width: 0; overflow: hidden;">
                    <div style="font-size: 0.65rem; color: var(--text-dim); text-transform: uppercase; font-weight: 700; line-height: 1;">Garansi</div>
                    <div style="font-size: 0.78rem; font-weight: 800; color: #fbbf24; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Anti HB 100%</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Theme Selection Card -->
    <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 20px 22px; margin-bottom: 22px; box-shadow: 0 4px 20px rgba(0,0,0,0.35);">
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; margin-bottom: 6px;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(255, 105, 180, 0.15); color: #ff69b4; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg style="width: 16px; height: 16px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="13.5" cy="6.5" r=".5" fill="currentColor"/><circle cx="17.5" cy="10.5" r=".5" fill="currentColor"/><circle cx="8.5" cy="7.5" r=".5" fill="currentColor"/><circle cx="6.5" cy="12.5" r=".5" fill="currentColor"/><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.563-2.512 5.563-5.563C22 6.5 17.5 2 12 2z"/></svg>
                </div>
                <div>
                    <h3 class="font-heading" style="font-size: 1.1rem; color: #fff; font-weight: 800; margin: 0;">
                        Kustomisasi Tema Warna Website
                    </h3>
                    <p style="color: var(--text-muted); font-size: 0.78rem; margin: 2px 0 0;">
                        Pilih warna tema favorit Anda. Tersedia pilihan tema warna gelap gaming (cowok) maupun warna pink pastel lucu (cewek).
                    </p>
                </div>
            </div>
            <span style="font-size: 0.72rem; color: #34d399; font-weight: 700; background: rgba(52, 211, 153, 0.1); border: 1px solid rgba(52, 211, 153, 0.3); padding: 3px 8px; border-radius: 6px;">
                ✓ Tersimpan Otomatis
            </span>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 10px; margin-top: 16px;">
            <!-- Sapphire Slate (Default) -->
            <button type="button" onclick="setAppTheme('default')" class="theme-card-picker" data-theme-val="default" style="background: rgba(59, 130, 246, 0.06); border: 1px solid rgba(59, 130, 246, 0.3); border-radius: 10px; padding: 12px; text-align: left; cursor: pointer; transition: all 0.2s;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                    <span style="width: 24px; height: 24px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6, #1d4ed8); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.35); display: inline-block;"></span>
                    <span style="font-size: 0.68rem; font-weight: 800; color: #3b82f6; background: rgba(59, 130, 246, 0.15); padding: 1px 6px; border-radius: 4px;">Default</span>
                </div>
                <div style="font-size: 0.84rem; font-weight: 800; color: #fff;">⚡ Sapphire Slate</div>
                <div style="font-size: 0.7rem; color: var(--text-dim); margin-top: 2px;">Modern slate & royal blue</div>
            </button>

            <!-- Emerald Jade -->
            <button type="button" onclick="setAppTheme('emerald-mint')" class="theme-card-picker" data-theme-val="emerald-mint" style="background: rgba(16, 185, 129, 0.05); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 10px; padding: 12px; text-align: left; cursor: pointer; transition: all 0.2s;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                    <span style="width: 24px; height: 24px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #047857); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.35); display: inline-block;"></span>
                    <span style="font-size: 0.68rem; font-weight: 800; color: #34d399; background: rgba(16, 185, 129, 0.15); padding: 1px 6px; border-radius: 4px;">Fresh</span>
                </div>
                <div style="font-size: 0.84rem; font-weight: 800; color: #fff;">🌿 Emerald Jade</div>
                <div style="font-size: 0.7rem; color: var(--text-dim); margin-top: 2px;">Hijau emerald elegan</div>
            </button>

            <!-- Royal Violet -->
            <button type="button" onclick="setAppTheme('purple-neon')" class="theme-card-picker" data-theme-val="purple-neon" style="background: rgba(139, 92, 246, 0.05); border: 1px solid rgba(139, 92, 246, 0.3); border-radius: 10px; padding: 12px; text-align: left; cursor: pointer; transition: all 0.2s;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                    <span style="width: 24px; height: 24px; border-radius: 50%; background: linear-gradient(135deg, #8b5cf6, #6d28d9); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.35); display: inline-block;"></span>
                    <span style="font-size: 0.68rem; font-weight: 800; color: #c084fc; background: rgba(139, 92, 246, 0.15); padding: 1px 6px; border-radius: 4px;">Royal</span>
                </div>
                <div style="font-size: 0.84rem; font-weight: 800; color: #fff;">🔮 Royal Violet</div>
                <div style="font-size: 0.7rem; color: var(--text-dim); margin-top: 2px;">Ungu royal slate</div>
            </button>

            <!-- Crimson Ruby -->
            <button type="button" onclick="setAppTheme('sunset-crimson')" class="theme-card-picker" data-theme-val="sunset-crimson" style="background: rgba(244, 63, 94, 0.05); border: 1px solid rgba(244, 63, 94, 0.3); border-radius: 10px; padding: 12px; text-align: left; cursor: pointer; transition: all 0.2s;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                    <span style="width: 24px; height: 24px; border-radius: 50%; background: linear-gradient(135deg, #f43f5e, #be123c); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.35); display: inline-block;"></span>
                    <span style="font-size: 0.68rem; font-weight: 800; color: #fb7185; background: rgba(244, 63, 94, 0.15); padding: 1px 6px; border-radius: 4px;">Ruby</span>
                </div>
                <div style="font-size: 0.84rem; font-weight: 800; color: #fff;">🔥 Crimson Ruby</div>
                <div style="font-size: 0.7rem; color: var(--text-dim); margin-top: 2px;">Merah ruby tegas</div>
            </button>

            <!-- Pink Sakura -->
            <button type="button" onclick="setAppTheme('pink-sakura')" class="theme-card-picker" data-theme-val="pink-sakura" style="background: rgba(244, 114, 182, 0.08); border: 1px solid rgba(244, 114, 182, 0.35); border-radius: 10px; padding: 12px; text-align: left; cursor: pointer; transition: all 0.2s;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                    <span style="width: 24px; height: 24px; border-radius: 50%; background: linear-gradient(135deg, #f472b6, #db2777); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.35); display: inline-block;"></span>
                    <span style="font-size: 0.68rem; font-weight: 800; color: #f472b6; background: rgba(244, 114, 182, 0.15); padding: 1px 6px; border-radius: 4px;">Sakura</span>
                </div>
                <div style="font-size: 0.84rem; font-weight: 800; color: #fff;">🌸 Soft Sakura</div>
                <div style="font-size: 0.7rem; color: var(--text-dim); margin-top: 2px;">Soft rose & sakura</div>
            </button>
        </div>
    </div>

    <!-- Forms Grid: Profile & Security -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px;" class="profile-forms-layout">
        
        <!-- Form 1: Edit Profile & Avatar Upload -->
        <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 22px 20px; box-shadow: var(--shadow-md);">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 4px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: var(--primary-light); color: var(--primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg style="width: 16px; height: 16px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <h3 class="font-heading" style="font-size: 1.1rem; color: #fff; font-weight: 800; margin: 0;">
                    Edit Informasi Profil
                </h3>
            </div>
            <p style="color: var(--text-muted); font-size: 0.78rem; margin-bottom: 18px; line-height: 1.4;">
                Ubah nama akun, foto profil avatar, email login, dan no WhatsApp.
            </p>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Avatar Upload Section -->
                <div style="margin-bottom: 16px;">
                    <label style="display: block; font-size: 0.76rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;">Foto Profil / Avatar</label>
                    <div style="display: flex; align-items: center; gap: 12px; background: var(--bg-surface); padding: 10px 12px; border-radius: 8px; border: 1px dashed var(--border-light);">
                        <img id="form-avatar-preview" src="{{ $user->avatar_url }}" alt="Preview" width="44" height="44" style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary); flex-shrink: 0;">
                        <div style="flex: 1; min-width: 0;">
                            <input type="file" id="avatar-input" name="avatar" accept="image/png,image/jpeg,image/jpg,image/webp" style="display: none;" onchange="previewAvatar(this)">
                            <label for="avatar-input" class="btn btn-secondary btn-sm" style="cursor: pointer; display: inline-flex; align-items: center; gap: 6px; padding: 5px 12px; font-size: 0.76rem; border-radius: 6px;">
                                <svg style="width: 13px; height: 13px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                <span>Pilih Foto</span>
                            </label>
                            <span style="font-size: 0.68rem; color: var(--text-dim); display: block; margin-top: 2px;">JPG, PNG, WEBP (Max 3MB)</span>
                        </div>
                    </div>
                    @error('avatar') <div class="form-error" style="color: #fb7185; font-size: 0.75rem; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>

                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 0.76rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;" for="name">Nama Akun <span style="color: var(--danger);">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="input-control" required placeholder="Nama Anda" style="height: 38px; font-size: 0.84rem;">
                    @error('name') <div class="form-error" style="color: #fb7185; font-size: 0.75rem; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>

                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 0.76rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;" for="email">Alamat Email Login <span style="color: var(--danger);">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="input-control" required placeholder="nama@email.com" style="height: 38px; font-size: 0.84rem;">
                    @error('email') <div class="form-error" style="color: #fb7185; font-size: 0.75rem; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 0.76rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;" for="phone">Nomor WhatsApp (Opsional)</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" class="input-control" placeholder="081234567890" style="height: 38px; font-size: 0.84rem;">
                    @error('phone') <div class="form-error" style="color: #fb7185; font-size: 0.75rem; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; border-radius: 8px; padding: 10px; font-size: 0.84rem;">
                    <svg style="width: 15px; height: 15px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    <span>Simpan Perubahan Profil</span>
                </button>
            </form>
        </div>

        <!-- Form 2: Password Security -->
        <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 22px 20px; box-shadow: var(--shadow-md);">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 4px;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(139, 92, 246, 0.12); color: var(--accent-purple); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg style="width: 16px; height: 16px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <h3 class="font-heading" style="font-size: 1.1rem; color: #fff; font-weight: 800; margin: 0;">
                    Keamanan & Kata Sandi
                </h3>
            </div>
            <p style="color: var(--text-muted); font-size: 0.78rem; margin-bottom: 18px; line-height: 1.4;">
                Gunakan kata sandi unik minimal 6 karakter untuk mengamankan akun.
            </p>

            <form action="{{ route('profile.password') }}" method="POST">
                @csrf
                @method('PUT')

                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 0.76rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;" for="current_password">Password Saat Ini <span style="color: var(--danger);">*</span></label>
                    <input type="password" id="current_password" name="current_password" class="input-control" required placeholder="Masukkan password lama" style="height: 38px; font-size: 0.84rem;">
                    @error('current_password') <div class="form-error" style="color: #fb7185; font-size: 0.75rem; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>

                <div style="margin-bottom: 14px;">
                    <label style="display: block; font-size: 0.76rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;" for="new_password">Password Baru <span style="color: var(--danger);">*</span></label>
                    <input type="password" id="new_password" name="password" class="input-control" required placeholder="Minimal 6 karakter" style="height: 38px; font-size: 0.84rem;">
                    @error('password') <div class="form-error" style="color: #fb7185; font-size: 0.75rem; margin-top: 4px;">{{ $message }}</div> @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 0.76rem; font-weight: 700; color: var(--text-muted); margin-bottom: 6px; text-transform: uppercase;" for="password_confirmation">Konfirmasi Password Baru <span style="color: var(--danger);">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="input-control" required placeholder="Ulangi password baru" style="height: 38px; font-size: 0.84rem;">
                </div>

                <button type="submit" class="btn btn-secondary" style="width: 100%; border-radius: 8px; padding: 10px; border-color: var(--border); color: #fff; font-size: 0.84rem;">
                    <svg style="width: 15px; height: 15px; color: var(--accent-purple);" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
                    <span>Perbarui Kata Sandi</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Wishlist Quick Banner -->
    <div style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 18px 20px; margin-top: 22px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(244, 63, 94, 0.12); color: var(--danger); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg style="width: 18px; height: 18px; fill: currentColor;" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
            </div>
            <div>
                <h4 style="font-size: 0.95rem; font-weight: 800; color: #fff; margin: 0;">Wishlist Akun Game Anda</h4>
                <p style="font-size: 0.78rem; color: var(--text-muted); margin: 2px 0 0;">Ada {{ $wishlistsCount ?? 0 }} akun yang Anda tandai di wishlist.</p>
            </div>
        </div>
        <div style="display: flex; gap: 8px;">
            <a href="{{ route('wishlist.index') }}" class="btn btn-secondary btn-sm" style="border-radius: 6px; padding: 6px 14px; font-size: 0.76rem;">
                <span>Buka Wishlist</span>
                <svg style="width: 12px; height: 12px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
            <a href="{{ route('catalog') }}" class="btn btn-primary btn-sm" style="border-radius: 6px; padding: 6px 14px; font-size: 0.76rem;">
                <span>Katalog Akun</span>
            </a>
        </div>
    </div>
</div>

<style>
@media (max-width: 768px) {
    .profile-chips-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 8px !important;
    }
    .profile-forms-layout {
        grid-template-columns: 1fr !important;
        gap: 16px !important;
    }
}
</style>

@push('scripts')
<script>
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const headerImg = document.getElementById('header-avatar-preview');
                const formImg = document.getElementById('form-avatar-preview');
                if (headerImg) headerImg.src = e.target.result;
                if (formImg) formImg.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection
