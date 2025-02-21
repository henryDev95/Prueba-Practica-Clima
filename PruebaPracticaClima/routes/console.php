<?php

use App\Jobs\FetchWeatherJob;
use App\Contracts\LocationServiceInterface;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Scheduling\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

//// Register scheduled jobs
//app()->booted(function () {
//    $schedule = app(Schedule::class);
//
//    // Schedule FetchWeatherJob to run every hour
//    $schedule->call(function () {
//        dispatch(new FetchWeatherJob(app(LocationServiceInterface::class)));
//    })->hourly();
//});
