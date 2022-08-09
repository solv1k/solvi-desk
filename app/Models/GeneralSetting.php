<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;

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
    public static function getValue(string $key, string $default = ""): string
    {
        $setting = self::where('key', $key)->first();

        if ($setting) {
            return $setting->value;
        } else {
            return $default;
        }
    }
}
