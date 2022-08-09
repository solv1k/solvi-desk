<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // стили пагинации для пятой версии бутстрапа
        Paginator::useBootstrapFive();

        // директива admin для Blade
        // @admin <...> @endadmin
        Blade::if('admin', function() {
            /** @var \App\Models\User */
            $user = auth()->user();
            return $user->isAdmin();
        });
    }
}
