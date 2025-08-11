<?php

namespace App\Observers;

use App\Models\Purchase;

class PurchaseObserver {
    public function created(Purchase $purchase): void {
    }

    public function updated(Purchase $purchase): void {
    }

    public function deleted(Purchase $purchase): void {
    }

    public function restored(Purchase $purchase): void {
    }

    public function forceDeleted(Purchase $purchase): void {
    }
}
