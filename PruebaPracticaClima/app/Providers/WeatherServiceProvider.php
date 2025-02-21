<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use App\Jobs\FetchWeatherJob;
use App\Services\WeatherService;
use App\Contracts\WeatherServiceInterface;
use App\Contracts\LocationServiceInterface;

class WeatherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Binding interface to service implementation
        $this->app->bind(WeatherServiceInterface::class, WeatherService::class);
    }



    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);

            // ✅ Schedule FetchWeatherJob to run every hour
            $schedule->job(new FetchWeatherJob())->hourly();
        });
    }
}
