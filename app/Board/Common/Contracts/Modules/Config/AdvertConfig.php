<?php

declare(strict_types=1);

namespace App\Board\Common\Contracts\Modules\Config;

use App\Board\Common\Contracts\Config\ModuleConfig;

interface AdvertConfig extends ModuleConfig
{
    public function statTotalCachePrefix(): string;

    public function statTotalCacheTtl(): int;
}
