<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model {
    /** @use HasFactory<\Database\Factories\CarModelFactory> */
    use HasFactory;
    protected $fillable = [
        'brand_id',
        'name_ar',
        'name_en',
        'year_range',
    ];
}
