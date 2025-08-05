<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['obat_keras', 'obat_bebas', 'alat_kesehatan', 'vitamin'];
        
        return [
            'name' => fake()->words(2, true),
            'code' => fake()->unique()->bothify('CAT###'),
            'description' => fake()->sentence(),
            'type' => fake()->randomElement($types),
            'is_active' => true,
        ];
    }
}