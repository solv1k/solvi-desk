<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

final class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $global_files = glob(app_path('Global') . DIRECTORY_SEPARATOR . '*.php');

        if (! $global_files) {
            return;
        }

        foreach ($global_files as $file) {
            require_once $file;
        }
    }
}
