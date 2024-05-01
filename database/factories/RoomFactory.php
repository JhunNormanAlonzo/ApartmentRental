<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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

        $uniqueNumber = fake()->unique()->numberBetween(1,40);
        $max_pax = fake()->numberBetween(1,10);
        return [
            'title' => 'Room'.$uniqueNumber,
            'description' => fake()->sentence,
            'max_pax' => $max_pax,
            'current_pax' => fake()->numberBetween(1, $max_pax),
            'price' => fake()->numberBetween(2500, 10000),
            'status' => true
        ];
    }
}
