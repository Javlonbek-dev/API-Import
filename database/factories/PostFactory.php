<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(1),
            'description' => $this->faker->paragraph(1),
            'slug' => $this->faker->slug(),
            'published_at' => $this->faker->date(),
        ];
    }
}
