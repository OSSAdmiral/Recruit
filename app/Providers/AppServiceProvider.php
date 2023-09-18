<?php

namespace App\Providers;

use App\Contracts\UpdatesUserProfileInformationContracts;
use App\Implementations\UpdateUserProfileInformationImplementation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->singleton(UpdatesUserProfileInformationContracts::class, UpdateUserProfileInformationImplementation::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
