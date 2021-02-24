<?php

namespace App\Models\Legacy;

/**
 * Class Suffix
 */
class LegacySuffix extends LegacyModel
{
    protected $table = 'tblSuffixes';

    public $timestamps = false;

    protected $fillable = [
        'SuffixID',
        'Suffix'
    ];

    protected $guarded = [];


}
