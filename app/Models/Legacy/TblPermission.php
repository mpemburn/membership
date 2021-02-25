<?php

namespace App\Models\Legacy;

/**
 * Class TblPermission
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TblPermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblPermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblPermission query()
 * @mixin \Eloquent
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
