<?php

namespace App\Models\Legacy;

/**
 * Class BoardRole
 *
 * @property int $RoleID
 * @property string $BoardRole
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyBoardRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyBoardRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyBoardRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyBoardRole whereBoardRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyBoardRole whereRoleID($value)
 * @mixin \Eloquent
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
