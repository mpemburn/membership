<?php

namespace App\Models\Legacy;

/**
 * Class TblPermission
 */
class TblPermission extends LegacyModel
{
    protected $table = 'tblPermissions';

    protected $primaryKey = 'PermissionID';

	public $timestamps = false;

    protected $fillable = [
        'Task',
        'Realm',
        'GroupName',
        'UserLogon',
        'Create_rights',
        'Read_rights',
        'Update_rights',
        'Delete_rights',
        'ViewMenu'
    ];

    protected $guarded = [];


}
