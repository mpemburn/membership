<?php

namespace App\Models\Legacy;

/**
 * Class Coven
 *
 * @property string $Coven
 * @property string|null $CovenFullName
 * @property string|null $Wheel
 * @property string $Element
 * @property string|null $Tool
 * @property string $InceptionDate
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyCoven newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyCoven newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyCoven query()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyCoven whereCoven($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyCoven whereCovenFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyCoven whereElement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyCoven whereInceptionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyCoven whereTool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyCoven whereWheel($value)
 * @mixin \Eloquent
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
