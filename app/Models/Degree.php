<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Degree
 *
 * @property int $id
 * @property string $degree
 * @property string|null $initiation_date
 * @method static \Illuminate\Database\Eloquent\Builder|Degree newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Degree newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Degree query()
 * @method static \Illuminate\Database\Eloquent\Builder|Degree whereDegree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Degree whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Degree whereInitiationDate($value)
 * @mixin \Eloquent
 * @property int|null $member_id
 * @property-read \App\Models\Member|null $member
 * @method static \Illuminate\Database\Eloquent\Builder|Degree whereMemberId($value)
 */
class Degree extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'degree',
        'member_id',
        'member_id',
        'initiation_date'
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
