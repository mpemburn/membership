<?php

namespace App\Models\Legacy;

/**
 * Class TblUser
 *
 * @property int $UserID
 * @property int $LoginEnabled
 * @property string|null $LastOnlineTime
 * @property int|null $UserTypeID
 * @property int $GroupID
 * @property string|null $UserLogon
 * @property string|null $UserPassword
 * @property int $UserTimeZone
 * @property string|null $UserCoven
 * @property string|null $EmailAddress
 * @property string|null $FullName
 * @property string|null $Title
 * @property string|null $FirstName
 * @property string|null $MiddleName
 * @property string|null $LastName
 * @property string|null $Suffix
 * @property string|null $Address_1
 * @property string|null $Address_2
 * @property string|null $Address_3
 * @property string|null $City
 * @property string|null $State
 * @property string|null $Zip
 * @property string|null $Country
 * @property string|null $Phone
 * @property string|null $Cell
 * @property string|null $Fax
 * @property string|null $Other_Phone
 * @property string|null $Comments
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereAddress3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereCell($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereEmailAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereGroupID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereLastOnlineTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereLoginEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereOtherPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereSuffix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereUserCoven($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereUserID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereUserLogon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereUserPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereUserTimeZone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereUserTypeID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TblUser whereZip($value)
 * @mixin \Eloquent
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
