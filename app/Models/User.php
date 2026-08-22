<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_banned',
        'ban_reason',
        'google_id',
        'avatar',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_banned' => 'boolean',
        ];
    }

    public function isOwner(): bool
    {
        return in_array($this->role, ['owner', 'super_admin']) || $this->email === 'velzgud@gmail.com';
    }

    public function isAdmin(): bool
    {
        return in_array($this->role, ['admin', 'owner', 'super_admin']) || $this->email === 'velzgud@gmail.com';
    }

    public function isReseller(): bool
    {
        return $this->role === 'reseller';
    }

    public function isBanned(): bool
    {
        return (bool) $this->is_banned;
    }

    public function getRoleBadgeAttribute(): string
    {
        if ($this->isOwner()) {
            return '<span class="badge" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: #fff; font-weight: 800; padding: 4px 10px; border-radius: 4px; font-size: 0.75rem;"><i data-lucide="crown" style="width: 12px; height: 12px; vertical-align: -1px; display: inline-block;"></i> OWNER UTAMA</span>';
        }
        if ($this->role === 'admin') {
            return '<span class="badge" style="background: rgba(0, 242, 254, 0.15); color: #00f2fe; border: 1px solid rgba(0, 242, 254, 0.4); font-weight: 700; padding: 4px 10px; border-radius: 4px; font-size: 0.75rem;"><i data-lucide="shield-check" style="width: 12px; height: 12px; vertical-align: -1px; display: inline-block;"></i> ADMIN</span>';
        }
        if ($this->role === 'reseller') {
            return '<span class="badge" style="background: rgba(168, 85, 247, 0.15); color: #c084fc; border: 1px solid rgba(168, 85, 247, 0.4); font-weight: 700; padding: 4px 10px; border-radius: 4px; font-size: 0.75rem;"><i data-lucide="gem" style="width: 12px; height: 12px; vertical-align: -1px; display: inline-block;"></i> RESELLER</span>';
        }
        return '<span class="badge" style="background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3); font-weight: 600; padding: 4px 10px; border-radius: 4px; font-size: 0.75rem;"><i data-lucide="user" style="width: 12px; height: 12px; vertical-align: -1px; display: inline-block;"></i> PELANGGAN</span>';
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function wishlistAccounts()
    {
        return $this->belongsToMany(GameAccount::class, 'wishlists', 'user_id', 'game_account_id');
    }
}
