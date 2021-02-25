<?php

namespace App\Models\Legacy;

/**
 * Class AuditLog
 *
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuditLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuditLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuditLog query()
 * @mixin \Eloquent
 * @property int $AuditID
 * @property string|null $ChangeDate
 * @property string|null $TableName
 * @property string|null $OldTableName
 * @property string|null $KeyField
 * @property string|null $KeyValue
 * @property string|null $OldKeyField
 * @property string|null $OldKeyValue
 * @property string|null $SubKeyField
 * @property string|null $SubKeyValue
 * @property string|null $FieldName
 * @property string|null $FieldLabel
 * @property string|null $ChangeFrom
 * @property string|null $ChangeTo
 * @property string|null $UserID
 * @property string|null $Application
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuditLog whereApplication($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuditLog whereAuditID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuditLog whereChangeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuditLog whereChangeFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuditLog whereChangeTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuditLog whereFieldLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuditLog whereFieldName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuditLog whereKeyField($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuditLog whereKeyValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuditLog whereOldKeyField($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuditLog whereOldKeyValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuditLog whereOldTableName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuditLog whereSubKeyField($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuditLog whereSubKeyValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuditLog whereTableName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuditLog whereUserID($value)
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
