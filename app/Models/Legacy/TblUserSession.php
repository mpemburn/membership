<?php

namespace App\Models\Legacy;

/**
 * Class TblUserSession
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TblUserSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblUserSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblUserSession query()
 * @mixin \Eloquent
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
