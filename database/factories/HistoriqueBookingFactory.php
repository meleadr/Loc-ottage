<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class HistoriqueBookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_user' => $this->faker->numberBetween(1, 2),
			'id_booking' => $this->faker->numberBetween(1, 10),
			'id_status_before' => $this->faker->numberBetween(1, 4),
			'id_status_after' => $this->faker->numberBetween(1, 4),
        ];
    }
}
