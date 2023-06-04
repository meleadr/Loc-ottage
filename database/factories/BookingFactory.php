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
			'start_date' => $this->faker->dateTimeBetween('now', '+1 years'),
			'end_date' => $this->faker->dateTimeBetween('+1 years', '+1 years +6 months'),
			'price' => $this->faker->numberBetween(100, 1000),
			'name' => $this->faker->name,
			'surname' => $this->faker->lastName,
			'mail' => $this->faker->unique()->safeEmail(),
			'phone' => $this->faker->phoneNumber,
			'persons' => $this->faker->numberBetween(1, 10),
			'status' => 'pending',
			'cottage_id' => $this->faker->numberBetween(1, 10),
			'option_id' => $this->faker->numberBetween(1, 10),
			'status_id' => $this->faker->numberBetween(1, 10),
		];
	}
}
