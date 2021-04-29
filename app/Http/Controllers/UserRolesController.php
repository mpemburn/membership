<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserRolesService;
use App\Services\ValidationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolesController extends Controller
{
    protected UserRolesService $userRolesService;
    protected ValidationService $validator;

    public function __construct(UserRolesService $userRolesService, ValidationService $validationService)
    {
        $this->userRolesService = $userRolesService;
        $this->validator = $validationService;
    }

    public function index(): JsonResponse
    {
        $users = User::with('roles')
            ->with('permissions')
            ->get();

        return response()->json(['success' => true, 'users' => $users]);
    }

    public function show(Request $request, int $userId): JsonResponse
    {
        $user = User::where('id', '=', $userId)
            ->with('roles')
            ->with('permissions')
            ->first();

        $allRoles = Role::all();
        $userRoles = $user->roles ?? [];
        $allPermissions = Permission::all();
        $userPermissions = $user->permissions ?? [];
        $assignedPermissions = $this->userRolesService->getUserRoleAssignedPermissions($userRoles, $userPermissions);

        return response()->json([
            'success' => true,
            'user' => $user,
            'diff' => [
                'roles' => $allRoles->diff($userRoles),
                'permissions' => $allPermissions
                    ->diff($userPermissions)
                    ->diff($assignedPermissions)
            ],
            'assigned_permissions' => $assignedPermissions
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        if ($this->validator->handle($request, [
            'id' => ['required'],
            'roles' => ['required'],
            'permissions' => ['required']
        ])) {
            $user = User::where('id', '=', $request->get('id'))->first();
            if ($user) {
                $grantedRoles = $this->userRolesService->addOrRevokeRoles($request, $user);
                $grantedPermissions = $this->userRolesService->addOrRevokePermissions($request, $user);

                return response()->json([
                    'success' => true,
                    'user' => $user,
                    'roles' => $grantedRoles,
                    'permissions' => $grantedPermissions
                ]);
            }
        }

        return response()->json(['error' => $this->validator->getMessage()], 400);
    }

    public function getAssigned(Request $request): JsonResponse
    {
        Log::debug('Wha?');
        return $this->userRolesService->getPermissionsAssignedToRole($request);
    }
}
