<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AuditLog>
 */
class AuditLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'action' => fake()->randomElement(['created', 'updated', 'deleted']),
            'model' => fake()->randomElement(['Product', 'Sale', 'User', 'Stock']),
            'model_id' => fake()->numerify('###'),
            'old_values' => fake()->optional()->randomElements(['field1' => 'old_value', 'field2' => 'old_value2']),
            'new_values' => fake()->optional()->randomElements(['field1' => 'new_value', 'field2' => 'new_value2']),
            'ip_address' => fake()->ipv4(),
            'user_agent' => fake()->userAgent(),
            'user_id' => User::factory(),
        ];
    }
}