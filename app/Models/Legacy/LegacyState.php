<?php

namespace App\Models\Legacy;

/**
 * Class State
 *
 * @property int $StateID
 * @property string|null $Abbrev
 * @property string|null $State
 * @property int|null $Local
 * @property string|null $Country
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyState newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyState newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyState query()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyState whereAbbrev($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyState whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyState whereLocal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyState whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyState whereStateID($value)
 * @mixin \Eloquent
 */
class LegacyState extends LegacyModel
{
    protected $table = 'tblStates';

    public $timestamps = false;

    protected $fillable = [
        'StateID',
        'Abbrev',
        'State',
        'Local',
        'Country'
    ];

    protected $guarded = [];


}
