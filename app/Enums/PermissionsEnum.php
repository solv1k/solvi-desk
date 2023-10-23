<?php

declare(strict_types=1);

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
     * Возвращает массив прав, которые разрешают создание нового объявления.
     *
     * @return array<self>
     */
    public static function allowedCreateAdvert(): array
    {
        return [
            self::ACTIVATED_USER,
            self::ADMIN,
        ];
    }

    /**
     * Возвращает наименование прав доступа.
     */
    public function label(): string
    {
        return match ($this) {
            self::UNACTIVATED_USER => __('Unactivated user'),
            self::ACTIVATED_USER => __('Active user'),
            self::SUSPENDED_USER => __('Suspended user'),
            self::ADMIN => __('Administrator'),
        };
    }
}
