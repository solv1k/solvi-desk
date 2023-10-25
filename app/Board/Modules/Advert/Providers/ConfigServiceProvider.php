<?php

declare(strict_types=1);

namespace App\Board\Modules\Advert\Providers;

use App\Board\Common\Contracts\Modules\Config\AdvertConfig as AdvertConfigContract;
use App\Board\Modules\Advert\AdvertConfig;
use Illuminate\Support\ServiceProvider;

final class ConfigServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AdvertConfigContract::class, AdvertConfig::class);
    }
}
