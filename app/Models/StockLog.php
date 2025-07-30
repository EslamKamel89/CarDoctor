<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockLog extends Model {
    /** @use HasFactory<\Database\Factories\StockLogFactory> */
    use HasFactory;
    protected $fillable = [
        'product_id',
        'warehouse_id',
        'user_id',
        'change_type',
        'quantity_change',
        'previous_stock',
        'current_stock',
        'reference_type',
        'reference_id',
        'notes',
    ];
}
