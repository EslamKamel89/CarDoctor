<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'name_ar' => 'فلتر زيت ' . fake()->randomNumber(4),
            'name_en' => 'Oil Filter ' . fake()->randomNumber(4),
            'current_cost_price' => 0,      // WMA will set it
            'quantity_on_hand'   => 0,      // Observer will update it
        ];
    }
}
