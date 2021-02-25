<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Wheel
 *
 * @property string|null $wheel
 * @method static \Illuminate\Database\Eloquent\Builder|Wheel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wheel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wheel query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wheel whereWheel($value)
 * @mixin \Eloquent
 */
class Wheel extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'wheel',
    ];
}
