<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserRolesService;
use App\Services\ValidationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserRolesController extends Controller
{
    protected UserRolesService $userRolesService;

    public function __construct(UserRolesService $userRolesService)
    {
        $this->userRolesService = $userRolesService;
    }

    public function index()
    {
        $users = User::with('roles')
            ->with('permissions')
            ->get();

        return response()->json(['success' => true, 'users' => $users]);
    }

    public function show(Request $request, int $userId)
    {
        $user = User::where('id', '=', $userId)
            ->with('roles')
            ->with('permissions')
            ->first();

        return response()->json(['success' => true, 'user' => $user]);
    }

    public function edit(Request $request)
    {
        return $this->userRolesService->edit($request);
    }

    public function getAssigned(Request $request): JsonResponse
    {
        Log::debug('Wha?');
        return $this->userRolesService->getPermissionsAssignedToRole($request);
    }
}
