<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolesService
{
    public const USER_NOT_FOUND_ERROR = 'This user was not found in the system';
    public const GET_ASSIGNED_PERMISSIONS_ENDPOINT = '/api/user_roles/assigned';

    protected ?string $errorMessage = null;
    protected ValidationService $validator;

    public function __construct(ValidationService $validationService)
    {
        $this->validator = $validationService;
    }

    public function addOrRevokeRoles(Request $request, User $user): Collection
    {
        $fromEditor = collect($request->get('roles'));

        $grantedRoles = collect();

        if ($fromEditor->isNotEmpty()) {
            $grantedRoles = $fromEditor->map(static function ($role) use ($user) {
                if ($role['checked']) {
                    $user->assignRole($role['name']);

                    return ['name' => $role['name']];
                }
                $user->removeRole($role['name']);

                return null;
            })->filter();
        }

        return $grantedRoles;
    }

    public function addOrRevokePermissions(Request $request, User $user): Collection
    {
        $fromEditor = collect($request->get('permissions'));

        $grantedPermissions = collect();

        if ($fromEditor->isNotEmpty()) {
            $grantedPermissions = $fromEditor->map(static function ($permission) use ($user) {
                if ($permission['checked']) {
                    $user->givePermissionTo($permission['name']);

                    return ['name' => $permission['name']];
                }
                $user->revokePermissionTo($permission['name']);

                return null;
            })->filter();
        }

        return $grantedPermissions;
    }

    protected function hasError(): bool
    {
        return ! empty($this->errorMessage);
    }

    public function isCurrentUserAdmin(): bool
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);

        return $user->hasRole('Administrator') ? true : false;
    }

    public function getPermissionsAssignedToRole(Request $request): JsonResponse
    {
        $permissions = [];

        if ($this->validator->handle($request, [
            'role_name' => ['required']
        ])) {
            $roleName = $request->get('role_name');
            $role = Role::findByName($roleName, 'web');

            $permissions = $role->getAllPermissions()->map(static function (Permission $permission) {
                return $permission->name;
            })->toArray();
        }

        if ($this->validator->hasError()) {
            return response()->json(['error' => $this->validator->getMessage()], 400);
        }

        return response()->json(['success' => true, 'permissions' => $permissions]);
    }

    public function getUserRoleAssignedPermissions(Collection $userRoles, Collection $userPermissions): Collection
    {
        $permissions = collect();

        $userRoles->each(function (Role $role) use (&$permissions) {
            $rolePermissions = collect($role->getAllPermissions()->map(static function (Permission $permission) {
                return $permission;
            }));

            $permissions = $permissions->merge($rolePermissions);
        });

        return $permissions->filter(static function ($permission) use ($userPermissions) {
            $name = $permission->name;
            $contains = $userPermissions->contains(static function ($value, $key) use ($name) {
                return $value->name === $name;
            });

            return ! $contains;
        });
    }

    protected function getCurrentUserRoles(User $user): Collection
    {
        return $user->roles()->pluck('name');
    }

}
