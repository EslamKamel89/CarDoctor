<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Warehouse;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvoiceItem>
 */
class InvoiceItemFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'invoice_id'  => Invoice::factory(),
            'product_id'  => Product::factory(),
            'warehouse_id' => Warehouse::query()->value('id') ?? Warehouse::factory(),
            'quantity'    => 1,
            // Observers will fill unit_cost_at_sale/total_cost_at_sale
        ];
    }
}
