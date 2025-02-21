<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Weather;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = Location::all();
        foreach ($locations as $location) {
            Weather::create(
                [
                    'location_id' => $location->id,
                    'temperature' => rand(-20, 40),
                    'humidity' => rand(0, 100),
                    'pressure' => rand(900, 1100),
                    'icon' => '01d',
                    'description' => 'Clear',
                ]
            );
        }
    }
}
