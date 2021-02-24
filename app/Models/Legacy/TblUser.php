<?php

namespace App\Models\Legacy;

/**
 * Class TblUser
 */
class TblUser extends LegacyModel
{
    protected $table = 'tblUsers';

    protected $primaryKey = 'UserID';

	public $timestamps = false;

    protected $fillable = [
        'LoginEnabled',
        'LastOnlineTime',
        'UserTypeID',
        'GroupID',
        'UserLogon',
        'UserPassword',
        'UserTimeZone',
        'UserCoven',
        'EmailAddress',
        'FullName',
        'Title',
        'FirstName',
        'MiddleName',
        'LastName',
        'Suffix',
        'Address_1',
        'Address_2',
        'Address_3',
        'City',
        'State',
        'Zip',
        'Country',
        'Phone',
        'Cell',
        'Fax',
        'Other_Phone',
        'Comments'
    ];

    protected $guarded = [];


}
