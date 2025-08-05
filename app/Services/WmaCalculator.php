<?php

namespace App\Services\WmaCalculator;

use App\Enums\StockMovementType;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Database\Eloquent\Collection;

class WmaCalculator {
    public function recalculate(Product $product): float {
        /** @var Collection<StockMovement> $movements */
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
        return $totalQty > 0 ? round($totalValue / $totalQty, 2) : 0;
    }
    /**
     * Summary of calculateFromMovements
     * @param Collection<StockMovement> $movements
     * @return float
     */
    public function calculateFromMovements($movements): float {
        $filtered =  $movements->whereIn('type', StockMovementType::costAffecting());
        $totalQty = 0;
        $totalValue = 0;
        foreach ($filtered as $m) {
            $totalQty += $m->quantity;
            $totalValue += $m->total_cost;
        }
        return $totalQty > 0 ? round($totalValue / $totalQty, 2) : 0;
    }
}
