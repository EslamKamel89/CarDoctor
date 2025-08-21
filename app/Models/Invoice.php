<?php

namespace App\Models;

use App\Observers\InvoiceObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @property int $id
 * @property int|null $client_id
 * @property int|null $client_vehicle_id
 * @property int|null $user_id
 * @property string $invoice_number
 * @property string $date
 * @property string $status
 * @property string $calculated_total
 * @property string $actual_paid_amount
 * @property string $payment_method
 * @property string|null $labor_info
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\InvoiceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereActualPaidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereCalculatedTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereClientVehicleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereLaborInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereUserId($value)
 * @property numeric $actual_total
 * @property-read \App\Models\Client|null $client
 * @property-read \App\Models\ClientVehicle|null $clientVehicle
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CreditNote> $creditNotes
 * @property-read int|null $credit_notes_count
 * @property-read array $formatted_labor_info
 * @property-read bool $is_debt
 * @property-read bool $is_draft
 * @property-read bool $is_paid
 * @property-read bool $is_partially_paid
 * @property-read float $remaining_amount
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InvoiceItem> $items
 * @property-read int|null $items_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereActualTotal($value)
 * @property-read \App\Models\Debt|null $debt
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice withoutTrashed()
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Invoice whereDeletedAt($value)
 * @mixin \Eloquent
 */
#[ObservedBy(InvoiceObserver::class)]

class Invoice extends Model {
    /** @use HasFactory<\Database\Factories\InvoiceFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'client_id',
        'client_vehicle_id',
        'user_id',
        'invoice_number',
        'date',
        'status',
        'calculated_total',
        'actual_paid_amount',
        'payment_method',
        'labor_info',
        'notes',
    ];
    protected $casts = [
        'date' => 'date',
        'calculated_total' => 'decimal:2',
        'actual_total' => 'decimal:2',
        'actual_paid_amount' => 'decimal:2',
        'labor_info' => 'array',
    ];
    public function client(): BelongsTo {
        return $this->belongsTo(Client::class);
    }

    public function clientVehicle(): BelongsTo {
        return $this->belongsTo(ClientVehicle::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany {
        return $this->hasMany(InvoiceItem::class);
    }

    public function creditNotes(): HasMany {
        return $this->hasMany(CreditNote::class);
    }
    public function getIsDebtAttribute(): bool {
        return $this->status === 'debt';
    }
    public function getIsPaidAttribute(): bool {
        return $this->status === 'paid';
    }

    public function getIsDraftAttribute(): bool {
        return $this->status === 'draft';
    }

    public function getRemainingAmountAttribute(): float {
        return $this->actual_total - $this->actual_paid_amount;
    }

    public function getFormattedLaborInfoAttribute(): array {
        return collect($this->labor_info ?? [])->map(function ($item) {
            return [
                'name' => app()->isLocale('ar') ? $item['name_ar'] : $item['name_en'],
                'fee' => $item['fee'],
            ];
        })->all();
    }
    public function getIsPartiallyPaidAttribute(): bool {
        return $this->status === 'debt' && $this->actual_paid_amount > 0;
    }
    public function debt(): HasOne {
        return $this->hasOne(Debt::class);
    }
}
