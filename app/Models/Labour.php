<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labour extends Model {
    /** @use HasFactory<\Database\Factories\LabourFactory> */
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'base_fee',
        'is_active',
    ];
    protected function casts(): array {
        return [
            'is_active' => 'boolean',
        ];
    }
}
