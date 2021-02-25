<?php

namespace App\Models\Legacy;

/**
 * Class Suffix
 *
 * @property int $SuffixID
 * @property string|null $Suffix
 * @method static \Illuminate\Database\Eloquent\Builder|LegacySuffix newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacySuffix newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacySuffix query()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacySuffix whereSuffix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacySuffix whereSuffixID($value)
 * @mixin \Eloquent
 */
class LegacySuffix extends LegacyModel
{
    protected $table = 'tblSuffixes';

    public $timestamps = false;

    protected $fillable = [
        'SuffixID',
        'Suffix'
    ];

    protected $guarded = [];


}
