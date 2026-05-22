<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
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

        $faker = app(\Faker\Generator::class);

        foreach ($locations as $location) {
            $selectedUsers = $users->count() > 3 ? $users->random(3) : $users;

            if ($selectedUsers instanceof User) {
                $selectedUsers = collect([$selectedUsers]);
            }

            foreach ($selectedUsers as $user) {
                Rating::create([
                    'score' => $faker->numberBetween(3, 5),
                    'comment' => $faker->sentence(),
                    'user_id' => $user->id,
                    'location_id' => $location->id,
                ]);
            }

            $avg = Rating::where('location_id', $location->id)->avg('score');
            $location->update(['avg_rating' => round((float) $avg, 2)]);
        }
    }
}
