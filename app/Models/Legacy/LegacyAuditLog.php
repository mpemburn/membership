<?php

namespace App\Models\Legacy;

/**
 * Class AuditLog
 */
class LegacyAuditLog extends LegacyModel
{
    protected $table = 'tblAuditLog';

    public $timestamps = false;

    protected $fillable = [
        'AuditID',
        'ChangeDate',
        'TableName',
        'OldTableName',
        'KeyField',
        'KeyValue',
        'OldKeyField',
        'OldKeyValue',
        'SubKeyField',
        'SubKeyValue',
        'FieldName',
        'FieldLabel',
        'ChangeFrom',
        'ChangeTo',
        'UserID',
        'Application'
    ];

    protected $guarded = [];


}
