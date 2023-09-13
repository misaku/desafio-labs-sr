<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'opened' => fake()->time('H:i'),
            'closed' => fake()->time('H:i'),
            'fullTime' => fake()->boolean(), // password
            'lat' => fake()->randomDigit(),
            'lng' => fake()->randomDigit(),
        ];
    }
}
