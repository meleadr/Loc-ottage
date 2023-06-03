<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cottage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CottageFactory>
 */
class CottageFactory extends Factory
{
	/**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cottage::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'name' => $this->faker->word,
			'area' => $this->faker->numberBetween(10, 100),
			'bedrooms' => $this->faker->numberBetween(1, 5),
			'persons' => $this->faker->numberBetween(1, 10),
			'description' => $this->faker->sentence,
			'price' => $this->faker->numberBetween(100, 1000),
        ];
    }
}
