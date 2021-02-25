<?php

namespace App\Models\Legacy;

/**
 * Class TblMenuContext
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenuContext newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenuContext newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenuContext query()
 * @mixin \Eloquent
 * @property int $MenuContextID
 * @property int|null $MenuID
 * @property string|null $MenuContext
 * @property string|null $AvailableTo
 * @property string|null $Task
 * @property int|null $Precedence
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenuContext whereAvailableTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenuContext whereMenuContext($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenuContext whereMenuContextID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenuContext whereMenuID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenuContext wherePrecedence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMenuContext whereTask($value)
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
