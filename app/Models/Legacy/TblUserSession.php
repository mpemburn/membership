<?php

namespace App\Models\Legacy;

/**
 * Class TblUserSession
 */
class TblUserSession extends LegacyModel
{
    protected $table = 'tblUserSession';

    protected $primaryKey = 'SessionID';

	public $timestamps = false;

    protected $fillable = [
        'UserID',
        'UserLogon',
        'SessionDateTime',
        'RemoteAddress',
        'HostName',
        'Browser'
    ];

    protected $guarded = [];


}
