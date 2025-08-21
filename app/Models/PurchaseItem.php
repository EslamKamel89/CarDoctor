<?php

namespace App\Models;

use App\Observers\PurchaseItemObserver;
use App\Observers\PurchaseObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $purchase_id
 * @property int $product_id
 * @property int $warehouse_id
 * @property int $quantity
 * @property numeric $unit_cost
 * @property numeric $total_cost
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Purchase $purchase
 * @property-read \App\Models\Warehouse $warehouse
 * @method static \Database\Factories\PurchaseItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseItem onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseItem whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseItem wherePurchaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseItem whereTotalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseItem whereUnitCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseItem whereWarehouseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseItem withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseItem withoutTrashed()
 * @mixin \Eloquent
 */
#[ObservedBy(PurchaseItemObserver::class)]
class PurchaseItem extends Model {
    /** @use HasFactory<\Database\Factories\PurchaseItemFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'purchase_id',
        'product_id',
        'warehouse_id',
        'quantity',
        'unit_cost',
        'total_cost',
        'notes',
    ];
    protected $casts = [
        'quantity' => 'integer',
        'unit_cost' => 'decimal:2',
        'total_cost' => 'decimal:2',
    ];
    public function purchase(): BelongsTo {
        return $this->belongsTo(Purchase::class);
    }
    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }
    public function warehouse(): BelongsTo {
        return $this->belongsTo(Warehouse::class);
    }
}
