<?php

namespace App\Models\Legacy;

/**
 * Class TblMenuContext
 */
class TblMenuContext extends LegacyModel
{
    protected $table = 'tblMenuContext';

    protected $primaryKey = 'MenuContextID';

	public $timestamps = false;

    protected $fillable = [
        'MenuID',
        'MenuContext',
        'AvailableTo',
        'Task',
        'Precedence'
    ];

    protected $guarded = [];


}
