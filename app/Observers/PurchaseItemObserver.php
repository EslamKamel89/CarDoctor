<?php

namespace App\Observers;

use App\Enums\StockMovementType;
use App\Models\PurchaseItem;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;

class PurchaseItemObserver {
    public function created(PurchaseItem $item): void {
        $this->syncMovement($item);
    }

    public function updated(PurchaseItem $item): void {
        $this->syncMovement($item);
    }

    public function deleted(PurchaseItem $item): void {
        // Soft-delete the linked movement (if any)
        StockMovement::where([
            'reference_type' => PurchaseItem::class,
            'reference_id'   => $item->id,
            'type'           => StockMovementType::Purchase,
        ])->get()->each(fn($m) => $m->delete());
    }

    public function restored(PurchaseItem $item): void {
        // Restore the linked movement only if parent purchase is received
        if ($item->purchase?->status !== 'received') {
            return;
        }

        StockMovement::withTrashed()
            ->where([
                'reference_type' => PurchaseItem::class,
                'reference_id'   => $item->id,
                'type'           => StockMovementType::Purchase,
            ])->get()->each(function ($m) use ($item) {
                $m->restore();
                // also resync fields in case item was edited while soft-deleted
                $m->fill([
                    'product_id'          => $item->product_id,
                    'warehouse_id'        => $item->warehouse_id,
                    'quantity'            => $item->quantity,
                    'unit_cost'           => $item->unit_cost,
                    'total_cost'          => $item->total_cost,
                    'recorded_by_user_id' => $item->purchase?->user_id,
                    'notes'               => "Purchase #{$item->purchase?->purchase_number}",
                ])->save();
            });

        // If nothing existed (rare), create it now
        if (! StockMovement::withTrashed()->where([
            'reference_type' => PurchaseItem::class,
            'reference_id'   => $item->id,
            'type'           => StockMovementType::Purchase,
        ])->exists()) {
            $this->createMovement($item);
        }
    }

    public function forceDeleted(PurchaseItem $item): void {
        StockMovement::withTrashed()
            ->where([
                'reference_type' => PurchaseItem::class,
                'reference_id'   => $item->id,
                'type'           => StockMovementType::Purchase,
            ])->forceDelete();
    }


    protected function syncMovement(PurchaseItem $item): void {
        if ($item->purchase?->status !== 'received') {
            return;
        }

        DB::transaction(function () use ($item) {
            $movement = StockMovement::withTrashed()->firstOrNew([
                'reference_type' => PurchaseItem::class,
                'reference_id'   => $item->id,
                'type'           => StockMovementType::Purchase,
            ]);

            $movement->fill([
                'product_id'          => $item->product_id,
                'warehouse_id'        => $item->warehouse_id,
                'quantity'            => $item->quantity,
                'unit_cost'           => $item->unit_cost,
                'total_cost'          => $item->total_cost,
                'recorded_by_user_id' => $item->purchase?->user_id,
                'notes'               => "Purchase #{$item->purchase?->purchase_number}",
            ]);

            if ($movement->trashed()) {
                $movement->restore();
            }

            $movement->save();
        });
    }

    protected function createMovement(PurchaseItem $item): void {
        DB::transaction(function () use ($item) {
            StockMovement::create([
                'product_id'          => $item->product_id,
                'warehouse_id'        => $item->warehouse_id,
                'quantity'            => $item->quantity,  // +in
                'unit_cost'           => $item->unit_cost,
                'total_cost'          => $item->total_cost,
                'type'                => StockMovementType::Purchase,
                'reference_type'      => PurchaseItem::class,
                'reference_id'        => $item->id,
                'recorded_by_user_id' => $item->purchase?->user_id,
                'notes'               => "Purchase #{$item->purchase?->purchase_number}",
            ]);
        });
    }
}
