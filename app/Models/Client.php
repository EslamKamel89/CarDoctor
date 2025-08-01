<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string|null $name_ar
 * @property string|null $name_en
 * @property string|null $mobile
 * @property string|null $email
 * @property string|null $address_ar
 * @property string|null $address_en
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ClientFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereAddressAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereAddressEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClientVehicle> $vehicles
 * @property-read int|null $vehicles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CreditNote> $creditNotes
 * @property-read int|null $credit_notes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Debt> $debts
 * @property-read int|null $debts_count
 * @property-read mixed $address
 * @property-read mixed $name
 * @property-read float $open_debts_amount
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Invoice> $invoices
 * @property-read int|null $invoices_count
 * @mixin \Eloquent
 */
class Client extends Model {
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'mobile',
        'email',
        'address_ar',
        'address_en',
        'notes',
    ];
    public function vehicles(): HasMany {
        return $this->hasMany(ClientVehicle::class, 'client_id');
    }
    public function invoices(): HasMany {
        return $this->hasMany(Invoice::class);
    }
    public function creditNotes(): HasMany {
        return $this->hasMany(CreditNote::class, 'client_id');
    }
    public function getNameAttribute() {
        return app()->isLocale('ar') ? $this->name_ar : $this->name_en;
    }
    public function getAddressAttribute() {
        return app()->isLocale('ar') ? $this->address_ar : $this->address_en;
    }

    public function debts(): HasMany {
        return $this->hasMany(Debt::class);
    }

    public function getOpenDebtsAmountAttribute(): float {
        return $this->debts()->where('is_settled', false)->sum('remaining_amount');
    }
}
