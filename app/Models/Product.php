<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 * @mixin \Eloquent
 */
class Product extends Model {
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
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
    ];
}
