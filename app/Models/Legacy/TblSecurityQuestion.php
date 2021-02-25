<?php

namespace App\Models\Legacy;

/**
 * Class TblSecurityQuestion
 *
 * @property int $Security_Question_ID
 * @property string|null $Security_Question
 * @method static \Illuminate\Database\Eloquent\Builder|TblSecurityQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblSecurityQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblSecurityQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|TblSecurityQuestion whereSecurityQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblSecurityQuestion whereSecurityQuestionID($value)
 * @mixin \Eloquent
 */
class TblSecurityQuestion extends LegacyModel
{
    protected $table = 'tblSecurityQuestions';

    protected $primaryKey = 'Security_Question_ID';

	public $timestamps = false;

    protected $fillable = [
        'Security_Question'
    ];

    protected $guarded = [];


}
