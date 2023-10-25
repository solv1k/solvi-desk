<?php

declare(strict_types=1);

namespace App\Board;

use App\Board\Common\Contracts\Routes\ApiRoute;
use App\Board\Common\Contracts\Routes\Route as RouteContract;
use App\Board\Common\Contracts\Routes\WebRoute;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class BoardServiceProvider extends ServiceProvider
{
    /** @var array<string> */
    public const MODULES = ['advert'];

    public function boot(): void
    {
        $this->bootModules();
        $this->registerRoutes();
    }

    public function register(): void
    {
        $this->registerModules();
    }

    protected function bootModules(): void
    {
        collect(self::MODULES)->each(fn ($module) => $this->bootSingleModule($module));
    }

    protected function bootSingleModule(string $moduleName): void
    {
        $moduleProviders = $this->findModuleProviders($moduleName);

        collect($moduleProviders)
            ->each(static function (ServiceProvider $moduleProvider): void {
                if (method_exists($moduleProvider, 'boot')) {
                    $moduleProvider->boot(); /** @phpstan-ignore-this-line */
                }
            });
    }

    protected function registerModules(): void
    {
        collect(self::MODULES)->each(fn ($module) => $this->registerSingleModule($module));
    }

    protected function registerSingleModule(string $moduleName): void
    {
        $moduleProviders = $this->findModuleProviders($moduleName);

        collect($moduleProviders)
            ->each(static function (ServiceProvider $moduleProvider): void {
                if (method_exists($moduleProvider, 'register')) {
                    $moduleProvider->register();
                }
            });
    }

    /**
     * @return Collection<int, ServiceProvider>
     */
    protected function findModuleProviders(string $moduleName): Collection
    {
        $providerFilePaths = glob($this->moduleFolder($moduleName) . '/*/*Provider.php');

        if (empty($providerFilePaths)) {
            return collect();
        }

        return collect($providerFilePaths)
            ->map(
                fn ($providerFilePath) => $this->makeServiceProvider($providerFilePath)
            );
    }

    protected function moduleFolder(string $moduleName): string
    {
        return app_path('Board/Modules/' . str($moduleName)->lower()->ucfirst());
    }

    protected function makeServiceProvider(string $providerFilePath): ServiceProvider
    {
        $spClass = $this->classNameFromFilePath($providerFilePath);

        if (! class_exists($spClass)) {
            throw new \Exception('The service provider class does not exist.');
        }

        $spInstance = new $spClass($this->app);

        if (! $spInstance instanceof ServiceProvider) {
            throw new \Exception('An instance of the "ServiceProvider" class is expected.');
        }

        return $spInstance;
    }

    protected function classNameFromFilePath(string $filePath): string
    {
        return 'App\\' . str($filePath)
            ->replace(app_path('Board'), 'Board')
            ->replace('.php', '')
            ->replace('/', '\\')
            ->toString();
    }

    protected function registerRoutes(): void
    {
        collect(self::MODULES)->each(fn ($module) => $this->registerModuleRoutes($module));
    }

    /**
     * Register routes for all modules.
     */
    protected function registerModuleRoutes(string $moduleName): void
    {
        /** @var Collection<int, RouteContract> */
        $routes = Cache::remember(
            key: 'Board::routes::' . $moduleName,
            ttl: 10,
            callback: function () use ($moduleName) {
                $routeFiles = glob($this->moduleFolder($moduleName) . '/*/*/*/*Route.php') ?: [];

                return collect($routeFiles)
                    ->map(function ($routeFilePath) {
                        $className = $this->classNameFromFilePath($routeFilePath);
                        $route = class_exists($className) ? new $className() : null;

                        return $route;
                    })
                    ->filter();
            }
        );

        $routes->each(static function ($route): void {
            if ($route instanceof RouteContract) {
                $routeBuilder = Route::match(
                    methods: $route->method(),
                    uri: $route->uri(),
                    action: $route->controllerMethod()
                        ? [$route->controllerClass(), $route->controllerMethod()]
                        : $route->controllerClass()
                );

                if ($route instanceof WebRoute && ! empty($middleware = $route->webMiddleware())) {
                    $routeBuilder->middleware($middleware);
                }

                if ($route instanceof ApiRoute && ! empty($middleware = $route->apiMiddleware())) {
                    $routeBuilder->middleware($middleware);
                }

                if (! empty($middleware = $route->middleware())) {
                    $routeBuilder->middleware($middleware);
                }
            }
        });
    }
}
