<?php

namespace App\Models\Legacy;

/**
 * Class TblMenu
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
