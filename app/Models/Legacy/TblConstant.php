<?php

namespace App\Models\Legacy;

/**
 * Class TblConstant
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TblConstant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblConstant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblConstant query()
 * @mixin \Eloquent
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
