<?php

use App\Models\User;
use App\Services\RolesService;
use App\Services\UserRolesService;
use App\Services\ValidationService;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

Route::get('/mwp', function () {
    $json = '[{"id":1,"name":"Create Any Member","checked":false},{"id":2,"name":"Edit Any Member","checked":false},{"id":3,"name":"View Any Member","checked":true},{"id":4,"name":"Deactivate Any Member","checked":true},{"id":5,"name":"Create Coven Member","checked":true},{"id":6,"name":"Edit Coven Member","checked":true},{"id":7,"name":"View Coven Member","checked":true},{"id":8,"name":"Deactivate Coven Member","checked":true},{"id":9,"name":"Imprison Wrongdoers","checked":false},{"id":10,"name":"Make Breakfast","checked":false}]';

    $fromEditor = collect(json_decode($json));
    $role = Role::where('id', 1)->first();

    $fromEditor->each(static function ($permission) use ($role) {
        if ($permission->checked) {
            $role->givePermissionTo($permission->name);
        } else {
            $role->revokePermissionTo($permission->name);
        }
    });

});

Route::get('/service', function () {
    $perm = (new RolesService(new ValidationService()))->getPermissionsForRole('Administrator');

    !d($perm);
});

Route::get('/token', function () {

    $token = auth()->user()->createToken('mpemburn@gmail.com'.'-'.now());

    !d($token);
});

Route::get('/modal', function () {
    return view('vue-test', ['header' => 'head', 'slot' => 'slot']);
});

