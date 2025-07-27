<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientVehicle extends Model {
    /** @use HasFactory<\Database\Factories\ClientVehicleFactory> */
    use HasFactory;
    protected $fillable = [
        'client_id',
        'car_model_id',
        'plate_number',
        'chasis_number',
        'color',
        'manufacturing_year',
        'notes',
    ];
}
