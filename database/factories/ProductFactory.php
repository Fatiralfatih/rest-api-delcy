<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => fake()->slug(2, false),
            'title' => fake()->sentence(3, true),
            'price' => fake()->randomNumber(5, true),
            'stock' => fake()->randomNumber(2, true),
            'description' => fake()->paragraph(),
            'thumbnail' => fake()->imageUrl(640, 480, 'products', false, 'delcy')
        ];
    }
}