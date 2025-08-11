<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string|null $name_ar
 * @property string|null $name_en
 * @property string|null $contact_person_name_ar
 * @property string|null $contact_person_name_en
 * @property string|null $mobile
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $tax_id
 * @property string|null $address_ar
 * @property string|null $address_en
 * @property string|null $payment_terms
 * @property numeric|null $credit_limit
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $contact_person_name
 * @property-read string $name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Purchase> $purchases
 * @property-read int|null $purchases_count
 * @method static \Database\Factories\SupplierFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereAddressAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereAddressEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereContactPersonNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereContactPersonNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereCreditLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier wherePaymentTerms($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereTaxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Supplier withoutTrashed()
 * @mixin \Eloquent
 */
class Supplier extends Model {
    /** @use HasFactory<\Database\Factories\SupplierFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name_ar',
        'name_en',
        'contact_person_name_ar',
        'contact_person_name_en',
        'mobile',
        'phone',
        'email',
        'tax_id',
        'address_ar',
        'address_en',
        'payment_terms',
        'credit_limit',
        'notes',
    ];
    protected $casts = [
        'credit_limit' => 'decimal:2',
    ];
    public function getNameAttribute(): string {
        return app()->isLocale('ar') ? $this->name_ar : $this->name_en;
    }
    public function getContactPersonNameAttribute(): string {
        return app()->isLocale('ar')  ?
            $this->contact_person_name_ar
            : $this->contact_person_name_en;
    }
    public function purchases(): HasMany {
        return $this->hasMany(Purchase::class);
    }
}
