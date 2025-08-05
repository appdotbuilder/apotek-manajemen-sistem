<?php

namespace Database\Factories;

use App\Models\Distributor;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductStock>
 */
class ProductStockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $costPrice = fake()->numberBetween(1000, 50000);
        $initialStock = fake()->numberBetween(50, 200);
        
        return [
            'product_id' => Product::factory(),
            'distributor_id' => Distributor::factory(),
            'batch_number' => fake()->bothify('BATCH###'),
            'expiry_date' => fake()->dateTimeBetween('now', '+2 years'),
            'cost_price' => $costPrice,
            'selling_price' => $costPrice * 1.5,
            'current_stock' => $initialStock,
            'initial_stock' => $initialStock,
        ];
    }
}