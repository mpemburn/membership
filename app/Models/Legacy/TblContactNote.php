<?php

namespace App\Models\Legacy;

/**
 * Class TblContactNote
 *
 * @property int $NoteID
 * @property string|null $MemberID
 * @property string|null $PurchaserID
 * @property string|null $ContactDate
 * @property int|null $ReturnCall
 * @property string|null $ReturnCallDate
 * @property int|null $ReturnStatus
 * @property int|null $ForwardCall
 * @property string|null $NoteText
 * @property string|null $AttachmentPath
 * @property int|null $AgentRelated
 * @property string|null $UserID
 * @property string|null $AppCreatedBy
 * @property int $Deleted
 * @property string|null $DeletedBy
 * @property string|null $DeletedDate
 * @method static \Illuminate\Database\Eloquent\Builder|TblContactNote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblContactNote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblContactNote query()
 * @method static \Illuminate\Database\Eloquent\Builder|TblContactNote whereAgentRelated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblContactNote whereAppCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblContactNote whereAttachmentPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblContactNote whereContactDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblContactNote whereDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblContactNote whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblContactNote whereDeletedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblContactNote whereForwardCall($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblContactNote whereMemberID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblContactNote whereNoteID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblContactNote whereNoteText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblContactNote wherePurchaserID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblContactNote whereReturnCall($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblContactNote whereReturnCallDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblContactNote whereReturnStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblContactNote whereUserID($value)
 * @mixin \Eloquent
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
