<?php

namespace App\Models\Legacy;

/**
 * Class TblMemberFilter
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TblMemberFilter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblMemberFilter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblMemberFilter query()
 * @mixin \Eloquent
 */
class TblMemberFilter extends LegacyModel
{
    protected $table = 'tblMemberFilters';

    protected $primaryKey = 'FilterID';

	public $timestamps = false;

    protected $fillable = [
        'Filter',
        'FilterIDSQL',
        'Description',
        'INExpression',
        'UseConstant',
        'Override',
        'OverrideDefaultSort'
    ];

    protected $guarded = [];


}
