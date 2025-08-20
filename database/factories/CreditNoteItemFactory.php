<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CreditNote;
use App\Models\InvoiceItem;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CreditNoteItem>
 */
class CreditNoteItemFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'credit_note_id' => CreditNote::factory(),
            'invoice_item_id' => InvoiceItem::factory(),
            'product_id'     => Product::factory(),
            'quantity'       => 1,
            'is_damaged'     => false,
        ];
    }
}
