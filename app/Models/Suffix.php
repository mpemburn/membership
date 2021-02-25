<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Suffix
 *
 * @property int $id
 * @property string $suffix
 * @method static \Illuminate\Database\Eloquent\Builder|Suffix newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Suffix newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Suffix query()
 * @method static \Illuminate\Database\Eloquent\Builder|Suffix whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Suffix whereSuffix($value)
 * @mixin \Eloquent
 */
class Suffix extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'suffix'
    ];
}
