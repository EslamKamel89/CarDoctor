<?php

namespace App\Observers;

use App\Models\StockMovement;

class StockMovementObserver {
    public function created(StockMovement $stockMovement): void {
    }

    public function updated(StockMovement $stockMovement): void {
    }

    public function deleted(StockMovement $stockMovement): void {
    }

    public function restored(StockMovement $stockMovement): void {
    }

    public function forceDeleted(StockMovement $stockMovement): void {
    }
}
