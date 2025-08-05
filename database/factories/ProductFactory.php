<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Unit;
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
        $basePrice = fake()->numberBetween(1000, 50000);
        
        return [
            'name' => fake()->words(3, true),
            'code' => fake()->unique()->bothify('PRD###'),
            'kfa_code' => fake()->optional()->bothify('KFA#####'),
            'description' => fake()->sentence(),
            'category_id' => Category::factory(),
            'unit_id' => Unit::factory(),
            'base_price' => $basePrice,
            'selling_price' => $basePrice * 1.5,
            'min_stock' => fake()->numberBetween(10, 50),
            'is_active' => true,
        ];
    }
}