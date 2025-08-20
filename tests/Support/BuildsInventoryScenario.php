<?php

namespace Tests\Support;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\CreditNote;
use App\Models\CreditNoteItem;
use App\Models\User;
use App\Models\Warehouse;

trait BuildsInventoryScenario {
    protected function tester(): User {
        return User::firstOrFail();
    }
    protected function warehouse(): Warehouse {
        return Warehouse::firstOrFail();
    }
    protected function purchase(Product $p, int $qty, float $unitCost): Purchase {
        $purchase = Purchase::factory()->create([
            'user_id'      => $this->tester()->id,
            'status'       => 'received', // important: triggers observer
        ]);
        PurchaseItem::factory()->create([
            'purchase_id' => $purchase->id,
            'product_id'  => $p->id,
            'warehouse_id' => $this->warehouse()->id,
            'quantity'    => $qty,
            'unit_cost'   => $unitCost,
            'total_cost'  => $qty * $unitCost,
        ]);
        return $purchase->fresh('items');
    }
    protected function sell(Product $p, int $qty): Invoice {
        $invoice = Invoice::factory()->create([
            'user_id' => $this->tester()->id,
            'status'  => 'paid', // important: triggers sale movements
        ]);

        InvoiceItem::factory()->create([
            'invoice_id'  => $invoice->id,
            'product_id'  => $p->id,
            'warehouse_id' => $this->warehouse()->id,
            'quantity'    => $qty,
        ]);

        return $invoice->fresh('items');
    }
    protected function creditReturn(InvoiceItem $ii, int $qty, bool $damaged = false): CreditNote {
        $cn = CreditNote::factory()->create([
            'user_id' => $this->tester()->id,
        ]);

        CreditNoteItem::factory()->create([
            'credit_note_id' => $cn->id,
            'invoice_item_id' => $ii->id,
            'product_id'     => $ii->product_id,
            'quantity'       => $qty,
            'is_damaged'     => $damaged,
        ]);

        return $cn->fresh('items');
    }
}
