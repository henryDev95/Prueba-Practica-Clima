<?php

namespace App\Contracts;

use App\Models\Location;

interface WeatherServiceInterface
{
    public function updateWeatherApiDataByLocation(Location $location): void;
}
