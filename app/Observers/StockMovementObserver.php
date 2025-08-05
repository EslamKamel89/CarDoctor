<?php

namespace App\Observers;

use App\Enums\StockMovementType;
use App\Models\Product;
use App\Models\StockMovement;
use \Illuminate\Database\Eloquent\Collection;

class StockMovementObserver {
    public function created(StockMovement $movement): void {
        $product = $movement->product;
        if ($movement->quantity > 0 || $movement->quantity < 0) {
            $product->increment('quantity_on_hand', $movement->quantity);
        }
        if (in_array($movement->type, StockMovementType::costAffecting())) {
            $this->recalculateCurrentCostPrice($movement->product_id);
        }
    }
    protected function recalculateCurrentCostPrice(int $productId) {
        $product = Product::findOrFail($productId);
        /** @var Collection<StockMovement> $movements */
        $movements = $product->stockMovements()
            ->whereIn('type', StockMovementType::costAffecting())
            ->orderBy('created_at', 'asc')
            ->get();
        $totalQty = 0;
        $totalValue = 0;
        foreach ($movements as $m) {
            $totalValue +=  $m->total_cost;
            $totalQty +=  $m->quantity;
        }
        $newCost = $totalQty > 0 ? $totalValue / $totalQty : 0;
        $product::update(['current_cost_price', $newCost]);
    }
    public function updated(StockMovement $movement): void {
    }

    public function deleted(StockMovement $movement): void {
        $product = $movement->product->decrement('quantity_on_hand', $movement->quantity);
        if (in_array($movement->type, StockMovementType::costAffecting())) {
            $this->recalculateCurrentCostPrice($movement->product_id);
        }
    }

    public function restored(StockMovement $movement): void {
        $this->created($movement);
    }

    public function forceDeleted(StockMovement $movement): void {
    }
}
