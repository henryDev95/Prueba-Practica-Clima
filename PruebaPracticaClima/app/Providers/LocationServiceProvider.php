<?php

namespace App\Providers;

use App\Contracts\LocationServiceInterface;
use App\Services\LocationService;
use Illuminate\Support\ServiceProvider;

class LocationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Binding interface to service implementation
        $this->app->bind(LocationServiceInterface::class, LocationService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
