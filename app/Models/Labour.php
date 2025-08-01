<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string|null $name_ar
 * @property string|null $name_en
 * @property string|null $base_fee
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\LabourFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour whereBaseFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Labour whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Labour extends Model {
    /** @use HasFactory<\Database\Factories\LabourFactory> */
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'base_fee',
        'is_active',
    ];
    protected function casts(): array {
        return [
            'is_active' => 'boolean',
            'base_fee' => 'decimal:2',
        ];
    }
    public function getNameAttribute() {
        return app()->isLocale('ar') ? $this->name_ar : $this->name_en;
    }
}
