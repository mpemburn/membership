<?php

namespace App\Models\Legacy;

/**
 * Class TblUserGroup
 *
 * @property int $GroupID
 * @property string|null $GroupName
 * @property string|null $Manager
 * @method static \Illuminate\Database\Eloquent\Builder|TblUserGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblUserGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblUserGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|TblUserGroup whereGroupID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUserGroup whereGroupName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUserGroup whereManager($value)
 * @mixin \Eloquent
 */
class TblUserGroup extends LegacyModel
{
    protected $table = 'tblUserGroups';

    protected $primaryKey = 'GroupID';

	public $timestamps = false;

    protected $fillable = [
        'GroupName',
        'Manager'
    ];

    protected $guarded = [];


}
