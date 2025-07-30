<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditNoteItem extends Model {
    /** @use HasFactory<\Database\Factories\CreditNoteItemFactory> */
    use HasFactory;
    protected $fillable = [
        'credit_note_id',
        'invoice_item_id',
        'quantity',
        'refunded_amount',
    ];
}
