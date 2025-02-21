<?php

namespace App\Jobs;

use App\Contracts\WeatherServiceInterface;
use App\Models\Location;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class UpdateWeatherForLocationJob implements ShouldQueue
{
    protected Location $location;

    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    /**
     * Execute the job.
     */
    public function handle(WeatherServiceInterface $weatherService): void
    {
      Log::info('Updating weather for location', ['location' => $this->location]);
      $weatherService->updateWeatherApiDataByLocation($this->location);
    }
}
