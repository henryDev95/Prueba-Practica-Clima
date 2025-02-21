<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        // Assign a location to each user
        foreach ($users as $user) {
            Location::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
