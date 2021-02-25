<?php

namespace App\Models\Legacy;

/**
 * Class TblEmailExtension
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TblEmailExtension newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblEmailExtension newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblEmailExtension query()
 * @mixin \Eloquent
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
