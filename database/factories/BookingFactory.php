<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "room_id" => $this->faker->numberBetween(1, 20),
            "user_id" => $this->faker->numberBetween(1, 10),
            "check_in" => $this->faker->dateTimeBetween("now", "+1 month"),
            "check_out" => $this->faker->dateTimeBetween("+1 month", "+2 months"),
            "total_amount" => $this->faker->numberBetween(100000, 5000000),
            "booking_status" => $this->faker->randomElement(["pending", "confirmed", "cancelled", "completed"]),
            "payment_status" => $this->faker->randomElement(['pending', 'paid', 'refunded']),
            "booking_date" => $this->faker->dateTimeBetween("-1 month", "now"),
            "total_nights" => $this->faker->numberBetween(1, 4),
            "cancellation_date" => null,
        ];
    }
}
