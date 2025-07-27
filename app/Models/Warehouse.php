<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
