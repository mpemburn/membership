<?php

namespace App\Models\Legacy;

/**
 * Class LeadershipRole
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
