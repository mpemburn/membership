<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Bonded
 *
 * @property int $id
 * @property int $coven_id
 * @property string $bonded_date
 * @property int $member_id
 * @method static \Illuminate\Database\Eloquent\Builder|Bonded newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bonded newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bonded query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bonded whereBondedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bonded whereCovenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bonded whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bonded whereMemberId($value)
 * @mixin \Eloquent
 */
class Bonded extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'member_id',
        'coven_id',
        'bonded_date',
    ];

}
