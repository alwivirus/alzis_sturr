<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
    ];

    protected static $settingsCache = null;

    public static function loadAllSettings()
    {
        if (static::$settingsCache === null) {
            try {
                static::$settingsCache = static::pluck('value', 'key')->toArray();
            } catch (\Exception $e) {
                static::$settingsCache = [];
            }
        }
    }

    public static function get(string $key, ?string $default = null): ?string
    {
        static::loadAllSettings();
        $val = static::$settingsCache[$key] ?? $default;
        if ($key === 'discord_invite_url' && ($val === 'https://discord.gg/alzis-sturr' || empty($val))) {
            return 'https://discord.gg/zEGEGs6hat';
        }
        return $val;
    }

    public static function set(string $key, ?string $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        if (static::$settingsCache !== null) {
            static::$settingsCache[$key] = $value;
        }
    }
}
