<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->sentences(asText: true),
            'release_date' => fake()->dateTime(),
            'user_id' => User::factory(),
        ];
    }
}
