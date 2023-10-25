<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\Image\BasicImageService;
use App\Services\Image\ImageService;
use App\Services\Sms\FakeSmsService;
use App\Services\Sms\SmsService;
use App\Services\Verification\Phone\PhoneVerificationService;
use App\Services\Verification\Phone\SessionPhoneVerificationService;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ImageService::class, BasicImageService::class);
        $this->app->bind(SmsService::class, FakeSmsService::class);
        $this->app->bind(PhoneVerificationService::class, SessionPhoneVerificationService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
