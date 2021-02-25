<?php

namespace App\Models\Legacy;

/**
 * Class TblEmailExtension
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TblEmailExtension newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblEmailExtension newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblEmailExtension query()
 * @mixin \Eloquent
 * @property string $Extension
 * @property string $Description
 * @property string $Type
 * @method static \Illuminate\Database\Eloquent\Builder|TblEmailExtension whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblEmailExtension whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblEmailExtension whereType($value)
 */
class TblEmailExtension extends LegacyModel
{
    protected $table = 'tblEmailExtensions';

    public $timestamps = false;

    protected $fillable = [
        'Extension',
        'Description',
        'Type'
    ];

    protected $guarded = [];


}
