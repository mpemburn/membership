<?php

namespace App\Models\Legacy;

/**
 * Class TblTask
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TblTask newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblTask newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblTask query()
 * @mixin \Eloquent
 * @property int $TaskID
 * @property string $Task
 * @property string $Description
 * @method static \Illuminate\Database\Eloquent\Builder|TblTask whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblTask whereTask($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblTask whereTaskID($value)
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
