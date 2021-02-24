<?php

namespace App\Models\Legacy;

/**
 * Class TblUserGroup
 */
class TblUserGroup extends LegacyModel
{
    protected $table = 'tblUserGroups';

    protected $primaryKey = 'GroupID';

	public $timestamps = false;

    protected $fillable = [
        'GroupName',
        'Manager'
    ];

    protected $guarded = [];


}
