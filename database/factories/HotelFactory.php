<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_hotel' => $this->faker->company(),
            'id_review' => $this->faker->numberBetween(1, 10),
            'alamat_hotel' => $this->faker->address(),
            'cabang_hotel' => $this->faker->randomElement(['Badung', 'Gianyar', 'Denpasar', 'Tabanan', 'Karangasem', 'Bangli', 'Buleleng', 'Klungkung', 'Jembrana', 'Nusa Penida']),
            'lat' => $this->faker->latitude(),
            'lng' => $this->faker->longitude(),
        ];
    }
}
