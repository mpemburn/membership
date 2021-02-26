<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Prefix
 *
 * @property int $id
 * @property string $prefix
 * @method static \Illuminate\Database\Eloquent\Builder|Prefix newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prefix newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prefix query()
 * @method static \Illuminate\Database\Eloquent\Builder|Prefix whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prefix wherePrefix($value)
 * @mixin \Eloquent
 */
class Prefix extends AbstractEloquentModel
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'prefix'
    ];
}
