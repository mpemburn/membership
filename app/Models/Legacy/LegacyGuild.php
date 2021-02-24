<?php

namespace App\Models\Legacy;

/**
 * Class Guild
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
