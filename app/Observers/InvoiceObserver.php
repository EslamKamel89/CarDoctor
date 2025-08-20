<?php

namespace App\Observers;

use App\Enums\StockMovementType;
use App\Models\Invoice;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;

class InvoiceObserver {
    public function created(Invoice $invoice): void {
        if ($invoice->status != 'paid') {
            return;
        }
        $this->createSaleStockMovements($invoice);
    }

    public function updated(Invoice $invoice): void {
        if ($invoice->wasChanged('status') && $invoice->status === 'paid') {
            $this->createSaleStockMovements($invoice);
        }
    }

    public function deleted(Invoice $invoice): void {
        StockMovement::where('reference_type', Invoice::class)
            ->where('reference_id', $invoice->id)
            ->get()->each(function ($m) {
                $m->delete();
            });
    }

    public function restored(Invoice $invoice): void {
        StockMovement::where('reference_type', Invoice::class)
            ->where('reference_id', $invoice->id)
            ->get()->each(function ($m) {
                $m->restore();
            });
    }

    public function forceDeleted(Invoice $invoice): void {
    }
    protected function createSaleStockMovements(Invoice $invoice): void {
        $invoice->loadMissing('items.product');
        DB::transaction(function () use ($invoice) {
            foreach ($invoice->items as $item) {
                $exists = StockMovement::where([
                    'reference_type' => Invoice::class,
                    'reference_id'   => $invoice->id,
                    'product_id'     => $item->product_id,
                    'warehouse_id'   => $item->warehouse_id,
                    'type'           => StockMovementType::Sale,
                ])->exists();
                if ($exists) {
                    continue;
                }
                $unitCost = $item->product->current_cost_price;
                $totalCost = $item->quantity * $unitCost;

                if ($item->unit_cost_at_sale !== $unitCost || $item->total_cost_at_sale !== $totalCost) {
                    $item->forceFill([
                        'unit_cost_at_sale' => $unitCost,
                        'total_cost_at_sale' => $totalCost,
                    ])->save();
                }
                StockMovement::create([
                    'product_id' => $item->product_id,
                    'warehouse_id' => $item->warehouse_id,
                    'quantity' => -$item->quantity,
                    'unit_cost' => $unitCost,
                    'total_cost' => $totalCost,
                    'type' => StockMovementType::Sale,
                    'reference_type' => Invoice::class,
                    'reference_id' => $invoice->id,
                    'recorded_by_user_id' => $invoice->user_id,
                    'notes' => "Sale from invoice #{$invoice->invoice_number}",
                ]);
            }
        });
    }
}
