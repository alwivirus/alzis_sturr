<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_account_id',
        'image_path',
        'caption',
        'sort_order',
    ];

    public function gameAccount()
    {
        return $this->belongsTo(GameAccount::class);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image_path && file_exists(public_path($this->image_path))) {
            return asset($this->image_path);
        }
        if ($this->image_path && str_starts_with($this->image_path, 'http')) {
            return $this->image_path;
        }
        if ($this->image_path && file_exists(storage_path('app/public/' . $this->image_path))) {
            return asset('storage/' . $this->image_path);
        }
        return asset($this->image_path);
    }
}
