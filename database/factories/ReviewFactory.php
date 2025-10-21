<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\reviews>
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
            'user_id' => fake()->numberBetween(1, 10),
            'hotel_id' => fake()->numberBetween(1, 10),
            'judul' => fake()->sentence(3, true),
            'deskripsi' => fake()->paragraphs(3, true),
            'rating' => fake()->numberBetween(1, 5),
        ];
    }
}
