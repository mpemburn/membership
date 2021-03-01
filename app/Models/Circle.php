<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Circle
 *
 * @property string|null $circle
 * @method static \Illuminate\Database\Eloquent\Builder|Circle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Circle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Circle query()
 * @method static \Illuminate\Database\Eloquent\Builder|Circle whereCircle($value)
 * @mixin \Eloquent
 */
class Circle extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'circle',
    ];
}
