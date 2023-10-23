<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * Основные настройки.
 */
final class GeneralSetting extends Model
{
    use HasFactory;

    public const CACHE_PREFIX = 'general_settings_';

    protected $fillable = [
        'key',
        'type',
        'value',
    ];

    /**
     * Возвращает значение настройки по строковому ключу.
     */
    public static function getValue(string $key, string $default = ''): string
    {
        return Cache::rememberForever('key', static function () use ($key, $default) {
            $setting = self::where('key', $key)->first();

            return $setting ? $setting->value : $default;
        });
    }
}
