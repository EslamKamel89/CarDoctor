<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model {
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'mobile',
        'email',
        'address_ar',
        'address_en',
        'notes',
    ];
}
