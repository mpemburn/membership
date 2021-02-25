<?php

namespace App\Models\Legacy;

/**
 * Class GuildMember
 *
 * @property string $GuildID
 * @property int $MemberID
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyGuildMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyGuildMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyGuildMember query()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyGuildMember whereGuildID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyGuildMember whereMemberID($value)
 * @mixin \Eloquent
 */
class LegacyGuildMember extends LegacyModel
{
    protected $table = 'tblGuildMembers';

    public $timestamps = false;

    protected $fillable = [
        'GuildID',
        'MemberID',
    ];

    protected $guarded = [];

}
