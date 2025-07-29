<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string|null $name_ar
 * @property string|null $name_en
 * @property string|null $location_ar
 * @property string|null $location_en
 * @property string|null $contact_person
 * @property string|null $phone
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\WarehouseFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse whereContactPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse whereLocationAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse whereLocationEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Warehouse whereUpdatedAt($value)
 * @property-read string $location
 * @property-read string $name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @mixin \Eloquent
 */
class Warehouse extends Model {
    /** @use HasFactory<\Database\Factories\WarehouseFactory> */
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'location_ar',
        'location_en',
        'contact_person',
        'phone',
        'is_active',
    ];
    protected function casts(): array {
        return [
            'is_active' => 'boolean',
        ];
    }
    public function products(): BelongsToMany {
        return $this->belongsToMany(
            Product::class,
            'product_warehouse',
            'warehouse_id',
            'product_id',
        )->withPivot(['stock_quantity'])->withTimestamps();
    }
    public function getNameAttribute(): string {
        return app()->isLocale('ar') ? $this->name_ar : $this->name_en;
    }
    public function getLocationAttribute(): string {
        return app()->isLocale('ar') ? $this->location_ar : $this->location_en;
    }
}
