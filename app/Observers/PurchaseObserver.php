<?php

namespace App\Observers;

use App\Models\Purchase;

class PurchaseObserver {
    public function updated(Purchase $purchase): void {
        if ($purchase->wasChanged('status') && $purchase->status === 'received') {
            // Touch items so PurchaseItemObserver::updated runs and posts inventory
            $purchase->items()->each(fn($item) => $item->touch());
        }
    }

    public function deleted(Purchase $purchase): void {
        // Soft-delete items; their observer will soft-delete movements
        $purchase->items()->get()->each(fn($item) => $item->delete());
    }

    public function restored(Purchase $purchase): void {
        // Restore items; their observer will restore movements if applicable
        $purchase->items()->withTrashed()->get()->each(fn($item) => $item->restore());
    }

    public function forceDeleted(Purchase $purchase): void {
        // No-op; children will be force-deleted by FK cascade or separate cleanup.
    }
}
