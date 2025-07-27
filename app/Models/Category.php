<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    protected $fillable = [
        'parent_id',
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
    ];
}
