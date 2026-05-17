<?php

namespace Database\Seeders;

use App\Models\Favorite;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $locations = Location::all();

        if ($users->isEmpty() || $locations->isEmpty()) {
            return;
        }

        foreach ($users as $user) {
            $selectedLocations = $locations->random(min(3, $locations->count()));

            if ($selectedLocations instanceof Location) {
                $selectedLocations = collect([$selectedLocations]);
            }

            foreach ($selectedLocations as $location) {
                Favorite::firstOrCreate([
                    'user_id' => $user->id,
                    'location_id' => $location->id,
                ]);
            }
        }
    }
}
