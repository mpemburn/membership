<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SecurityQuestion
 *
 * @property int $id
 * @property string|null $question
 * @method static \Illuminate\Database\Eloquent\Builder|SecurityQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SecurityQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SecurityQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|SecurityQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SecurityQuestion whereQuestion($value)
 * @mixin \Eloquent
 */
class SecurityQuestion extends AbstractEloquentModel
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'question'
    ];
}
