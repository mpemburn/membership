<?php

namespace App\Models\Legacy;

/**
 * Class Degree
 */
class LegacyDegree extends LegacyModel
{
    protected $table = 'tblDegrees';

    protected $primaryKey = 'Degree';

	public $timestamps = false;

    protected $fillable = [
        'Degree_Name',
        'Description'
    ];

    protected $guarded = [];


}
