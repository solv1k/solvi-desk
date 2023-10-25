<?php

declare(strict_types=1);

namespace App\Board\Modules\Advert\Providers;

use App\Board\Common\Contracts\Modules\Facades\AdvertFacade;
use App\Board\Modules\Advert\AdvertFacade as ModuleAdvertFacade;
use Illuminate\Support\ServiceProvider;

final class FacadeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AdvertFacade::class, ModuleAdvertFacade::class);
    }
}
