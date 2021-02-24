<?php

namespace App\Models\Legacy;

/**
 * Class TblGroupMembership
 */
class TblGroupMembership extends LegacyModel
{
    protected $table = 'tblGroupMembership';

    protected $primaryKey = 'GroupMembershipID';

	public $timestamps = false;

    protected $fillable = [
        'GroupName',
        'UserName'
    ];

    protected $guarded = [];


}
