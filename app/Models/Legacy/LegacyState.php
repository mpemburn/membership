<?php

namespace App\Models\Legacy;

/**
 * Class State
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
