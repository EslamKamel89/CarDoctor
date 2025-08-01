<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $credit_note_id
 * @property int $invoice_item_id
 * @property int $quantity
 * @property string $refunded_amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CreditNoteItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem whereCreditNoteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem whereInvoiceItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem whereRefundedAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CreditNoteItem whereUpdatedAt($value)
 * @property-read \App\Models\CreditNote $creditNote
 * @property-read mixed $product_name
 * @property-read \App\Models\InvoiceItem $invoiceItem
 * @mixin \Eloquent
 */
class CreditNoteItem extends Model {
    /** @use HasFactory<\Database\Factories\CreditNoteItemFactory> */
    use HasFactory;
    protected $fillable = [
        'credit_note_id',
        'invoice_item_id',
        'quantity',
        'refunded_amount',
    ];
    protected $casts = [
        'quantity' => 'integer',
        'refunded_amount' => 'decimal:2',
    ];

    public function creditNote(): BelongsTo {
        return $this->belongsTo(CreditNote::class);
    }

    public function invoiceItem(): BelongsTo {
        return $this->belongsTo(InvoiceItem::class);
    }

    public function getProductNameAttribute() {
        return app()->isLocale('ar')
            ? $this->invoiceItem->product->name_ar
            : $this->invoiceItem->product->name_en;
    }
}
