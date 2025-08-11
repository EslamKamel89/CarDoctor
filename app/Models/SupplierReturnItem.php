<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $supplier_return_id
 * @property int $purchase_item_id
 * @property int $product_id
 * @property int $quantity
 * @property numeric $unit_refund
 * @property numeric $total_refund
 * @property bool $is_defective
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\PurchaseItem $purchaseItem
 * @property-read \App\Models\SupplierReturn $supplierReturn
 * @method static \Database\Factories\SupplierReturnItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturnItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturnItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturnItem onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturnItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturnItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturnItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturnItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturnItem whereIsDefective($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturnItem whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturnItem wherePurchaseItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturnItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturnItem whereSupplierReturnId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturnItem whereTotalRefund($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturnItem whereUnitRefund($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturnItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturnItem withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturnItem withoutTrashed()
 * @mixin \Eloquent
 */
class SupplierReturnItem extends Model {
    /** @use HasFactory<\Database\Factories\SupplierReturnItemFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'supplier_return_id',
        'purchase_item_id',
        'product_id',
        'quantity',
        'unit_refund',
        'total_refund',
        'is_defective',
    ];
    protected $casts = [
        'quantity' => 'integer',
        'unit_refund' => 'decimal:2',
        'total_refund' => 'decimal:2',
        'is_defective' => 'boolean',
    ];
    public function supplierReturn(): BelongsTo {
        return $this->belongsTo(SupplierReturn::class);
    }

    public function purchaseItem(): BelongsTo {
        return $this->belongsTo(PurchaseItem::class);
    }
    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }
}
