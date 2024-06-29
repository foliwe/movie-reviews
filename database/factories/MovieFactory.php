<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(20),
            'release_date' => fake()->dateTimeBetween('-25 years'),
            'description' => fake()->text(random_int(100, 200)),
            'genre' => fake()->randomElement(['Action', 'Comedy', 'Drama', 'Horror', 'Science Fiction', 'Romance']),
            'budget' => fake()->numberBetween(9000000, 400000000),
            'created_at' => fake()->dateTimeBetween('-10 years'),
            'updated_at' => fake()->dateTimeBetween('created_at', 'now'),
            ];

    }
}