<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Room;
use App\Models\Hotel;
use App\Models\RoomType;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_number' => $this->faker->unique()->numberBetween(100, 999),
            'id_rooms_type' => RoomType::factory(),
            'status' => $this->faker->randomElement(['available', 'occupied', 'maintenance', 'out of order']),
            'id_hotel' => Hotel::factory(),
        ];
    }
}
