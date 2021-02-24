<?php

namespace App\Models\Legacy;

/**
 * Class TblEmailExtension
 */
class TblEmailExtension extends LegacyModel
{
    protected $table = 'tblEmailExtensions';

    public $timestamps = false;

    protected $fillable = [
        'Extension',
        'Description',
        'Type'
    ];

    protected $guarded = [];


}
