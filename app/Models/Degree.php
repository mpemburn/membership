<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Degree
 *
 * @property int $id
 * @property string $degree
 * @property string|null $initiation_date
 * @method static \Illuminate\Database\Eloquent\Builder|Degree newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Degree newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Degree query()
 * @method static \Illuminate\Database\Eloquent\Builder|Degree whereDegree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Degree whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Degree whereInitiationDate($value)
 * @mixin \Eloquent
 */
class Degree extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'degree',
        'initiation_date'
    ];
}
