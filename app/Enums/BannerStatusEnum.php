<?php

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
     * 
     * @return string
     */
    public function label(): string
    {
        return match($this) {
            static::CREATED => __('Created'),
            static::ACTIVE => __('Active'),
            static::DECLINED => __('Desclined'),
            default => __('Unknown')
        };
    }
}