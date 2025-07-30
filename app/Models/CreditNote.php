<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditNote extends Model {
    /** @use HasFactory<\Database\Factories\CreditNoteFactory> */
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'client_id',
        'credit_note_number',
        'issue_date',
        'reason_ar',
        'reason_en',
        'total_refund_amount',
        'payment_refund_method',
    ];
}
