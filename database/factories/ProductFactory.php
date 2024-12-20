<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->word . ' ' . fake()->numberBetween(1, 100),
            'description' => fake()->paragraph,
            'price' => fake()->randomFloat(2, 50, 500),
            'image' => fake()->imageUrl(400, 300, 'product', true),
        ];
    }
}
