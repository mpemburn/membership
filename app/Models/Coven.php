<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Coven
 *
 * @property int $id
 * @property string $name
 * @property string $abbreviation
 * @property string|null $circle
 * @property string|null $element
 * @property string|null $tool
 * @property string|null $inception_date
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Member[] $members
 * @property-read int|null $members_count
 * @method static \Illuminate\Database\Eloquent\Builder|Coven newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coven newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coven query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coven whereAbbreviation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coven whereElement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coven whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coven whereInceptionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coven whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coven whereTool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coven whereCircle($value)
 * @mixin \Eloquent
 */
class Coven extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'abbreviation',
        'circle',
        'element',
        'tool',
        'inception_date',
    ];

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }
}
