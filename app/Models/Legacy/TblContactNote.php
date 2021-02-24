<?php

namespace App\Models\Legacy;

/**
 * Class TblContactNote
 */
class TblContactNote extends LegacyModel
{
    protected $table = 'tblContactNotes';

    public $timestamps = false;

    protected $fillable = [
        'NoteID',
        'MemberID',
        'PurchaserID',
        'ContactDate',
        'ReturnCall',
        'ReturnCallDate',
        'ReturnStatus',
        'ForwardCall',
        'NoteText',
        'AttachmentPath',
        'AgentRelated',
        'UserID',
        'AppCreatedBy',
        'Deleted',
        'DeletedBy',
        'DeletedDate'
    ];

    protected $guarded = [];


}
