<?php

namespace App\Models\Legacy;

/**
 * Class TblZipCode
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TblZipCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblZipCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblZipCode query()
 * @mixin \Eloquent
 * @property string $Zip
 * @property string $City
 * @property string $State
 * @property string $Lat
 * @property string $Lon
 * @property int $TimeZone
 * @property int $Unit
 * @property string $Country
 * @method static \Illuminate\Database\Eloquent\Builder|TblZipCode whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblZipCode whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblZipCode whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblZipCode whereLon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblZipCode whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblZipCode whereTimeZone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblZipCode whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblZipCode whereZip($value)
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
