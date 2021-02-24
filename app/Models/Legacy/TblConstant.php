<?php

namespace App\Models\Legacy;

/**
 * Class TblConstant
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
