<?php

namespace App\Models\Legacy;

use Illuminate\Support\Facades\Hash;
/**
 * Class User -- for Laravel Auth.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $member_id
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyUser whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyUser whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyUser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyUser wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyUser whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacyUser whereUpdatedAt($value)
 * @mixin \Eloquent
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
