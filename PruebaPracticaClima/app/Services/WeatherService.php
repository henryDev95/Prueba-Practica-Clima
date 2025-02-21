<?php

namespace App\Services;

use App\Contracts\WeatherServiceInterface;
use App\Models\Weather;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use App\Models\Location;
use Exception;
use Illuminate\Support\Facades\Log;

class WeatherService implements WeatherServiceInterface
{

    protected $baseUrl;
    protected $apiKey;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->baseUrl = env('OPENWEATHERMAP_BASE_URL');
        $this->apiKey = env('OPENWEATHERMAP_API_KEY');
    }

    public function updateWeatherApiDataByLocation(Location $location): void
    {
        try {
            $weatherApiData = $this->getWeatherByCoordinates($location->latitude, $location->longitude);
            if ($weatherApiData) {
                $this->updateWeatherByLocationId($location->id, $weatherApiData);
            }
        }catch (Exception $e) {
            Log::error("Failed to update weather data for location ID: {$location->id}. Error: " . $e->getMessage());
        }
    }

    private function getWeatherByCoordinates(float $latitude, float $longitude, array $exclude = []): ?array
    {
        try{
            $response = Http::get($this->baseUrl, [
                'lat' => $latitude,
                'lon' => $longitude,
                'appid' => $this->apiKey,
                'units' => 'metric', // Use metric units (Celsius). Change to 'imperial' for Fahrenheit.
            ]);

            $response->throw();

            return $response->json();
        } catch (RequestException $e) {
            Log::error("Weather API request failed: " . $e->getMessage());
        } catch (Exception $e) {
            Log::error("Unexpected error while fetching weather data: " . $e->getMessage());
        }
        return null;
    }

    private function updateWeatherByLocationId(int $locationId, array $weatherApiData): void{
        $weather = Weather::where('location_id', $locationId)->first();
        if ($weather) {
            $weather->update([
                'temperature' => $weatherApiData['main']['temp'],
                'humidity' => $weatherApiData['main']['humidity'],
                'pressure' => $weatherApiData['main']['pressure'],
                'icon' => $weatherApiData['weather'][0]['icon'],
                'description' => $weatherApiData['weather'][0]['description'],
                'recorded_at' => now(),
            ]);
        }
    }
}
