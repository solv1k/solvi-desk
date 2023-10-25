<?php

declare(strict_types=1);

namespace App\Board\Modules\Advert;

use App\Board\Common\Contracts\Modules\Config\AdvertConfig as AdvertConfigContract;

final class AdvertConfig implements AdvertConfigContract
{
    public function moduleName(): string
    {
        return 'advert';
    }

    public function viewsFolder(): string
    {
        return __DIR__ . '/UI/Web/Views';
    }

    public function apiPrefix(): string
    {
        return '/api/v1/advert';
    }

    public function cachePrefix(): string
    {
        return 'advert::';
    }

    public function statTotalCachePrefix(): string
    {
        return $this->cachePrefix() . 'statTotal::';
    }

    public function statTotalCacheTtl(): int
    {
        return 10;
    }
}
