<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $brand_id
 * @property string|null $name_ar
 * @property string|null $name_en
 * @property string $year_range
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CarModelFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CarModel whereYearRange($value)
 * @property-read \App\Models\Brand $brand
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClientVehicle> $clientVehicles
 * @property-read int|null $client_vehicles_count
 * @property-read string $name
 * @property-read string $year_range_formatted
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @mixin \Eloquent
 */
class CarModel extends Model {
    /** @use HasFactory<\Database\Factories\CarModelFactory> */
    use HasFactory;
    protected $fillable = [
        'brand_id',
        'name_ar',
        'name_en',
        'year_range',
    ];
    protected function casts(): array {
        return [
            'year_range' => 'array',
        ];
    }
    public function brand(): BelongsTo {
        return $this->belongsTo(Brand::class);
    }
    public function clientVehicles(): HasMany {
        return $this->hasMany(ClientVehicle::class);
    }
    public function products(): BelongsToMany {
        return $this->belongsToMany(
            Product::class,
            'product_applicability',
            'car_model_id',
            'product_id',
        )->withPivot('notes')->withTimestamps();
    }
    public function getNameAttribute(): string {
        return app()->isLocale('ar') ? $this->name_ar : $this->name_en;
    }
    public function getYearRangeFormattedAttribute(): string {
        if (!isset($this->year_range)) return '';
        $years = (array) $this->year_range;
        return count($years) > 1 ? "{$years[0]} -> {$years[1]}" : "{$years[0]} -> حتي الان  ";
    }
}
