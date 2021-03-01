<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Leader
 *
 * @property int $id
 * @property int $member_id
 * @property string $role_name
 * @property string|null $leadership_date
 * @property string|null $circle
 * @method static \Illuminate\Database\Eloquent\Builder|Leader newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Leader newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Leader query()
 * @method static \Illuminate\Database\Eloquent\Builder|Leader whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leader whereLeadershipDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leader whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leader whereRoleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Leader whereWheel($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Leader whereCircle($value)
 */
class Leader extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'member_id',
        'role_name',
        'circle',
        'leadership_date',
    ];

}
