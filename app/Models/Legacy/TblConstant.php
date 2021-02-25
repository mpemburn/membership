<?php

namespace App\Models\Legacy;

/**
 * Class TblConstant
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TblConstant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblConstant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblConstant query()
 * @mixin \Eloquent
 * @property int $ConstantID
 * @property string $Constant
 * @property string $ConstantValue
 * @property string $UpdatedDate
 * @property string $UpdatedBy
 * @method static \Illuminate\Database\Eloquent\Builder|TblConstant whereConstant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblConstant whereConstantID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblConstant whereConstantValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblConstant whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblConstant whereUpdatedDate($value)
 */
class TblConstant extends LegacyModel
{
    protected $table = 'tblConstants';

    protected $primaryKey = 'ConstantID';

	public $timestamps = false;

    protected $fillable = [
        'Constant',
        'ConstantValue',
        'UpdatedDate',
        'UpdatedBy'
    ];

    protected $guarded = [];


}
