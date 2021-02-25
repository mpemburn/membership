<?php

namespace App\Models\Legacy;

/**
 * Class TblGroupMembership
 *
 * @property int $GroupMembershipID
 * @property string $GroupName
 * @property string $UserName
 * @method static \Illuminate\Database\Eloquent\Builder|TblGroupMembership newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblGroupMembership newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblGroupMembership query()
 * @method static \Illuminate\Database\Eloquent\Builder|TblGroupMembership whereGroupMembershipID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblGroupMembership whereGroupName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblGroupMembership whereUserName($value)
 * @mixin \Eloquent
 */
class TblGroupMembership extends LegacyModel
{
    protected $table = 'tblGroupMembership';

    protected $primaryKey = 'GroupMembershipID';

	public $timestamps = false;

    protected $fillable = [
        'GroupName',
        'UserName'
    ];

    protected $guarded = [];


}
