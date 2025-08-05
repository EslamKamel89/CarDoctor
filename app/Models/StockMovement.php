<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @method static \Database\Factories\StockMovementFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StockMovement withoutTrashed()
 * @mixin \Eloquent
 */
class StockMovement extends Model {
    /** @use HasFactory<\Database\Factories\StockMovementFactory> */
    use HasFactory;
    use SoftDeletes;
}
