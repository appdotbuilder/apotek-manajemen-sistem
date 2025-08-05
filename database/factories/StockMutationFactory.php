<?php

namespace Database\Factories;

use App\Models\ProductStock;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StockMutation>
 */
class StockMutationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $stockBefore = fake()->numberBetween(0, 100);
        $quantity = fake()->numberBetween(-50, 50);
        $stockAfter = max(0, $stockBefore + $quantity);
        
        return [
            'mutation_number' => 'MUT-' . fake()->unique()->numerify('######'),
            'product_stock_id' => ProductStock::factory(),
            'type' => fake()->randomElement(['in', 'out', 'adjustment', 'return_from_customer', 'return_to_distributor']),
            'quantity' => $quantity,
            'stock_before' => $stockBefore,
            'stock_after' => $stockAfter,
            'reason' => fake()->sentence(),
            'reference_type' => fake()->optional()->word(),
            'reference_id' => fake()->optional()->numerify('REF###'),
            'created_by' => User::factory(),
        ];
    }
}