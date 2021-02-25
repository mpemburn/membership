<?php

namespace App\Models\Legacy;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\Legacy\LegacyAuthenticatable
 *
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuthenticatable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuthenticatable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyAuthenticatable query()
 * @mixin \Eloquent
 */
class LegacyAuthenticatable extends Authenticatable
{
    protected $connection = 'legacy';
}
