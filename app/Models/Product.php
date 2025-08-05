<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @property int $id
 * @property int|null $category_id
 * @property string|null $code
 * @property string|null $name_ar
 * @property string|null $name_en
 * @property string|null $description_en
 * @property string|null $description_ar
 * @property string|null $buy_price
 * @property string|null $sell_price
 * @property int $min_stock_quantity
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ProductFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereBuyPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDescriptionAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDescriptionEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereMinStockQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereSellPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CarModel> $applicableModels
 * @property-read int|null $applicable_models_count
 * @property-read \App\Models\Category|null $category
 * @property-read mixed $name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InvoiceItem> $invoiceItems
 * @property-read int|null $invoice_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Warehouse> $warehouses
 * @property-read int|null $warehouses_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDeletedAt($value)
 * @property string $current_cost_price
 * @property int $quantity_on_hand
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCurrentCostPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereQuantityOnHand($value)
 * @mixin \Eloquent
 */
class Product extends Model {
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'category_id',
        'code',
        'name_ar',
        'name_en',
        'description_en',
        'description_ar',
        'buy_price',
        'sell_price',
        'min_stock_quantity',
        'notes',
        'current_cost_price',
        'quantity_on_hand',
    ];
    protected $casts = [
        'buy_price' => 'decimal:2',
        'sell_price' => 'decimal:2',
        'min_stock_quantity' => 'integer',
    ];
    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function warehouses(): BelongsToMany {
        return $this->belongsToMany(Warehouse::class, 'product_warehouse')
            ->withPivot('stock_quantity')
            ->withTimestamps();
    }

    public function applicableModels(): BelongsToMany {
        return $this->belongsToMany(
            CarModel::class,
            'product_applicability',
            'product_id',
            'car_model_id'
        )->withPivot('notes')->withTimestamps();
    }

    public function invoiceItems(): HasMany {
        return $this->hasMany(InvoiceItem::class);
    }

    public function getNameAttribute() {
        return app()->isLocale('ar') ? $this->name_ar : $this->name_en;
    }

    public function getStockInWarehouse($warehouseId) {
        return $this->warehouses()
            ->where('warehouse_id', $warehouseId)
            ->first()?->pivot->stock_quantity ?? 0;
    }
}
