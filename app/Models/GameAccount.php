<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GameAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_category_id',
        'user_id',
        'product_type',
        'code',
        'title',
        'slug',
        'price',
        'discount_price',
        'login_bind',
        'server',
        'status',
        'stock_qty',
        'duration_value',
        'duration_unit',
        'account_variant',
        'thumbnail',
        'short_description',
        'full_specs',
        'hero_count',
        'skin_count',
        'rank_tier',
        'winrate',
        'is_verified',
        'is_featured',
        'views_count',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'stock_qty' => 'integer',
        'duration_value' => 'integer',
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
        'views_count' => 'integer',
        'hero_count' => 'integer',
        'skin_count' => 'integer',
    ];

    public function getDurationTextAttribute()
    {
        if (!$this->duration_value && !$this->duration_unit) {
            return null;
        }
        if ($this->duration_unit === 'Lifetime') {
            return 'Lifetime / Selamanya';
        }
        return ($this->duration_value ?: '1') . ' ' . ($this->duration_unit ?: 'Bulan');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title . '-' . ($model->code ?: Str::random(5)));
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isPartnerAccount(): bool
    {
        return $this->user && $this->user->isPartner();
    }

    public function category()
    {
        return $this->belongsTo(GameCategory::class, 'game_category_id');
    }

    public function images()
    {
        return $this->hasMany(AccountImage::class)->orderBy('sort_order', 'asc');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function isWishlistedBy(?User $user): bool
    {
        if (!$user) {
            return false;
        }
        return $this->wishlists()->where('user_id', $user->id)->exists();
    }

    public function getEffectivePriceAttribute()
    {
        return ($this->discount_price && $this->discount_price > 0 && $this->discount_price < $this->price) 
            ? $this->discount_price 
            : $this->price;
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getFormattedEffectivePriceAttribute()
    {
        return 'Rp ' . number_format($this->effective_price, 0, ',', '.');
    }

    public function getFormattedDiscountPriceAttribute()
    {
        return $this->discount_price ? 'Rp ' . number_format($this->discount_price, 0, ',', '.') : null;
    }

    public function getDiscountPercentAttribute()
    {
        if ($this->discount_price && $this->discount_price < $this->price && $this->price > 0) {
            return round((($this->price - $this->discount_price) / $this->price) * 100);
        }
        return 0;
    }

    public function getThumbnailUrlAttribute()
    {
        if (empty($this->thumbnail)) {
            return asset('images/default-account.jpg');
        }
        if (str_starts_with($this->thumbnail, 'http://') || str_starts_with($this->thumbnail, 'https://')) {
            return $this->thumbnail;
        }
        if (file_exists(public_path($this->thumbnail))) {
            return asset($this->thumbnail);
        }
        return asset('storage/' . ltrim($this->thumbnail, '/'));
    }
}
