<?php

namespace App\Models\Legacy;

/**
 * Class TblMemberFilter
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TblMemberFilter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblMemberFilter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblMemberFilter query()
 * @mixin \Eloquent
 * @property int $FilterID
 * @property string|null $Filter
 * @property string|null $FilterIDSQL
 * @property string|null $Description
 * @property int $INExpression
 * @property int $UseConstant
 * @property int $Override
 * @property int|null $OverrideDefaultSort
 * @method static \Illuminate\Database\Eloquent\Builder|TblMemberFilter whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMemberFilter whereFilter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMemberFilter whereFilterID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMemberFilter whereFilterIDSQL($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMemberFilter whereINExpression($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMemberFilter whereOverride($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMemberFilter whereOverrideDefaultSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblMemberFilter whereUseConstant($value)
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
