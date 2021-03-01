<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Email
 *
 * @package App\Models
 * @property $email
 * @property int $id
 * @property int|null $is_primary
 * @property string|null $description
 * @property int|null $member_id
 * @property-read \App\Models\Member|null $member
 * @method static \Illuminate\Database\Eloquent\Builder|Email newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Email newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Email query()
 * @method static \Illuminate\Database\Eloquent\Builder|Email whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Email whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Email whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Email whereIsPrimary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Email whereMemberId($value)
 * @mixin \Eloquent
 */
class Email extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'email',
        'member_id',
        'is_primary',
        'description'
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
