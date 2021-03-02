<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Pronoun
 *
 * @property int $id
 * @property string|null $pronouns
 * @method static \Illuminate\Database\Eloquent\Builder|Pronoun newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pronoun newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pronoun query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pronoun whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pronoun wherePronouns($value)
 * @mixin \Eloquent
 */
class Pronoun extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'pronouns'
    ];
}
