<?php

namespace Tests\Feature\Inventory;

use App\Models\Product;
use Database\Seeders\TestingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Support\BuildsInventoryScenario;
use Tests\Support\InventoryAssertions;
use Tests\TestCase;

class WmaPipelineTest extends TestCase {
    use BuildsInventoryScenario;
    use InventoryAssertions;
    protected function setUp(): void {
        parent::setUp();
        $this->seed(TestingSeeder::class);
    }
    public function test_purchase_sale_return_updates_wma_and_onhand_correctly(): void {
        $p = Product::factory()->create();
        // 1) First purchase: 10 @ 100 => WMA = 100, on-hand = 10
        $this->purchase($p, 10, 100.00);
        $this->assertOnHand($p, 10);
    }
}
