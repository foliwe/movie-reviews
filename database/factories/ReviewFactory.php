<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'movie_id' => null,
            'comment' => fake()->text(random_int(100, 150)),
            'rating' => fake()->numberBetween(1,5),
            'created_at' => fake()->dateTimeBetween('-2 years'),
            'updated_at' => fake()->dateTimeBetween('created_at', 'now'),
        ];
    }

    public function good(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
            'rating' => fake()->numberBetween(3,5),
            ];
        });
    }

    // long form with more than one attribute
    public function average(): Factory
        {
        return $this->state(function (array $attributes) {
            return [
            'rating' => fake()->numberBetween(2,4),
            'created_at' => fake()->dateTimeBetween('-2 years')
            ];
        });
    }




        // short for with only one Attribute
    public function poor(): static
    {
        return $this->state(fn (array $attributes) => [
            'rating' => fake()->numberBetween(1,3),
        ]);
    }
}