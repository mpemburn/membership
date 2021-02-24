<?php

namespace App\Models\Legacy;

/**
 * Class TblTask
 */
class TblTask extends LegacyModel
{
    protected $table = 'tblTasks';

    protected $primaryKey = 'TaskID';

	public $timestamps = false;

    protected $fillable = [
        'Task',
        'Description'
    ];

    protected $guarded = [];


}
