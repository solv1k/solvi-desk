<?php

namespace App\Providers;

use App\Services\File\BasicFileService;
use App\Services\File\FileService;
use App\Services\Sms\SmsService;
use App\Services\Sms\FakeSmsService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FileService::class, BasicFileService::class);
        $this->app->bind(SmsService::class, FakeSmsService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
