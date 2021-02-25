<?php

namespace App\Models\Legacy;

/**
 * Class TblPermission
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TblPermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblPermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblPermission query()
 * @mixin \Eloquent
 * @property int $PermissionID
 * @property string $Task
 * @property string|null $Realm
 * @property string|null $GroupName
 * @property string|null $UserLogon
 * @property int $Create_rights
 * @property int $Read_rights
 * @property int $Update_rights
 * @property int $Delete_rights
 * @property int $ViewMenu
 * @method static \Illuminate\Database\Eloquent\Builder|TblPermission whereCreateRights($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblPermission whereDeleteRights($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblPermission whereGroupName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblPermission wherePermissionID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblPermission whereReadRights($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblPermission whereRealm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblPermission whereTask($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblPermission whereUpdateRights($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblPermission whereUserLogon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblPermission whereViewMenu($value)
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
