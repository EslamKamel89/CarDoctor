<?php

namespace Tests\Support;

use App\Models\Product;

trait InventoryAssertions {
    protected function assertOnHand(Product $p, int $expected): void {
        $p->refresh();
        $this->assertSame($expected, (int) $p->quantity_on_hand, "On-hand mismatch for product #{$p->id}");
    }
    protected function assertWma(Product $p, float $expected, int $precision = 2): void {
        $p->refresh();
        $actual = round((float) $p->current_cost_price, $precision);
        $exp    = round($expected, $precision);
        $this->assertSame($exp, $actual, "WMA mismatch for product #{$p->id}");
    }
}
