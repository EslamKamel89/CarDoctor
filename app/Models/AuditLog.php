<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model {
    /** @use HasFactory<\Database\Factories\AuditLogFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'action',
        'subject_type',
        'subject_id',
        'description_ar',
        'description_en',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
    ];
}
