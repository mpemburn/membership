<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\State
 *
 * @property int $id
 * @property string $abbreviation
 * @property string|null $name
 * @property string|null $country
 * @property int|null $is_local
 * @method static \Illuminate\Database\Eloquent\Builder|State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State query()
 * @method static \Illuminate\Database\Eloquent\Builder|State whereAbbreviation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereIsLocal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereName($value)
 * @mixin \Eloquent
 */
class State extends AbstractEloquentModel
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'abbreviation',
        'name',
        'country',
        'is_local'
    ];

}
