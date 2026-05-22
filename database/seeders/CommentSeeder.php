<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $reviews = Review::all();

        if ($users->isEmpty() || $reviews->isEmpty()) {
            return;
        }

        $faker = app(\Faker\Generator::class);

        for ($i = 0; $i < 30; $i++) {
            Comment::create([
                'content' => $faker->sentence(12),
                'status' => 'approved',
                'user_id' => $users->random()->id,
                'review_id' => $reviews->random()->id,
            ]);
        }
    }
}
