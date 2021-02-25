<?php

namespace App\Models\Legacy;

/**
 * Class TblUserSession
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TblUserSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblUserSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblUserSession query()
 * @mixin \Eloquent
 * @property int $SessionID
 * @property int $UserID
 * @property string $UserLogon
 * @property string $SessionDateTime
 * @property string $RemoteAddress
 * @property string $HostName
 * @property string|null $Browser
 * @method static \Illuminate\Database\Eloquent\Builder|TblUserSession whereBrowser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUserSession whereHostName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUserSession whereRemoteAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUserSession whereSessionDateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUserSession whereSessionID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUserSession whereUserID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUserSession whereUserLogon($value)
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
