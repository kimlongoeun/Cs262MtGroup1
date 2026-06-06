<?php
// database/factories/PostFactory.php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'content' => $this->faker->paragraphs(5, true),
            'status' => $this->faker->randomElement(['draft', 'published']),
            'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'views' => $this->faker->numberBetween(0, 500),
        ];
    }
}
