<?php

namespace App\Models\Legacy;

/**
 * Class Coven
 */
class LegacyCoven extends LegacyModel
{
    protected $table = 'tblCovens';

    protected $primaryKey = 'Coven';

	public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'CovenFullName',
        'Wheel',
        'Element',
        'Tool'
    ];

    protected $guarded = [];


}
