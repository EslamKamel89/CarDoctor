<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Warehouse;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseItem>
 */
class PurchaseItemFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'purchase_id' => Purchase::factory(),
            'product_id'  => Product::factory(),
            'warehouse_id' => Warehouse::query()->value('id') ?? Warehouse::factory(),
            'quantity'    => 10,
            'unit_cost'   => 100.00,
            'total_cost'  => 1000.00,
        ];
    }
}
