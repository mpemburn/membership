<?php

namespace App\Models\Legacy;

/**
 * Class LeadershipRole
 */
class LegacyCovenRoles extends LegacyModel
{
    protected $table = 'tblCovenRoles';

	public $timestamps = false;

    protected $fillable = [
        'Coven',
        'MemberID',
        'Role',
    ];

    protected $guarded = [];


}
