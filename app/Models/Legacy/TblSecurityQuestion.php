<?php

namespace App\Models\Legacy;

/**
 * Class TblSecurityQuestion
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
