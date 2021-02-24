<?php

namespace App\Models\Legacy;

use Illuminate\Foundation\Auth\User as Authenticatable;

class LegacyAuthenticatable extends Authenticatable
{
    protected $connection = 'legacy';
}
