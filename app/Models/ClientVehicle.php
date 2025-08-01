<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $client_id
 * @property int $car_model_id
 * @property string|null $plate_number
 * @property string|null $chasis_number
 * @property string|null $color
 * @property int|null $manufacturing_year
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ClientVehicleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle whereCarModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle whereChasisNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle whereManufacturingYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle wherePlateNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClientVehicle whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ClientVehicle extends Model {
    /** @use HasFactory<\Database\Factories\ClientVehicleFactory> */
    use HasFactory;
    protected $fillable = [
        'client_id',
        'car_model_id',
        'plate_number',
        'chasis_number',
        'color',
        'manufacturing_year',
        'notes',
    ];
    public function client(): BelongsTo {
        return $this->belongsTo(Client::class);
    }

    public function carModel(): BelongsTo {
        return $this->belongsTo(CarModel::class);
    }

    public function invoices(): HasMany {
        return $this->hasMany(Invoice::class);
    }

    public function getDisplayNameAttribute(): string {
        return $this->carModel?->name . ' (' . $this->plate_number . ')';
    }
}
