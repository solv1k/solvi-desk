<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // стили пагинации для пятой версии бутстрапа
        Paginator::useBootstrapFive();

        // директива admin для Blade
        //
        // @admin 
        // <...> 
        // @endadmin
        Blade::if('admin', function() {
            /** @var \App\Models\User */
            $user = auth()->user();
            return $user && $user->isAdmin();
        });

        // добавляем текущего юзера во все вьюшки
        view()->composer('*', function($view) {
            $current_user = auth()->user();
            $view->with('current_user', $current_user);
        });
    }
}
