<?php

declare(strict_types=1);

namespace App\Board\Common\Enums\Advert;

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
     */
    public function label(): string
    {
        return match ($this) {
            self::CREATED => __('Created'),
            self::ACTIVE => __('Active advert'),
            self::WAIT_PHONE => __('Need attach phone'),
            self::WAIT_MODERATION => __('Wait moderation'),
            self::HIDDEN => __('Hidden advert'),
            self::BANNED => __('Blocked'),
        };
    }
}
