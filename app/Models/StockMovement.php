<?php

namespace App\Models;

use App\Enums\StockMovementType;
use App\Observers\StockMovementObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @method static \Database\Factories\StockMovementFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement withoutTrashed()
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereUpdatedAt($value)
 * @property int $product_id
 * @property int|null $warehouse_id
 * @property int $quantity
 * @property string $unit_cost
 * @property string $total_cost
 * @property string $type
 * @property string $reference_type
 * @property int $reference_id
 * @property int $recorded_by_user_id
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereRecordedByUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereReferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereReferenceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereTotalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereUnitCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement whereWarehouseId($value)
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\User $recordedBy
 * @property-read \App\Models\Warehouse|null $warehouse
 * @mixin \Eloquent
 */
#[ObservedBy(StockMovementObserver::class)]
class StockMovement extends Model {
    /** @use HasFactory<\Database\Factories\StockMovementFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'product_id',
        'warehouse_id',
        'quantity',
        'unit_cost',
        'total_cost',
        'type',
        'reference_type',
        'reference_id',
        'recorded_by_user_id',
        'notes',
    ];
    protected $casts = [
        'quantity' => 'integer',
        'unit_cost' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'type' => StockMovementType::class,
    ];
    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }
    public function warehouse(): BelongsTo {
        return $this->belongsTo(Warehouse::class);
    }
    public function recordedBy(): BelongsTo {
        return  $this->belongsTo(User::class, 'recorded_by_user_id');
    }
}
