<?php

namespace App\Models\Legacy;

/**
 * Class LegacySecurityQuestion
 *
 * @property int $Security_Question_ID
 * @property string|null $Security_Question
 * @method static \Illuminate\Database\Eloquent\Builder|LegacySecurityQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacySecurityQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacySecurityQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|LegacySecurityQuestion whereSecurityQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LegacySecurityQuestion whereSecurityQuestionID($value)
 * @mixin \Eloquent
 */
class LegacySecurityQuestion extends LegacyModel
{
    protected $table = 'tblSecurityQuestions';

    protected $primaryKey = 'Security_Question_ID';

	public $timestamps = false;

    protected $fillable = [
        'Security_Question'
    ];

    protected $guarded = [];


}
