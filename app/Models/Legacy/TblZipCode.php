<?php

namespace App\Models\Legacy;

/**
 * Class TblZipCode
 */
class TblZipCode extends LegacyModel
{
    protected $table = 'tblZipCodes';

    public $timestamps = false;

    protected $fillable = [
        'Zip',
        'City',
        'State',
        'Lat',
        'Lon',
        'TimeZone',
        'Unit',
        'Country'
    ];

    protected $guarded = [];


}
