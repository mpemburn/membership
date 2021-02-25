<?php

namespace App\Models\Legacy;

/**
 * Class AuditLog
 *
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuditLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuditLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuditLog query()
 * @mixin \Eloquent
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
