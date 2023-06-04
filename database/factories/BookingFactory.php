<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cottage;
use App\Models\Booking;
use Carbon\Carbon;

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
        $cottage = Cottage::inRandomOrder()->first();
        $start_date = Carbon::now()->addDays(rand(1, 365));
        $end_date = (clone $start_date)->addDays(rand(1, 14));

        // Check for overlapping bookings
        while (Booking::where('cottage_id', $cottage->id)
            ->where(function ($query) use ($start_date, $end_date) {
                $query->whereBetween('start_date', [$start_date, $end_date])
                    ->orWhereBetween('end_date', [$start_date, $end_date]);
            })->exists()) {
            // If overlap, try new dates
            $start_date = Carbon::now()->addDays(rand(1, 365));
            $end_date = (clone $start_date)->addDays(rand(1, 14));
        }

        return [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'price' => $this->faker->numberBetween(100, 1000),
            'name' => $this->faker->name,
            'surname' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber,
            'persons' => $this->faker->numberBetween(1, 10),
            'cottage_id' => $cottage->id,
            'option_id' => 1,
            'status_id' => $this->faker->numberBetween(1, 4),
        ];
    }
}
