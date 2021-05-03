<?php

namespace App\Http\Controllers;

use App\Models\RoleUi;
use App\Services\PermissionsAssociationService;
use App\Services\PermissionsCrudService;
use App\Services\RolesService;
use App\Services\ValidationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    protected PermissionsCrudService $crudService;
    protected RolesService $rolesService;
    protected ValidationService $validator;

    public function __construct(
        PermissionsCrudService $crudService,
        RolesService $rolesService,
        ValidationService $validationService
    )
    {
        $this->crudService = $crudService;
        $this->rolesService = $rolesService;
        $this->validator = $validationService;
    }

    public function index(Request $request): JsonResponse
    {
        $roles = Role::query()
            ->with('permissions')
            ->get();

        $protectedRoles = env('PROTECTED_ROLES');

        return response()->json([
            'success' => true,
            'roles' => $roles,
            'protectedRoles' => $protectedRoles ? explode(',', $protectedRoles) : []
        ]);
    }

    public function show(Request $request): JsonResponse
    {
        $role = Role::where('id', '=', $request->get('id'))
            ->with('permissions')
            ->get();

        $allPermissions = Permission::all();
        $rolePermissions = $role->first()->permissions;
        $protectedRoles = env('PROTECTED_ROLES');

        return response()->json([
            'success' => true,
            'role' => $role->first(),
            'role_permissions' => $rolePermissions,
            'all_permissions' => $allPermissions,
            'diff' => $allPermissions->diff($rolePermissions),
            'is_protected' => $protectedRoles ? in_array($role->first()->name, explode(',', $protectedRoles)) : false
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $response = $this->crudService->create($request, new RoleUi());

        if ($request->has('role_permissions')) {
            return $this->processPermissions($request, $response);
        }

        return $response;
    }

    public function update(Request $request): JsonResponse
    {
        if ($this->validator->handle($request, [
            'id' => ['required'],
            'name' => ['required'],
            'role_permissions' => ['required']
        ])) {
            $response = $this->crudService->update($request, new RoleUi());

            if ($request->has('role_permissions')) {
                return $this->processPermissions($request, $response);
            }

            return $response;
        }

        return response()->json(['error' => $this->validator->getMessage()], 400);
    }

    public function destroy(Request $request): JsonResponse
    {
        return $this->crudService->delete($request, new RoleUi());
    }

    protected function processPermissions(Request $request, JsonResponse $response): JsonResponse
    {
        if ($response->getStatusCode() !== 200) {
            return $response;
        }
        // The ID of new or update Role is passed back in the response
        $roleId = $response->getData()->id;
        $role = RoleUi::find($roleId);

        return $this->rolesService->addOrRevokePermissions($role, $request);
    }
}
