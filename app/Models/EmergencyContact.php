<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EmergencyContact
 *
 * @property int $id
 * @property int|null $member_id
 * @property string $contact_name
 * @property int|null $contact_phone_id
 * @property string|null $relationship
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact query()
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact whereContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact whereContactPhoneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmergencyContact whereRelationship($value)
 * @mixin \Eloquent
 */
class EmergencyContact extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'member_id',
        'contact_name',
        'contact_phone_id',
        'relationship',
    ];

}
