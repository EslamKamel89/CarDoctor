<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Supplier;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'supplier_id'   => Supplier::factory(),
            'user_id'       => User::query()->value('id') ?? User::factory(),
            'purchase_date' => now(),
            'total_amount'  => 0,
            'discount'      => 0,
            'final_amount'  => 0,
            'status'        => 'received', // triggers stock movements via Observer
        ];
    }
}
