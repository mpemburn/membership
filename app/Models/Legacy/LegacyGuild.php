<?php

namespace App\Models\Legacy;

/**
 * Class Guild
 *
 * @property string $GuildID
 * @property string $GuildName
 * @property string $Description
 * @property int $LeaderMemberID
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyGuild newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyGuild newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyGuild query()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyGuild whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyGuild whereGuildID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyGuild whereGuildName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyGuild whereLeaderMemberID($value)
 * @mixin \Eloquent
 */
class LegacyGuild extends LegacyModel
{
    protected $table = 'tblGuilds';

    protected $primaryKey = 'GuildID';

	public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'GuildName',
        'Description',
        'LeaderMemberID',
    ];

    protected $guarded = [];

}
