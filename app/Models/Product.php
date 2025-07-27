<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
