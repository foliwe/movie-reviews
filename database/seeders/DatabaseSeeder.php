<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Movie;
use App\Models\Review;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // good reviews
        Movie::factory(20)->create()->each( function ($movie){
            $numberReviews = random_int(3, 20);
            Review::factory()->count($numberReviews)
                ->good()
                ->for($movie)
                ->create();
        });

        //average Reviews
        Movie::factory(30)->create()->each( function ($movie){
            $numberReviews = random_int(3, 20);
            Review::factory()->count($numberReviews)
                ->average()
                ->for($movie)
                ->create();
        });

       // bad reviews
        Movie::factory(50)->create()->each( function ($movie){
            $numberReviews = random_int(3, 20);
            Review::factory()->count($numberReviews)
                ->poor()
                ->for($movie)
                ->create();
        });
    }
}