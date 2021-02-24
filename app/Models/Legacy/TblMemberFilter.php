<?php

namespace App\Models\Legacy;

/**
 * Class TblMemberFilter
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
