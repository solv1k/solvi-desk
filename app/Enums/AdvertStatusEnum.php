<?php

namespace App\Enums;

/**
 * Статусы объявлений.
 */
enum AdvertStatusEnum: int
{
    case CREATED = 0;
    case ACTIVE = 1;
    case WAIT_PHONE = 2;
    case WAIT_MODERATION = 3;
    case HIDDEN = 4;
    case BANNED = -1;

    /**
     * Возвращает наименование статуса объявления.
     * 
     * @return string
     */
    public function label(): string
    {
        return match($this) {
            static::CREATED => __('Created'),
            static::ACTIVE => __('Active advert'),
            static::WAIT_PHONE => __('Need attach phone'),
            static::WAIT_MODERATION => __('Wait moderation'),
            static::HIDDEN => __('Hidden advert'),
            static::BANNED => __('Blocked'),
            default => __('Unknown')
        };
    }
}