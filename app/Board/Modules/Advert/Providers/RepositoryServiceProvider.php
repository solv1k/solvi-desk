<?php

declare(strict_types=1);

namespace App\Board\Modules\Advert\Providers;

use App\Board\Modules\Advert\Data\Repositories\Read\AdvertReadRepository;
use App\Board\Modules\Advert\Data\Repositories\Read\EloquentAdvertReadRepository;
use App\Board\Modules\Advert\Data\Repositories\Write\AdvertWriteRepository;
use App\Board\Modules\Advert\Data\Repositories\Write\EloquentAdvertWriteRepository;
use Illuminate\Support\ServiceProvider;

final class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AdvertReadRepository::class, EloquentAdvertReadRepository::class);
        $this->app->bind(AdvertWriteRepository::class, EloquentAdvertWriteRepository::class);
    }
}
