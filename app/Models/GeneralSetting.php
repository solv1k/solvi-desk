<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class GeneralSetting extends Model
{
    use HasFactory;

    const CACHE_PREFIX = 'general_settings_';

    protected $fillable = [
        'key',
        'type',
        'value'
    ];

    /**
     * Возвращает значение настройки по строковому ключу.
     * 
     * @param string $key
     * @param string $default
     * @return string
     */
    public static function getValue(string $key, string $default = ''): string
    {
        return Cache::rememberForever('key', function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }
}
