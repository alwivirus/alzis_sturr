<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_name',
        'user_role',
        'action',
        'description',
        'ip_address',
        'user_agent',
        'properties',
    ];

    protected $casts = [
        'properties' => 'array',
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Log a new system / admin activity
     */
    public static function record(string $action, string $description, ?array $properties = null, ?User $actor = null): self
    {
        $user = $actor ?: Auth::user();

        return self::create([
            'user_id' => $user?->id,
            'user_name' => $user?->name ?: 'Guest / Sistem',
            'user_role' => $user?->role ?: 'guest',
            'action' => strtoupper($action),
            'description' => $description,
            'ip_address' => Request::ip() ?: '127.0.0.1',
            'user_agent' => Request::userAgent() ?: 'Unknown',
            'properties' => $properties,
        ]);
    }
}
