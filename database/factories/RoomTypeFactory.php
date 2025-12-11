<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room_type>
 */
class RoomTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Single', 'Double', 'Suite', 'Deluxe']),
            'description' => $this->faker->sentence(),
            'max_occupancy' => $this->faker->numberBetween(1, 4),
            'amenities' => implode(', ', $this->faker->randomElements(['WiFi', 'TV', 'Air Conditioning', 'Mini Bar', 'Safe'], 3)),
            'bed_type' => $this->faker->randomElement(['single', 'double', 'twin', 'king', 'queen']),
            'price_per_night' => $this->faker->numberBetween(300000, 2000000),
        ];
    }
}
