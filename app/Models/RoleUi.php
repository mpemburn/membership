<?php

namespace App\Models;

use App\Interfaces\UiInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role;

/**
 * App\Models\RoleUi
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUi query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUi whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUi whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUi whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RoleUi extends Role implements UiInterface
{
    use HasFactory;
}
