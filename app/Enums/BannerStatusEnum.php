<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Статусы баннерной рекламы.
 */
enum BannerStatusEnum: int
{
    case CREATED = 0;
    case ACTIVE = 1;
    case DECLINED = -1;

    /**
     * Возвращает наименование статуса баннерной рекламы.
     */
    public function label(): string
    {
        return match ($this) {
            self::CREATED => __('Created'),
            self::ACTIVE => __('Active'),
            self::DECLINED => __('Desclined'),
        };
    }
}
