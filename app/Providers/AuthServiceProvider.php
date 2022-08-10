<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Advert;
use App\Models\UserPhone;
use App\Policies\AdvertPolicy;
use App\Policies\UserPhonePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Advert::class => AdvertPolicy::class,
        UserPhone::class => UserPhonePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
