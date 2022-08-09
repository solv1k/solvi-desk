<?php

namespace App\Enums;

/**
 * Права доступа.
 */
enum PermissionsEnum: string
{
    case SUSPENDED_USER = '0000';
    case UNACTIVATED_USER = '0001';
    case ACTIVATED_USER = '0011';
    case ADMIN = '7777';

    /**
     * Возвращает наименование прав доступа.
     * 
     * @return string
     */
    public function label(): string
    {
        return match($this) {
            static::UNACTIVATED_USER => __('Unactivated user'),
            static::ACTIVATED_USER => __('Active user'),
            static::SUSPENDED_USER => __('Suspended user'),
            static::ADMIN => __('Administrator'),
            default => __('Unknown')
        };
    }

    /**
     * Возвращает массив прав, которые разрешают создание нового объявления.
     * 
     * @return array
     */
    public static function allowedCreateAdvert(): array
    {
        return [
            static::ACTIVATED_USER,
            static::ADMIN
        ];
    }
}