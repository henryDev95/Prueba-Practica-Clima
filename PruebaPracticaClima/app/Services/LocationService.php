<?php

namespace App\Services;

use App\Contracts\LocationServiceInterface;
use App\Contracts\WeatherServiceInterface;
use App\Models\Location;
use Illuminate\Support\Collection;

class LocationService implements LocationServiceInterface
{
    private WeatherServiceInterface $weatherService;

    public function __construct(WeatherServiceInterface $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function getAllLocations(): Collection
    {
        return Location::all();
    }

}
