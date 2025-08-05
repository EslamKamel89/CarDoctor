<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @property int $id
 * @property int $invoice_id
 * @property int $client_id
 * @property numeric $original_amount
 * @property numeric $paid_amount
 * @property numeric $remaining_amount
 * @property \Illuminate\Support\Carbon|null $due_date
 * @property string|null $notes
 * @property bool $is_settled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client $client
 * @property-read \App\Models\Invoice $invoice
 * @method static \Database\Factories\DebtFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereIsSettled($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereOriginalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt wherePaidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereRemainingAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt withoutTrashed()
 * @mixin \Eloquent
 */
class Debt extends Model {
    /** @use HasFactory<\Database\Factories\DebtFactory> */
    use HasFactory;
    use SoftDeletes;
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
