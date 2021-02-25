<?php

namespace App\Models\Legacy;

/**
 * Class LeadershipRole
 *
 * @property int $RoleID
 * @property string $Role
 * @property string $Description
 * @property string|null $GroupName
 * @property string $LeadershipLevel
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyLeadershipRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyLeadershipRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyLeadershipRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyLeadershipRole whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyLeadershipRole whereGroupName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyLeadershipRole whereLeadershipLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyLeadershipRole whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyLeadershipRole whereRoleID($value)
 * @mixin \Eloquent
 */
class LegacyLeadershipRole extends LegacyModel
{
    protected $table = 'tblLeadershipRoles';

    protected $primaryKey = 'RoleID';

	public $timestamps = false;

    protected $fillable = [
        'Role',
        'Description',
        'GroupName',
        'LeadershipLevel'
    ];

    protected $guarded = [];


}
