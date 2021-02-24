<?php

namespace App\Models\Legacy;

/**
 * Class GuildMember
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
