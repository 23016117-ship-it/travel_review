<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        if (! $admin) {
            return;
        }

        $faker = app(\Faker\Generator::class);
        $regions = ['Ha Noi', 'Da Nang', 'Ho Chi Minh', 'Hue', 'Da Lat', 'Nha Trang', 'Sa Pa', 'Phu Quoc'];
        $categories = ['Beach', 'Mountain', 'City', 'Culture', 'Nature', 'Food', 'Adventure'];

        for ($i = 0; $i < 10; $i++) {
            $name = Str::title($faker->unique()->words(3, true));

            Location::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $faker->paragraphs(3, true),
                'address' => $faker->address(),
                'region' => $faker->randomElement($regions),
                'category' => $faker->randomElement($categories),
                'image' => null,
                'avg_rating' => 0,
                'user_id' => $admin->id,
            ]);
        }
    }
}
