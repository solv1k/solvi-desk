<?php

namespace Src\Framework\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Containers\User\Advert\Data\Repositories\EloquentReadUserAdvertRepository;
use Src\Containers\User\Advert\Data\Repositories\EloquentWriteUserAdvertRepository;
use Src\Containers\User\Advert\Data\Repositories\ReadUserAdvertRepository;
use Src\Containers\User\Advert\Data\Repositories\WriteUserAdvertRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Define your repository bindings and other repository configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ReadUserAdvertRepository::class, EloquentReadUserAdvertRepository::class);
        $this->app->bind(WriteUserAdvertRepository::class, EloquentWriteUserAdvertRepository::class);
    }
}
