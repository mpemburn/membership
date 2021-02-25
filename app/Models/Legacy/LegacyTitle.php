<?php

namespace App\Models\Legacy;

/**
 * Class Title
 *
 * @property int $TitleID
 * @property string|null $Title
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyTitle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyTitle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyTitle query()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyTitle whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyTitle whereTitleID($value)
 * @mixin \Eloquent
 */
class LegacyTitle extends LegacyModel
{
    protected $table = 'tblTitles';

    public $timestamps = false;

    protected $fillable = [
        'TitleID',
        'Title'
    ];

    protected $guarded = [];


}
