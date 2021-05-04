<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserRolesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group( function () {
    Route::apiResource('roles', RolesController::class );

    Route::apiResource('permissions', PermissionsController::class);

    Route::apiResource('user_roles', UserRolesController::class)
        ->only('index', 'show', 'store');

    Route::get('/members', MembersController::class . '@index');
    Route::post('/member', MembersController::class . '@store');
    Route::post('/member_email', MembersController::class . '@addEmailToMember');
    Route::post('/member_coven', MembersController::class . '@addMemberToCoven');
    Route::put('member_update/{member_id}', [MembersController::class, 'updateMember']);

//    Route::get('/members', MembersController::class . '@index');
    Route::get('/member/{id}', MembersController::class . '@show');
//
//    Route::get('/covens', CovenController::class . '@show');
//    Route::get('/get_auth', AuthController::class . '@getAuthToken');

});
