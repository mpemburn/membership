<?php

namespace App\Models\Legacy;

/**
 * Class Degree
 *
 * @property int $Degree
 * @property string $Degree_Name
 * @property string $Description
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyDegree newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyDegree newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyDegree query()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyDegree whereDegree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyDegree whereDegreeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyDegree whereDescription($value)
 * @mixin \Eloquent
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
