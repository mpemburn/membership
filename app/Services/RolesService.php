<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesService
{
    public const NO_ROLE_NAME_PROVIDED = 'No role name provided.';

    protected ValidationService $validator;

    public function __construct(ValidationService $validationService)
    {
        $this->validator = $validationService;
    }

    public function getPermissionsForRole(Request $request): JsonResponse
    {
        $permissions = [];
        $roleName = $request->get('role_name');
        if ($roleName) {
            $role = Role::findByName($roleName, 'web');
            $role->getAllPermissions()->each(static function (Permission $permission) use (&$permissions) {
                $permissions[] = $permission->name;
            });
        } else {
            return response()->json(['error' => self::NO_ROLE_NAME_PROVIDED], 400);
        }

        return response()->json(['success' => true, 'permissions' => $permissions]);
    }

    public function addOrRevokePermissions(Role $role, Request $request): JsonResponse
    {
        $fromEditor = collect($request->get('role_permission'));

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
