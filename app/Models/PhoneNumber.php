<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PhoneNumber
 *
 * @property int $id
 * @property string $phone_number
 * @property string|null $extension
 * @property string|null $type
 * @property int|null $is_primary
 * @property int|null $member_id
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber query()
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber whereIsPrimary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber whereType($value)
 * @mixin \Eloquent
 * @property string|null $country_code
 * @method static \Illuminate\Database\Eloquent\Builder|PhoneNumber whereCountryCode($value)
 */
class PhoneNumber extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'number',
        'member_id',
        'country_code',
        'extension',
        'type',
        'is_primary'
    ];

    public function scopeIsPrimary(Builder $query): Builder
    {
        return $query->where('is_primary', '=', true);
    }
}
