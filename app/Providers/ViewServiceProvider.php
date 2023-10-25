<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

final class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // стили пагинации для пятой версии бутстрапа
        Paginator::useBootstrapFive();

        // директива admin для Blade
        //
        // @admin
        // <...>
        // @endadmin
        Blade::if('admin', static function () {
            /** @var \App\Models\User */
            $user = auth()->user();

            return $user && $user->isAdmin();
        });

        // добавляем текущего юзера во все вьюшки
        view()->composer('*', static function ($view): void {
            $current_user = auth()->user();
            $view->with('current_user', $current_user);
        });
    }
}
