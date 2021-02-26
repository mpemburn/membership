<?php

namespace App\Models\Legacy;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Legacy\LegacyModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyModel query()
 * @mixin \Eloquent
 */
class LegacyModel extends AbstractEloquentModel
{
    protected $connection = 'legacy';
}
