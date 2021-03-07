<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Address
 *
 * @property int|null $id
 * @property string $address_1
 * @property string|null $address_2
 * @property string|null $address_3
 * @property string $city
 * @property string $state
 * @property string $zip
 * @method static \Illuminate\Database\Eloquent\Builder|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddress3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereZip($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Member[] $members
 * @property-read int|null $members_count
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUpdatedAt($value)
 * @property string|null $address_type
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddressType($value)
 */
class Address extends Model
{
    use HasFactory;

    public $fillable = [
        'address_1',
        'address_2',
        'address_3',
        'city',
        'state',
        'zip',
        'address_type',
        'is_primary'
    ];

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class);
    }
}
