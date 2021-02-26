<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AddressType
 *
 * @property int $id
 * @property string $type
 * @method static \Illuminate\Database\Eloquent\Builder|AddressType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddressType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddressType query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddressType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddressType whereType($value)
 * @mixin \Eloquent
 */
class AddressType extends AbstractEloquentModel
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'type'
    ];
}
