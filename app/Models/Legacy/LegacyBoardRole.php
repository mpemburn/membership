<?php

namespace App\Models\Legacy;

/**
 * Class BoardRole
 */
class LegacyBoardRole extends LegacyModel
{
    protected $table = 'tblBoardRoles';

    protected $primaryKey = 'RoleID';

	public $timestamps = false;

    protected $fillable = [
        'BoardRole'
    ];

    protected $guarded = [];


}
