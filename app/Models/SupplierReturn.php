<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 * @mixin \Eloquent
 */
class SupplierReturn extends Model
{
    /** @use HasFactory<\Database\Factories\SupplierReturnFactory> */
    use HasFactory;
}
