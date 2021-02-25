<?php

namespace App\Models\Legacy;

/**
 * Class TblZipCode
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TblZipCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblZipCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblZipCode query()
 * @mixin \Eloquent
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
