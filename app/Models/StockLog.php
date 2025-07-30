<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $product_id
 * @property int $warehouse_id
 * @property int $user_id
 * @property string $change_type
 * @property int $quantity_change
 * @property int $previous_stock
 * @property int $current_stock
 * @property string $reference_type
 * @property int $reference_id
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\StockLogFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereChangeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereCurrentStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog wherePreviousStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereQuantityChange($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereReferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereReferenceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockLog whereWarehouseId($value)
 * @mixin \Eloquent
 */
class StockLog extends Model {
    /** @use HasFactory<\Database\Factories\StockLogFactory> */
    use HasFactory;
    protected $fillable = [
        'product_id',
        'warehouse_id',
        'user_id',
        'change_type',
        'quantity_change',
        'previous_stock',
        'current_stock',
        'reference_type',
        'reference_id',
        'notes',
    ];
}
