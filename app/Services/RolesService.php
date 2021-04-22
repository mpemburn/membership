<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesService
{
    public const NO_ROLE_NAME_PROVIDED = 'No role name provided.';
    public const INVALID_ROLE_NAME_PROVIDED = 'The role name provided is invalid.';

    protected ValidationService $validator;

    public function __construct(ValidationService $validationService)
    {
        $this->validator = $validationService;
    }

    public function retrievePermissionsForRole(Request $request): JsonResponse
    {
        $roleName = $request->get('role_name');
        if ($roleName) {
            $permissions = $this->getPermissionsForRole($roleName);
            if ($permissions->isEmpty()) {
                return response()->json(['error' => self::INVALID_ROLE_NAME_PROVIDED . ': ' . $roleName], 400);
            }
        } else {
            return response()->json(['error' => self::NO_ROLE_NAME_PROVIDED], 400);
        }

        return response()->json(['success' => true, 'permissions' => $permissions]);
    }

    public function getPermissionsForRole(string $roleName): Collection
    {
        $permissions = collect();
        if ($roleName) {
            $role = Role::findByName($roleName, 'web');
            $permissions = $role->getAllPermissions()
                ->map(static function (Permission $permission) {
                return $permission->name;
            });
        }

        return $permissions;
    }

    public function addOrRevokePermissions(Role $role, Request $request): JsonResponse
    {
        $fromEditor = collect($request->get('role_permissions'));

        $grantedPermissions = collect();

        if ($fromEditor->isNotEmpty()) {
            $grantedPermissions = $fromEditor->map(static function ($permission) use ($role) {
                if ($permission['checked']) {
                    $role->givePermissionTo($permission['name']);

                    return ['name' => $permission['name']];
                }
                $role->revokePermissionTo($permission['name']);

                return null;
            })->filter();
        }

        return response()->json([
            'success' => true,
            'roleId' => $role->id,
            'permissions' => $grantedPermissions->toArray()
        ]);
    }

}
