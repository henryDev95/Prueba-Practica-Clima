<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $locations = [
            'Ecuador' => [
                'Pichincha' => ['latitude' => [-0.60, 0.18], 'longitude' => [-78.62, -78.33]],
                'Guayas' => ['latitude' => [-2.90, -1.50], 'longitude' => [-80.20, -79.00]],
                'Manabí' => ['latitude' => [-1.50, -0.05], 'longitude' => [-80.82, -80.03]],
                'Azuay' => ['latitude' => [-3.20, -2.20], 'longitude' => [-79.40, -78.80]],
            ],
            'USA' => [
                'California' => ['latitude' => [32.5, 42.0], 'longitude' => [-124.3, -114.1]],
                'Texas' => ['latitude' => [25.8, 36.5], 'longitude' => [-106.7, -93.5]],
                'Florida' => ['latitude' => [24.4, 31.0], 'longitude' => [-87.6, -79.8]],
                'New York' => ['latitude' => [40.5, 45.0], 'longitude' => [-79.8, -71.8]],
            ],
        ];

        $country = $this->faker->randomElement(array_keys($locations));

        $state = $this->faker->randomElement(array_keys($locations[$country]));
        $latitudeRange = $locations[$country][$state]['latitude'];
        $longitudeRange = $locations[$country][$state]['longitude'];


        return [
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'state' => $state,
            'country' => $country,
            'latitude' => $this->faker->randomFloat(6, $latitudeRange[0], $latitudeRange[1]),
            'longitude' => $this->faker->randomFloat(6, $longitudeRange[0], $longitudeRange[1]),
        ];
    }
}
