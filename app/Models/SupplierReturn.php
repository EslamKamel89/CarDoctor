<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\SupplierReturnFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereUpdatedAt($value)
 * @property int $purchase_id
 * @property int|null $user_id
 * @property string $return_number
 * @property \Illuminate\Support\Carbon $return_date
 * @property string|null $reason_ar
 * @property string|null $reason_en
 * @property numeric $total_refund_amount
 * @property string|null $payment_refund_method
 * @property bool $bulk_discount_lost
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read string $reason
 * @property-read \App\Models\Purchase $purchase
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereBulkDiscountLost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn wherePaymentRefundMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn wherePurchaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereReasonAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereReasonEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereReturnDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereReturnNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereTotalRefundAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierReturn withoutTrashed()
 * @mixin \Eloquent
 */
class SupplierReturn extends Model {
    /** @use HasFactory<\Database\Factories\SupplierReturnFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'purchase_id',
        'user_id',
        'return_number',
        'return_date',
        'reason_ar',
        'reason_en',
        'total_refund_amount',
        'payment_refund_method',
        'bulk_discount_lost',
        'notes',
    ];
    protected $casts = [
        'return_date' => 'date',
        'total_refund_amount' => 'decimal:2',
        'bulk_discount_lost' => 'boolean',
    ];

    protected static function boot() {
        parent::boot();
        static::creating(function ($supplierReturn) {
            $supplierReturn->return_number = 'SR-' . now()->format('Ymd') . '-' . rand(1000, 9999);
        });
    }

    public function purchase(): BelongsTo {
        return $this->belongsTo(Purchase::class);
    }
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function items(): HasMany {
        return $this->hasMany(SupplierReturnItem::class);
    }
    public function getReasonAttribute(): string {
        return app()->isLocale('ar') ? $this->reason_ar : $this->reason_en;
    }
}
