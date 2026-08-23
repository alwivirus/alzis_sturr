<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GameCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'banner',
        'description',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    public function gameAccounts()
    {
        return $this->hasMany(GameAccount::class);
    }

    public function availableAccountsCount()
    {
        if (isset($this->attributes['game_accounts_count'])) {
            return (int) $this->attributes['game_accounts_count'];
        }
        return $this->gameAccounts()->where('status', 'available')->count();
    }
}
