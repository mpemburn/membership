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
    Route::get('/roles', RolesController::class . '@index');
    Route::get('/roles/permissions', RolesController::class . '@getPermissionsForRole');
    Route::post('/roles/create', RolesController::class . '@create');
    Route::put('/roles/update', RolesController::class . '@update');
    Route::delete('/roles/delete', RolesController::class . '@delete');

    Route::get('/permissions', PermissionsController::class . '@index');
    Route::get('/permissions/{id}', PermissionsController::class . '@show');
    Route::post('/permissions/create', PermissionsController::class . '@create');
    Route::put('/permissions/update', PermissionsController::class . '@update');
    Route::delete('/permissions/delete', PermissionsController::class . '@delete');

    Route::get('/user_roles', UserRolesController::class . '@index');
    Route::get('/user_roles/{id}', UserRolesController::class . '@show');
//    Route::get('/user_roles/assigned', UserRolesController::class . '@getAssigned');

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
