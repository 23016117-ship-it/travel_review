<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ReviewSeeder extends Seeder
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

        for ($i = 0; $i < 20; $i++) {
            Review::create([
                'title' => Str::title($faker->words(6, true)),
                'content' => $faker->paragraphs(4, true),
                'image' => null,
                'status' => 'approved',
                'user_id' => $users->random()->id,
                'location_id' => $locations->random()->id,
            ]);
        }
    }
}
