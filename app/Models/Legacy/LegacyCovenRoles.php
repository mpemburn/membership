<?php

namespace App\Models\Legacy;

/**
 * Class LeadershipRole
 *
 * @property string $Coven
 * @property int $MemberID
 * @property string $Role
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyCovenRoles newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyCovenRoles newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyCovenRoles query()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyCovenRoles whereCoven($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyCovenRoles whereMemberID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyCovenRoles whereRole($value)
 * @mixin \Eloquent
 */
class LegacyCovenRoles extends LegacyModel
{
    protected $table = 'tblCovenRoles';

	public $timestamps = false;

    protected $fillable = [
        'Coven',
        'MemberID',
        'Role',
    ];

    protected $guarded = [];


}
