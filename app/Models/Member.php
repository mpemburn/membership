<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

/**
 * Class Member
 *
 * @package App\Models
 * @property int $id
 * @property int $active
 * @property int|null $user_id
 * @property int|null $prefix_id
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property int|null $suffix_id
 * @property string|null $magickal_name
 * @property string|null $member_since_date
 * @property string|null $member_end_date
 * @property string|null $date_of_birth
 * @property string|null $time_of_birth
 * @property string|null $place_of_birth
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $coven_id
 * @property string|null $email
 * @property-read \App\Models\Coven|null $coven
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Email[] $emails
 * @property-read int|null $emails_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Prefix|null $prefix
 * @property-read \App\Models\Suffix|null $suffix
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Member newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Member newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Member query()
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereCovenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereMagickalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereMemberEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereMemberSinceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member wherePlaceOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member wherePrefixId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereSuffixId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereTimeOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Member whereUserId($value)
 * @mixin \Eloquent
 */
class Member extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'active',
        'user_id',
        'email',
        'prefix_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix_id',
        'magickal_name',
        'member_since_date',
        'member_end_date',
        'date_of_birth',
        'time_of_birth',
        'place_of_birth',
        'coven_id',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function prefix(): HasOne
    {
        return $this->hasOne(Prefix::class);
    }

    public function suffix(): HasOne
    {
        return $this->hasOne(Suffix::class);
    }

    public function emails(): HasMany
    {
        return $this->hasMany(Email::class);
    }

    public function coven(): BelongsTo
    {
        return $this->belongsTo(Coven::class);
    }

    public function adresses(): BelongsToMany
    {
        return $this->belongsToMany(Address::class);
    }
}
