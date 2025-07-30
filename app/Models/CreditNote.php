<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 * @mixin \Eloquent
 */
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
