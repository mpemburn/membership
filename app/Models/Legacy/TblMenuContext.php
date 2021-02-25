<?php

namespace App\Models\Legacy;

/**
 * Class TblMenuContext
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenuContext newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenuContext newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenuContext query()
 * @mixin \Eloquent
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
