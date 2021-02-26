<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DegreeType
 *
 * @property int $id
 * @property string|null $degree
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|DegreeType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DegreeType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DegreeType query()
 * @method static \Illuminate\Database\Eloquent\Builder|DegreeType whereDegree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DegreeType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DegreeType whereId($value)
 * @mixin \Eloquent
 */
class DegreeType extends AbstractEloquentModel
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'degree',
        'description'
    ];

}
