<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function index(Request $request): JsonResponse
    {

        Log::info('This is a log message in Laravel', []);

//        $validated = $request->validate([
//            'latitude' => 'required|numeric',
//            'longitude' => 'required|numeric',
//        ]);

//        $validated = [
//            'latitude' => '',
//            'longitude' => '',
//        ];

        Log::info('Latitude -3.16684700', []);
        Log::info('Longitude -79.00813200', []);

        $weather = $this->weatherService->getWeatherByCoordinates('-3.16684700', '-79.00813200');

        Log::info('Weather data', $weather);

        if (!$weather) {
            return response()->json(['message' => 'Unable to fetch weather data'], 500);
        }

        return response()->json($weather);
    }


}
