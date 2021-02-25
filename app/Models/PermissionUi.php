<?php

namespace App\Models;

use App\Interfaces\UiInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission;

/**
 * App\Models\PermissionUi
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionUi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionUi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionUi query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionUi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionUi whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionUi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionUi whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PermissionUi whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PermissionUi extends Permission implements UiInterface
{
    use HasFactory;
}
