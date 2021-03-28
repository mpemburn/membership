<?php

use App\Http\Controllers\AdminController;
use App\Models\Member;
use Illuminate\Support\Facades\Route;
use App\Helpers\MigrationHelper;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/roles', AdminController::class . '@roles')->name('roles');
    Route::get('/permissions', AdminController::class . '@permissions')->name('permissions');
    Route::get('/user_roles', AdminController::class . '@userRoles')->name('user_roles');

    Route::get('/members', function () {
        return view('members.index');
    })->name('members.list');
});

Route::get('test', function () {
    MigrationHelper::run();
});

//// Get Vue routes
//Route::get('{any}', function () {
//    return view('layouts.vue-app');
//})->where('any','.*');

require __DIR__ . '/auth.php';
