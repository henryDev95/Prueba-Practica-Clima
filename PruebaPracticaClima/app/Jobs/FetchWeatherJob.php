<?php

namespace App\Jobs;

use App\Contracts\LocationServiceInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class FetchWeatherJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        // Constructor logic if needed
    }

    /**
     * Execute the job.
     */
    public function handle(LocationServiceInterface $locationService): void
    {
        Log::info('Fetching weather for all locations', ['class' => self::class]);

        $locations = $locationService->getAllLocations();
        foreach ($locations as $location) {
            Log::info('Dispatching UpdateWeatherForLocationJob', ['location_id' => $location->id]);
            UpdateWeatherForLocationJob::dispatch($location);
        }
    }
}
