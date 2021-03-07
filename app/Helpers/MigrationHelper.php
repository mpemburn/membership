<?php

namespace App\Helpers;

use App\Models\Address;
use App\Models\AddressType;
use App\Models\Bonded;
use App\Models\Coven;
use App\Models\CovenOfficer;
use App\Models\Degree;
use App\Models\DegreeType;
use App\Models\Element;
use App\Models\Email;
use App\Models\EmergencyContact;
use App\Models\Leader;
use App\Models\LeadershipRole;
use App\Models\Legacy\LegacyCoven;
use App\Models\Legacy\LegacyGuild;
use App\Models\Legacy\LegacyLeadershipRole;
use App\Models\Legacy\LegacySecurityQuestion;
use App\Models\Legacy\LegacyState;
use App\Models\Legacy\LegacyUser;
use App\Models\Legacy\LegacyMember;
use App\Models\Member;
use App\Models\Note;
use App\Models\Order;
use App\Models\PhoneNumber;
use App\Models\Prefix;
use App\Models\Pronoun;
use App\Models\SecurityQuestion;
use App\Models\State;
use App\Models\Suffix;
use App\Models\User;
use App\Models\Circle;
use App\Objects\PhoneParser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MigrationHelper
{
    protected const ELEMENTS = [
        'Air' => 'Sword',
        'Fire' => 'Staff',
        'Water' => 'Chalice',
        'Earth' => 'Pentacle'
    ];

    protected const CIRCLES = [
        'Pisces',
        'Aquarius',
        'Capricorn',
        'Sagittarius',
        'Scorpio',
        'Libra',
        'Virgo',
        'Leo',
        'Cancer',
        'Gemini',
        'Taurus',
        'Aries'
    ];

    protected const PREFIXES = [
        'Ms.',
        'Mr.',
        'Mx.',
        'Dr.',
        'Prof.',
        'Col.',
        'Sir',
        'c/o',
    ];

    protected const SUFFIXES = [
        'Jr.',
        'Sr.',
        'II',
        'III',
        'III',
        'MD',
        'DDS',
        'PA',
        'JD',
        'OD',
        'President',
        'CEO',
        'G.P.',
        'P.A.',
        'Partner',
    ];

    protected const PREFERRED_GENDER_PRONOUNS = [
        'She/Her/Hers/Herself',
        'He/Him/His/Himself',
        'Ze/Zim/Zirs/Zirself',
        'Zie/Hir/Hirs/Hirself',
        'Sie/Hir/Hirs/Hirself',
        'Zie/Zir/Zirs/Zirself',
        'Ey/Em/Eirs/Eirself',
        'Per/Per/Pers/Perssself',
        'They/Them/Theirs/Themself'
    ];

    protected const ADDRESS_TYPES = [
        'Home',
        'Work',
        'P.O. Box',
        'Other'
    ];

    protected const DEGREE_TYPES = [
        'none' => 'none',
        '1st' => 'Witch',
        '2nd' => 'Priestx',
        '3rd' => 'High Priestx',
        '4th' => 'Elder',
        '5th' => 'Craft Parent'
    ];

    protected const DEGREE_DATE_FIELD_NAMES = [
        'First_Degree_Date' => '1st',
        'Second_Degree_Date' => '2nd',
        'Third_Degree_Date' => '3rd',
        'Fourth_Degree_Date' => '4th',
        'Fifth_Degree_Date' => '5th'
    ];

    protected const PHONE_TYPE_FIELD_NAMES = [
        'Home_Phone',
        'Work_Phone',
        'Cell_Phone',
        'Fax_Phone',
    ];

    protected const ORDERS_IN_LEGACY_COVEN_TABLE = [
        'ELD',
        'OWS',
        'FOA'
    ];

    protected const TIME_STRING_GOOFS = [
        'EDST' => 'EDT',
        '3:00 - 3:20 AM' => '3:20 AM'
    ];

    protected const ELDER_CIRCLES = [
        'Ivo Dominguez' => 'Pisces',
        'Michael Smith' => 'Pisces',
        'Robin Fennelly' => 'Capricorn',
    ];

    public static function run(): void
    {
        $instance = new static();
        // Do a schema dump to make sure the database and migrations are in sync
        Artisan::call('schema:dump');

        DB::statement("SET foreign_key_checks=0");
        $instance->populateSubTables();
        $instance->migrateFromLegacyUsers();
        $instance->migrateFromLegacyMembers();
        $instance->populateDependentTables();
        DB::statement("SET foreign_key_checks=1");

        Artisan::call('quickstart', [
            '--email' => env('DEFAULT_ADMIN_USER')
        ]);
    }

    public function migrateFromLegacyUsers(): void
    {
        User::truncate();
        LegacyUser::all()->each(static function (LegacyUser $legacyUser) {
            $fromLegacy = $legacyUser->toArray();
            unset($fromLegacy['member_id']);
            $fromLegacy['password'] = $legacyUser->password;
            $fromLegacy['remember_token'] = $legacyUser->remember_token;
            if (!User::query()->where('email', '=', $legacyUser->email)->exists()) {
                User::create($fromLegacy);
            }
        });
    }

    public function migrateFromLegacyMembers(): void
    {
        Member::truncate();
        Email::truncate();
        Address::truncate();
        Degree::truncate();
        PhoneNumber::truncate();
        Leader::truncate();
        Bonded::truncate();
        Note::truncate();
        // Truncate the pivot tables
        DB::table('address_member')->truncate();
        DB::table('coven_member')->truncate();
        LegacyMember::all()->each(function (LegacyMember $legacyMember) {
//                !d($legacyMember->First_Name, $legacyMember->Last_Name);
            $emailAddresses = $this->extractEmailAddresses($legacyMember->Email_Address);
            $member = Member::firstOrCreate([
                'active' => $legacyMember->Active,
                'user_id' => $this->getUserIdFromEmail($legacyMember->Email_Address),
//                'coven_id' => $this->getCovenIdFromName($legacyMember->Coven),
                'first_name' => $legacyMember->First_Name,
                'middle_name' => $legacyMember->Middle_Name,
                'last_name' => $legacyMember->Last_Name,
                'magickal_name' => $legacyMember->Magickal_Name,
                'member_since_date' => $legacyMember->Member_Since_Date,
                'member_end_date' => $legacyMember->Member_End_Date,
                'date_of_birth' => $legacyMember->Birth_Date,
                'time_of_birth' => $this->getTimeString($legacyMember->Birth_Time),
                'place_of_birth' => $legacyMember->Birth_Place,
                'current_degree_id' => $legacyMember->Degree,
                'is_solitary' => $legacyMember->Solitary,
                'solitary_date' => $legacyMember->Solitary_Date,
            ]);
//            !d($member->toArray());
            $this->createEmailAddressesForMember($member, $emailAddresses);
            $this->createCovensForMember($member, $legacyMember);
            $this->createMailingAddressesForMember($member, $legacyMember);
            $this->createDegreesForMember($member, $legacyMember);
            $this->createPhonesForMember($member, $legacyMember);
            $this->createLeadersForMember($member, $legacyMember);
            $this->createBondedForMember($member, $legacyMember);
            $this->createNotesForMember($member, $legacyMember);
        });
    }

    public function populateSubTables(): void
    {
        Suffix::truncate();
        collect(self::SUFFIXES)->each(static function ($suffix) {
            Suffix::firstOrCreate([
                'suffix' => $suffix
            ]);
        });

        Prefix::truncate();
        collect(self::PREFIXES)->each(static function ($prefix) {
            Prefix::firstOrCreate([
                'prefix' => $prefix
            ]);
        });

        Pronoun::truncate();
        collect(self::PREFERRED_GENDER_PRONOUNS)->each(static function ($pronouns) {
            Pronoun::firstOrCreate([
                'pronouns' => $pronouns
            ]);
        });

        AddressType::truncate();
        collect(self::ADDRESS_TYPES)->each(static function ($type) {
            AddressType::firstOrCreate([
                'type' => $type
            ]);
        });

        DegreeType::truncate();
        collect(self::DEGREE_TYPES)->each(static function ($description, $degree) {
            DegreeType::firstOrCreate([
                'degree' => $degree,
                'description' => $description
            ]);
        });

        Element::truncate();
        collect(self::ELEMENTS)->each(static function ($tool, $element) {
            Element::firstOrCreate([
                'tool' => $tool,
                'element' => $element
            ]);
        });

        Circle::truncate();
        collect(self::CIRCLES)->each(static function ($circle) {
            Circle::firstOrCreate([
                'circle' => $circle
            ]);
        });

        LeadershipRole::truncate();
        LegacyLeadershipRole::all()->each(function (LegacyLeadershipRole $legacyLeadershipRole) {
            LeadershipRole::firstOrCreate([
                'role_name' => $legacyLeadershipRole->Description,
                'abbreviation' => $legacyLeadershipRole->Role,
                'group_name' => $legacyLeadershipRole->GroupName,
                'level' => $legacyLeadershipRole->LeadershipLevel
            ]);
        });

        State::truncate();
        LegacyState::all()->each(function (LegacyState $legacyState) {
            State::firstOrCreate([
                'abbreviation' => $legacyState->Abbrev,
                'name' => $legacyState->State,
                'country' => $legacyState->Country,
                'is_local' => $legacyState->Local
            ]);
        });
    }

    public function populateDependentTables(): void
    {
        Coven::truncate();
        Order::truncate();
        SecurityQuestion::truncate();

        LegacyCoven::all()->each(function (LegacyCoven $legacyCoven) {
            if (in_array($legacyCoven->Coven, self::ORDERS_IN_LEGACY_COVEN_TABLE, true)) {
                Order::firstOrCreate([
                    'abbreviation' => $legacyCoven->Coven,
                    'name' => $legacyCoven->CovenFullName,
                    'description' => null,
                    'leader_member_id' => null,
                ]);
            } else {
                Coven::firstOrCreate([
                    'name' => $legacyCoven->CovenFullName,
                    'abbreviation' => $legacyCoven->Coven,
                    'circle' => $legacyCoven->Wheel,
                    'element' => $legacyCoven->Element,
                    'tool' => $legacyCoven->Tool,
                    'inception_date' => $this->getDateString($legacyCoven->InceptionDate),
                ]);
            }
        });

        LegacyGuild::all()->each(function (LegacyGuild $legacyGuild) {
            $leaderMember = LegacyMember::find($legacyGuild->LeaderMemberID);
            $newMember = (new Member())->getByPrimaryEmail($leaderMember->Email_Address);
            Order::firstOrCreate([
                'abbreviation' => $legacyGuild->GuildID,
                'name' => $legacyGuild->GuildName,
                'description' => $legacyGuild->Description,
                'leader_member_id' => $newMember && $newMember->first() ? $newMember->first()->id : null,
            ]);
        });

        LegacySecurityQuestion::all()->each(function (LegacySecurityQuestion $question) {
            SecurityQuestion::firstOrCreate([
                'question' => $question->Security_Question
            ]);
        });
    }

    protected function extractEmailAddresses(?string $address): Collection
    {
        $emailAddresses = collect();

        if (!$address) {
            return $emailAddresses;
        }

        $request = new Request(['email' => trim($address)]);
        $validator = Validator::make($request->all(), [
            'email' => 'email',
        ]);
        if ($validator->fails() && strpos($address, ',') !== false) {
            $emailAddresses = collect(explode(',', str_replace(' ', '', $address)));
        } else {
            $emailAddresses->push(trim($address));
        }

        return $emailAddresses;
    }

    protected function createEmailAddressesForMember(Member $member, Collection $emailAddresses): void
    {
        $isPrimary = true;
        $emailAddresses->each(static function (string $email) use ($member, &$isPrimary) {
            Email::firstOrCreate([
                'email' => $email,
                'is_primary' => $isPrimary,
                'member_id' => $member->id
            ]);

            $isPrimary = false;
        });
    }

    protected function createCovensForMember(Member $member, LegacyMember $legacyMember): void
    {
        if ($legacyMember->LeadershipRole === 'ELDER') {
            // Elders are bonded to all covens in their Circle
            $elderCircle = self::ELDER_CIRCLES[$legacyMember->First_Name . ' ' . $legacyMember->Last_Name];
            Coven::where('circle', '=', $elderCircle)->each(function (Coven $coven) use ($member) {
                $this->createBondedMember($member, $coven->id, null);
            });
        } else {
            $coven = Coven::where('abbreviation', '=', $legacyMember->Coven)->first();
            $member->covens()->attach($coven, ['is_current' => $legacyMember->Active]);
        }
    }

    protected function createMailingAddressesForMember(Member $member, LegacyMember $legacyMember): void
    {
        if (! $legacyMember->Address1) {
            return;
        }
        $attributes = $this->cleanAttributes([
            'address_1' => $legacyMember->Address1 ?? 'Unknown',
            'address_2' => $legacyMember->Address2,
            'address_3' => null,
            'city' => $legacyMember->City ?? 'Unknown',
            'state' => $legacyMember->State ?? 'N/A',
            'zip' => $legacyMember->Zip ?? 'Unknown',
            'address_type' => $this->setAddressType($legacyMember->Address1),
            'is_primary' => 1
        ]);

        $address = Address::firstOrCreate($attributes);
        // Attach address to the Member
        $member->addresses()->attach($address);
    }

    protected function setAddressType(?string $address1): string
    {
        if (preg_match('/(po|p.o.)(box| box)/i', $address1)) {
            return 'P.O. Box';
        }

        return 'Home';
    }

    protected function createDegreesForMember(Member $member, LegacyMember $legacyMember): void
    {
        collect(self::DEGREE_DATE_FIELD_NAMES)->each(function (string $degree, string $fieldName) use ($legacyMember, $member, &$highestDegree) {
            $degreeDate = $legacyMember->{$fieldName};
            $degreeId = (int)$degree;
            if ($degreeDate) {
                $attributes = [
                    'member_id' => $member->id,
                    'degree' => $degree,
                    'degree_id' => $degreeId,
                    'initiation_date' => $degreeDate,
                    'is_current' => ($degreeId === $legacyMember->Degree)
                ];
                Degree::firstOrCreate($attributes);
            }
        });

    }

    protected function createPhonesForMember(Member $member, LegacyMember $legacyMember): void
    {
        collect(self::PHONE_TYPE_FIELD_NAMES)->each(function (string $fieldName, int $key) use ($legacyMember, $member, &$highestDegree) {
            $isPrimary = (($key + 1) === $legacyMember->Primary_Phone);
            $type = str_replace('_Phone', '', $fieldName);
            $testNumber = trim($legacyMember->{$fieldName});

            if ($testNumber) {
                $parser = new PhoneParser;
                $phoneNumber = $parser->parse($testNumber)->format();
                $extension = $parser->getExtension();
                $attributes = [
                    'number' => $phoneNumber,
                    'member_id' => $member->id,
                    'extension' => $extension,
                    'type' => $type,
                    'is_primary' => $isPrimary
                ];

                if ($phoneNumber) {
                    PhoneNumber::firstOrCreate($attributes);
                } else {
                    // TODO: Gather errors
                }
            }
        });
        //vaxM3Now
    }

    protected function createLeadersForMember(Member $member, LegacyMember $legacyMember): void
    {
        if (! $legacyMember->LeadershipRole || $legacyMember->Active === 0) {
            return;
        }

        $circle = null;
        $coven = $member->getCurrentCoven();
        if ($coven->exists()) {
            $covenId = $coven->first()->id;
            if ($legacyMember->LeadershipRole === 'SCR' || $legacyMember->LeadershipRole === 'PW') {
                CovenOfficer::firstOrCreate([
                    'coven_id' => $covenId,
                    'member_id' => $member->id,
                    'officer' => $legacyMember->LeadershipRole,
                ]);
            } else {
                $circle = $this->getCircleFromCovenId($covenId);
            }
        } else if (in_array($legacyMember->First_Name . ' ' . $legacyMember->Last_Name, self::ELDER_CIRCLES)) {
            $circle = self::ELDER_CIRCLES[$legacyMember->First_Name . ' ' . $legacyMember->Last_Name];
        }

        if ($circle) {
            Leader::firstOrCreate([
                'member_id' => $member->id,
                'role_name' => $legacyMember->LeadershipRole,
                'circle' => $circle,
                'leadership_date' => $legacyMember->Leadership_Date,
            ]);

        }
    }

    protected function createBondedForMember(Member $member, LegacyMember $legacyMember): void
    {
        if ($legacyMember->Bonded === 1 && $member->active === 1) {
            if ($member->covens()->first() && $member->covens()->first()->id) {
                $this->createBondedMember($member, $member->covens()->first()->id, $legacyMember->Bonded_Date);
            }
        }
    }

    protected function createBondedMember(Member $member, int $covenId, ?string $date): void
    {
        Bonded::firstOrCreate([
            'member_id' => $member->id,
            'coven_id' => $covenId,
            'bonded_date' => $date
        ]);
    }

    protected function createNotesForMember(Member $member, LegacyMember $legacyMember): void
    {
        if ($legacyMember->Comments) {
            //!d($legacyMember->Comments);
            Note::firstOrCreate([
                'member_id' => $member->id,
                'note' => $legacyMember->Comments
            ]);
        }
    }

    protected function cleanAttributes(array $attributes): array
    {
        return collect($attributes)->map(static function ($value, $key) {
            if (!$value) {
                return null;
            }
            return trim($value);
        })->filter()->toArray();
    }

    protected function getUserIdFromEmail($email): ?string
    {
        $user = User::query()->where('email', '=', $email);

        return $user && $user->exists() ? $user->first()->id : null;
    }

    protected function getCovenIdFromName(?string $covenName): ?int
    {
        $coven = Coven::where('abbreviation', '=', $covenName);

        return $coven && $coven->exists() ? $coven->first()->id : null;
    }

    protected function getCircleFromCovenId($covenId)
    {
        $coven = Coven::find($covenId);

        return $coven && $coven->exists() ? $coven->first()->circle : null;
    }

    protected function getDateString(string $dateString): ?string
    {
        if ($dateString === '0000-00-00') {
            return null;
        }
        try {
            $dateString = Carbon::parse($dateString)->format('Y-m-d');
        } catch (\Exception $e) {
            // TODO: Gather errors
            return null;
        }

        return $dateString;
    }

    protected function getTimeString(?string $timeString): ?string
    {
        $timeString = str_replace(
            array_keys(self::TIME_STRING_GOOFS),
            array_values(self::TIME_STRING_GOOFS),
            $timeString
        );
        try {
            $timeString = Carbon::parse($timeString)->format('H:i');
        } catch (\Exception $e) {
            // TODO: Gather errors
            return null;
        }

        return $timeString;
    }
}
