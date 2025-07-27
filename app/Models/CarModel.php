<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
            'user' => 'array',
        ];
    }
}
