<?php

namespace App\Observers;

use App\Models\CreditNote;
use App\Enums\StockMovementType;
use App\Models\CreditNoteItem;
use App\Models\InvoiceItem;
use App\Models\StockMovement;
use Database\Factories\CreditNoteFactory;
use Illuminate\Support\Facades\DB;

class CreditNoteObserver {
    public function created(CreditNote $creditNote): void {
        DB::transaction(function () use ($creditNote) {
            foreach ($creditNote->items as $item) {
                $originalItem  = $item->invoiceItem;
                // if (!$originalItem) {
                //     continue;
                // }
                $saleMovement = StockMovement::where('reference_type', InvoiceItem::class)
                    ->where('reference_id', $originalItem->invoice_id)
                    ->where('product_id', $item->product_id)
                    ->where('type', StockMovementType::Sale)
                    ->first();
                // if (!$saleMovement) {
                //     continue;
                // }
                $unitCost = $saleMovement->unit_cost;
                $totalCost = $unitCost * $item->quantity;
                if ($item->is_damaged) {
                    // the `is_damaged` column don't exist in the invoice_items table so i created it and added it to the fillable property in the model and to the casts.
                    StockMovement::create([
                        'product_id' => $item->product_id,
                        'warehouse_id' => $originalItem->warehouse_id,
                        'quantity' => 0, // No stock return
                        'unit_cost' => $unitCost,
                        'total_cost' => $totalCost,
                        'type' => StockMovementType::WriteOff,
                        'reference_type' => CreditNote::class,
                        'reference_id' => $creditNote->id,
                        'recorded_by_user_id' => $creditNote->user_id,
                        'notes' => "Damaged return from credit note #{$creditNote->credit_note_number}",
                    ]);
                } else {
                    // Part is resalable → return to stock at original COGS
                    StockMovement::create([
                        'product_id' => $item->product_id,
                        'warehouse_id' => $originalItem->warehouse_id,
                        'quantity' => $item->quantity,
                        'unit_cost' => $unitCost,
                        'total_cost' => $totalCost,
                        'type' => StockMovementType::ReturnFromCustomer,
                        'reference_type' => CreditNote::class,
                        'reference_id' => $creditNote->id,
                        'recorded_by_user_id' => $creditNote->user_id,
                        'notes' => "Return from credit note #{$creditNote->credit_note_number}",
                    ]);
                }
            }
        });
    }

    public function updated(CreditNote $creditNote): void {
    }

    public function deleted(CreditNote $creditNote): void {
        StockMovement::where('reference_type', CreditNote::class)
            ->where('reference_id', $creditNote->id)->delete();
    }

    public function restored(CreditNote $creditNote): void {
        StockMovement::where('reference_type', CreditNote::class)
            ->where('reference_id', $creditNote->id)->update([
                'deleted_at' => null,
            ]);
    }

    public function forceDeleted(CreditNote $creditNote): void {
    }
}
