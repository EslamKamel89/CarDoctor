<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model {
    /** @use HasFactory<\Database\Factories\InvoiceFactory> */
    use HasFactory;
    protected $fillable = [
        'client_id',
        'client_vehicle_id',
        'user_id',
        'invoice_number',
        'date',
        'status',
        'calculated_total',
        'actual_paid_amount',
        'payment_method',
        'labor_info',
        'notes',
    ];
}
