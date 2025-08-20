<?php

namespace App\Observers;

use App\Models\SupplierReturn;
use App\Enums\StockMovementType;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;

class SupplierReturnObserver {
    public function created(SupplierReturn $return): void {
        DB::transaction(function () use ($return) {
            foreach ($return->items as $item) {
                $originalItem = $item->purchaseItem;
                if (!$originalItem) continue;
                $unitCost = $originalItem->unit_cost;
                $totalCost = $item->quantity * $unitCost;
                // Create `return_to_supplier` movement (negative quantity)
                StockMovement::create([
                    'product_id' => $item->product_id,
                    'warehouse_id' => $originalItem->warehouse_id,
                    'quantity' => -$item->quantity, // removing from inventory
                    'unit_cost' => $unitCost,
                    'total_cost' => $totalCost,
                    'type' => StockMovementType::ReturnToSupplier,
                    'reference_type' => SupplierReturn::class,
                    'reference_id' => $return->id,
                    'recorded_by_user_id' => $return->user_id,
                    'notes' => "Return to supplier for purchase #{$return->purchase->purchase_number}",
                ]);
            }
            // 🔹 Handle lost bulk discount
            if ($return->bulk_discount_lost && false) {
                $this->applyCostAdjustment($return);
            }
        });
    }

    public function updated(SupplierReturn $return): void {
    }

    public function deleted(SupplierReturn $return): void {
        StockMovement::where('reference_type', SupplierReturn::class)
            ->where('reference_id', $return->id)
            ->delete();
    }

    public function restored(SupplierReturn $return): void {
        StockMovement::where('reference_type', SupplierReturn::class)
            ->where('reference_id', $return->id)
            ->update(['deleted_at' => null]);
    }

    public function forceDeleted(SupplierReturn $return): void {
    }
    // this method is not called for now because it need more testing on it's functionality
    protected function applyCostAdjustment(SupplierReturn $return): void {
        foreach ($return->items as $item) {
            $product = $item->product;
            if (!$product) continue;

            $movements = $product->stockMovements()
                ->whereIn('type', StockMovementType::costAffecting())
                ->orderBy('created_at', 'asc')
                ->get();

            $totalQty = 0;
            $totalValue = 0;

            foreach ($movements as $m) {
                $totalQty += $m->quantity;
                $totalValue += $m->total_cost;
            }

            if ($totalQty <= 0) continue;

            $currentAvgCost = $totalValue / $totalQty;
            $newUnitCost = $currentAvgCost * 1.10; // 10% increase
            $adjustmentAmount = ($newUnitCost - $currentAvgCost) * $totalQty;

            if ($adjustmentAmount > 0) {
                StockMovement::create([
                    'product_id' => $product->id,
                    'quantity' => 0,
                    'unit_cost' => $newUnitCost,
                    'total_cost' => $adjustmentAmount,
                    'type' => StockMovementType::CostAdjustment,
                    'reference_type' => SupplierReturn::class,
                    'reference_id' => $return->id,
                    'recorded_by_user_id' => $return->user_id,
                    'notes' => "Cost adjustment: bulk discount lost on return #{$return->return_number}",
                ]);
            }
        }
    }
}
