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
        if (!$invoice->isDirty() && $invoice->status != 'paid') {
            return;
        }
        $this->createSaleStockMovements($invoice);
    }

    public function deleted(Invoice $invoice): void {
        DB::table('stock_movements')
            ->where('reference_type', Invoice::class)
            ->where('reference_id', $invoice->id)
            ->update([
                'deleted_at' => now(),
            ]);
    }

    public function restored(Invoice $invoice): void {
        DB::table('stock_movements')
            ->where('reference_type', Invoice::class)
            ->where('reference_id', $invoice->id)
            ->update([
                'deleted_at' => null,
            ]);
    }

    public function forceDeleted(Invoice $invoice): void {
    }
    protected function createSaleStockMovements(Invoice $invoice): void {
        DB::transaction(function () use ($invoice) {
            foreach ($invoice->items as $item) {
                StockMovement::create([
                    'product_id' => $item->product_id,
                    'warehouse_id' => $item->warehouse_id,
                    'quantity' => -$item->quantity,
                    'unit_cost' => $item->product->current_cost_price,
                    'total_cost' => $item->quantity * $item->product->current_cost_price,
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
