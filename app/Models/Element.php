<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Element
 *
 * @property string|null $element
 * @property string|null $tool
 * @method static \Illuminate\Database\Eloquent\Builder|Element newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Element newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Element query()
 * @method static \Illuminate\Database\Eloquent\Builder|Element whereElement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Element whereTool($value)
 * @mixin \Eloquent
 */
class Element extends AbstractEloquentModel
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'element',
        'tool'
    ];
}
