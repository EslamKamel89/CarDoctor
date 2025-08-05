<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @property int $id
 * @property int $invoice_id
 * @property int|null $client_id
 * @property string $credit_note_number
 * @property string $issue_date
 * @property string $reason_ar
 * @property string $reason_en
 * @property string $total_refund_amount
 * @property string $payment_refund_method
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CreditNoteFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote whereCreditNoteNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote whereIssueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote wherePaymentRefundMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote whereReasonAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote whereReasonEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote whereTotalRefundAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote whereUpdatedAt($value)
 * @property-read \App\Models\Client|null $client
 * @property-read mixed $reason
 * @property-read \App\Models\Invoice $invoice
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CreditNoteItem> $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNote whereDeletedAt($value)
 * @mixin \Eloquent
 */
class CreditNote extends Model {
    /** @use HasFactory<\Database\Factories\CreditNoteFactory> */
    use HasFactory;
    use SoftDeletes;
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
    protected $casts = [
        'issue_date' => 'date',
        'total_refund_amount' => 'decimal:2',
    ];
    public function invoice(): BelongsTo {
        return $this->belongsTo(Invoice::class);
    }

    public function client(): BelongsTo {
        return $this->belongsTo(Client::class);
    }

    public function items(): HasMany {
        return $this->hasMany(CreditNoteItem::class);
    }

    public function getReasonAttribute() {
        return app()->isLocale('ar') ? $this->reason_ar : $this->reason_en;
    }
}
