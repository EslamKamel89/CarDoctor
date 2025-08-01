<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Debt extends Model {
    /** @use HasFactory<\Database\Factories\DebtFactory> */
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'client_id',
        'original_amount',
        'paid_amount',
        'remaining_amount',
        'due_date',
        'notes',
        'is_settled',
    ];
    protected $casts = [
        'original_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'remaining_amount' => 'decimal:2',
        'due_date' => 'date',
        'is_settled' => 'boolean',
    ];
    public function invoice(): BelongsTo {
        return $this->belongsTo(Invoice::class);
    }

    public function client(): BelongsTo {
        return $this->belongsTo(Client::class);
    }
    public function markAsSettled(): void {
        if ($this->remaining_amount <= 0) {
            $this->is_settled = true;
            $this->save();
        }
    }
}
