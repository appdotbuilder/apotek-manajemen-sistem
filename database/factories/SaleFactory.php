<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subtotal = fake()->numberBetween(10000, 500000);
        $discountAmount = fake()->numberBetween(0, $subtotal * 0.1);
        $totalAmount = $subtotal - $discountAmount;
        $paidAmount = $totalAmount + fake()->numberBetween(0, 50000);
        
        return [
            'invoice_number' => 'INV-' . fake()->unique()->numerify('######'),
            'sale_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'customer_name' => fake()->optional()->name(),
            'doctor_name' => fake()->optional()->name(),
            'prescription_notes' => fake()->optional()->sentence(),
            'subtotal' => $subtotal,
            'discount_amount' => $discountAmount,
            'total_amount' => $totalAmount,
            'payment_method' => fake()->randomElement(['cash', 'transfer', 'qris']),
            'paid_amount' => $paidAmount,
            'change_amount' => max(0, $paidAmount - $totalAmount),
            'status' => 'completed',
            'created_by' => User::factory(),
        ];
    }
}