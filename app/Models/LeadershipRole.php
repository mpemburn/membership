<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LeadershipRole
 *
 * @property int $id
 * @property string|null $role_name
 * @property string $abbreviation
 * @property string $group_name
 * @property string|null $level
 * @method static \Illuminate\Database\Eloquent\Builder|LeadershipRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LeadershipRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LeadershipRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|LeadershipRole whereAbbreviation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeadershipRole whereGroupName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeadershipRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeadershipRole whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LeadershipRole whereRoleName($value)
 * @mixin \Eloquent
 */
class LeadershipRole extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'abbreviation',
        'role_name',
        'group_name',
        'level'
    ];
}
