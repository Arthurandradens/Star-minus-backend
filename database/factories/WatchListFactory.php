<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\WatchList;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<WatchList>
 */
class WatchListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'url' => $this->faker->url,
            'type' => $this->faker->randomElement(['movie','series']),
            'movie_id' => $this->faker->numberBetween(1, 100),
            'user_id' => 11,
        ];
    }
}
