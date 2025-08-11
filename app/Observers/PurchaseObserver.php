<?php

namespace App\Observers;

use App\Models\Purchase;
use App\Enums\StockMovementType;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;

class PurchaseObserver {
    public function created(Purchase $purchase): void {
        if ($purchase->status !== 'received') {
            return;
        }
        DB::transaction(function () use ($purchase) {
            foreach ($purchase->items as $item) {
                StockMovement::create([
                    'product_id' => $item->product_id,
                    'warehouse_id' => $item->warehouse_id,
                    'quantity' => $item->quantity,
                    'unit_cost' => $item->unit_cost,
                    'total_cost' => $item->total_cost,
                    'type' => StockMovementType::Purchase,
                    'reference_type' => Purchase::class,
                    'reference_id' => $purchase->id,
                    'recorded_by_user_id' => $purchase->user_id,
                    'notes' => "Purchase #{$purchase->purchase_number}",
                ]);
            }
        });
    }

    public function updated(Purchase $purchase): void {
    }

    public function deleted(Purchase $purchase): void {
        StockMovement::where('reference_type', Purchase::class)
            ->where('reference_id', $purchase->id)
            ->delete();
    }

    public function restored(Purchase $purchase): void {
        StockMovement::where('reference_type', Purchase::class)
            ->where('reference_id', $purchase->id)
            ->update(['deleted_at' => null]);
    }

    public function forceDeleted(Purchase $purchase): void {
    }
}
