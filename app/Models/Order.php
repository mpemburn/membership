<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property string $abbreviation
 * @property string $name
 * @property string|null $description
 * @property int|null $leader_member_id
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAbbreviation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereLeaderMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereName($value)
 * @mixin \Eloquent
 */
class Order extends AbstractEloquentModel
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'abbreviation',
        'name',
        'description',
        'leader_member_id',
    ];
}
