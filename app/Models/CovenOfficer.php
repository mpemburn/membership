<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CovenOfficer
 *
 * @property int $id
 * @property int|null $coven_id
 * @property int|null $member_id
 * @property string|null $officer
 * @method static \Illuminate\Database\Eloquent\Builder|CovenOfficer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CovenOfficer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CovenOfficer query()
 * @method static \Illuminate\Database\Eloquent\Builder|CovenOfficer whereCovenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CovenOfficer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CovenOfficer whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CovenOfficer whereOfficer($value)
 * @mixin \Eloquent
 */
class CovenOfficer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'coven_id',
        'member_id',
        'officer',
    ];
}
