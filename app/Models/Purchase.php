<?php

namespace App\Models;

use App\Observers\PurchaseObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PurchaseFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchase query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchase whereUpdatedAt($value)
 * @property int $supplier_id
 * @property int|null $user_id
 * @property string $purchase_number
 * @property \Illuminate\Support\Carbon $purchase_date
 * @property numeric $total_amount
 * @property numeric $discount
 * @property numeric $final_amount
 * @property string|null $payment_method
 * @property string $status
 * @property string|null $notes
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PurchaseItem> $items
 * @property-read int|null $items_count
 * @property-read \App\Models\Supplier $supplier
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchase whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchase whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchase whereFinalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchase whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchase wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchase wherePurchaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchase wherePurchaseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchase whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchase whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchase whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Purchase whereUserId($value)
 * @mixin \Eloquent
 */
#[ObservedBy(PurchaseObserver::class)]

class Purchase extends Model {
    /** @use HasFactory<\Database\Factories\PurchaseFactory> */
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'user_id',
        'purchase_number',
        'purchase_date',
        'total_amount',
        'discount',
        'final_amount',
        'payment_method',
        'status',
        'notes',
    ];
    protected $casts = [
        'purchase_date' => 'date',
        'total_amount' => 'decimal:2',
        'discount' => 'decimal:2',
        'final_amount' => 'decimal:2',
    ];
    protected static function boot(): void {
        parent::boot();
        static::creating(function ($purchase) {
            $purchase->purchase_number = 'PO-' . now()->format('Ymd') . '-' . rand(1000, 9999);
        });
    }
    public function supplier(): BelongsTo {
        return $this->belongsTo(Supplier::class);
    }
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function items(): HasMany {
        return $this->hasMany(PurchaseItem::class);
    }
}
