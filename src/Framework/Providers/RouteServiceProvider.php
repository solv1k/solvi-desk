<?php

namespace Src\Framework\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Src\Ship\Contracts\Routes\Route as RouteContract;

class RouteServiceProvider extends ServiceProvider
{
    const PRODUCTION_TTL = null;
    const DEFAULT_TTL = 120;

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
        $this->registerContainerRoutes();
    }

    /**
     * Register routes for all containers.
     *
     * @return void
     */
    protected function registerContainerRoutes()
    {
        $routeFiles = glob(base_path('src/Containers/*/*/*/*/*/*Route.php'));

        $ttl = match ($this->app->environment()) {
            'production' => self::PRODUCTION_TTL,
            default => self::DEFAULT_TTL
        };

        $routes = Cache::remember(
            key: 'src_routes',
            ttl: $ttl,
            callback: fn () => 
                collect($routeFiles)
                ->map(function ($routeFilePath) {
                    $className = Str::of($routeFilePath)
                    ->replace(base_path('src'), 'Src')
                    ->replace('.php', '')
                    ->replace('/', '\\')
                    ->toString();

                    $route = class_exists($className) ? new $className : null;

                    return $route;
                })
                ->filter()
        );

        $routes->each(function($route) {
            if ($route instanceof RouteContract) {
                $finalRoute = Route::match(
                    methods: $route->getMethod(),
                    uri: $route->getFinalPath(),
                    action: $route->getControllerMethodName() 
                        ? [$route->getControllerClass(), $route->getControllerMethodName()]
                        : $route->getControllerClass()
                );

                if (! empty($middlewares = $route->getFinalMiddlewares())) {
                    $finalRoute->middleware($middlewares);
                }
            }
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
