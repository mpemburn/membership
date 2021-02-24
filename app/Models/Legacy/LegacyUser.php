<?php

namespace App\Models\Legacy;

use Illuminate\Support\Facades\Hash;
/**
 * Class User -- for Laravel Auth.
 */
class LegacyUser extends LegacyAuthenticatable
{

    protected $table = 'users';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'member_id',
        'name',
        'email',
        'password',
        'remember_token'
    ];

    protected $guarded = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPassword($password)
    {
        $hash = Hash::make($password);

        $this->password = $hash;
        $this->save();
    }
}
