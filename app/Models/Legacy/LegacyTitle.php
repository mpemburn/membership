<?php

namespace App\Models\Legacy;

/**
 * Class Title
 */
class LegacyTitle extends LegacyModel
{
    protected $table = 'tblTitles';

    public $timestamps = false;

    protected $fillable = [
        'TitleID',
        'Title'
    ];

    protected $guarded = [];


}
