<?php

namespace App\Http\Controllers;

use App\Models\PermissionUi;
use App\Services\PermissionsCrudService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    protected PermissionsCrudService $crudService;

    public function __construct(PermissionsCrudService $permissionsService)
    {
        $this->crudService = $permissionsService;
    }

    public function index(Request $request): JsonResponse
    {
        $permissions = Permission::all();

        return response()->json(['success' => true, 'permissions' => $permissions]);
    }

    public function create(Request $request): JsonResponse
    {
        return $this->crudService->create($request, new PermissionUi());
    }

    public function update(Request $request): JsonResponse
    {
        return $this->crudService->update($request, new PermissionUi());
    }

    public function delete(Request $request): JsonResponse
    {
        return $this->crudService->delete($request, new PermissionUi());
    }
}
