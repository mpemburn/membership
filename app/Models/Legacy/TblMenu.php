<?php

namespace App\Models\Legacy;

/**
 * Class TblMenu
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenu query()
 * @mixin \Eloquent
 * @property int $MenuID
 * @property string|null $MenuTitle
 * @property string|null $AppName
 * @property string|null $MenuCircuit
 * @property string|null $Param0
 * @property string|null $Param1
 * @property string|null $Param2
 * @property string|null $Param3
 * @property string|null $Param4
 * @property string|null $Task
 * @property string|null $ParentMenu
 * @property string|null $Submenu
 * @property string|null $Image
 * @property string|null $Target
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenu whereAppName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenu whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenu whereMenuCircuit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenu whereMenuID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenu whereMenuTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenu whereParam0($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenu whereParam1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenu whereParam2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenu whereParam3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenu whereParam4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenu whereParentMenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenu whereSubmenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenu whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenu whereTask($value)
 */
class TblMenu extends LegacyModel
{
    protected $table = 'tblMenu';

    protected $primaryKey = 'MenuID';

	public $timestamps = false;

    protected $fillable = [
        'MenuTitle',
        'AppName',
        'MenuCircuit',
        'Param0',
        'Param1',
        'Param2',
        'Param3',
        'Param4',
        'Task',
        'ParentMenu',
        'Submenu',
        'Image',
        'Target'
    ];

    protected $guarded = [];


}
