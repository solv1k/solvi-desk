<?php

declare(strict_types=1);

namespace App\Board\Modules\Advert\Providers;

use App\Board\Common\Contracts\Modules\Config\AdvertConfig;
use Illuminate\Support\ServiceProvider;

final class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $config = $this->app->make(AdvertConfig::class);

        $this->loadViewsFrom(
            path: $config->viewsFolder(),
            namespace: $config->moduleName()
        );
    }
}
