<?php

namespace Database\Factories;

use App\Models\ProductStock;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SaleItem>
 */
class SaleItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 5);
        $unitPrice = fake()->numberBetween(1000, 25000);
        $discountAmount = fake()->numberBetween(0, $unitPrice * 0.1 * $quantity);
        $subtotal = ($unitPrice * $quantity) - $discountAmount;
        $costPrice = $unitPrice * 0.7;
        
        return [
            'sale_id' => Sale::factory(),
            'product_stock_id' => ProductStock::factory(),
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'discount_amount' => $discountAmount,
            'subtotal' => $subtotal,
            'cost_price' => $costPrice,
        ];
    }
}