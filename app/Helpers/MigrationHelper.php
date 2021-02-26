<?php

namespace App\Helpers;

use App\Models\Address;
use App\Models\AddressType;
use App\Models\Coven;
use App\Models\DegreeType;
use App\Models\Element;
use App\Models\Email;
use App\Models\Legacy\LegacyCoven;
use App\Models\Legacy\LegacyGuild;
use App\Models\Legacy\LegacySecurityQuestion;
use App\Models\Legacy\LegacyState;
use App\Models\Legacy\LegacyUser;
use App\Models\Legacy\LegacyMember;
use App\Models\Member;
use App\Models\Order;
use App\Models\Prefix;
use App\Models\SecurityQuestion;
use App\Models\State;
use App\Models\Suffix;
use App\Models\User;
use App\Models\Wheel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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

    protected const WHEELS = [
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

    protected const ADDRESS_TYPES = [
        'Home',
        'Work',
        'P.O. Box',
        'Other'
    ];

    protected const DEGREE_TYPES = [
        '1st' => 'Witch',
        '2nd' => 'Priestx',
        '3rd' => 'High Priestx',
        '4th' => 'Elder',
        '5th' => 'Craft Parent'
    ];

    protected const ORDERS_IN_LEGACY_COVEN_TABLE = [
        'ELD',
        'OWS',
        'FOA'
    ];

    public static function run(): void
    {
        $instance = new static();
        DB::statement("SET foreign_key_checks=0");
        $instance->populateSubTables();
        $instance->migrateFromLegacyUsers();
        $instance->migrateFromLegacyMembers();
        $instance->populateDependentTables();
        DB::statement("SET foreign_key_checks=1");
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
        LegacyMember::all()->each(function (LegacyMember $legacyMember) {
            $fromLegacy = $legacyMember->toArray();
            $emailAddresses = $this->extractEmailAddresses($legacyMember->Email_Address);
//                !d($legacyMember->First_Name, $legacyMember->Last_Name);
            $member = Member::firstOrCreate([
                'active' => $legacyMember->Active,
                'user_id' => $this->getUserIdFromEmail($legacyMember->Email_Address),
                'email' => $emailAddresses->first(),
                'first_name' => $legacyMember->First_Name,
                'middle_name' => $legacyMember->Middle_Name,
                'last_name' => $legacyMember->Last_Name,
                'magickal_name' => $legacyMember->Magickal_Name,
                'member_since_date' => $legacyMember->Member_Since_Date,
                'member_end_date' => $legacyMember->Member_End_Date,
                'date_of_birth' => $legacyMember->Birth_Date,
                'time_of_birth' => $this->getBirthTime($legacyMember->Birth_Time),
                'place_of_birth' => $legacyMember->Birth_Place,
            ]);
            $this->createEmailAddressesForMember($member, $emailAddresses);
            $this->createMailingAddressesForMember($member, $legacyMember);
            $this->createDegreesForMember($member, $legacyMember);
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

        Wheel::truncate();
        collect(self::WHEELS)->each(static function ($wheel) {
            Wheel::firstOrCreate([
                'wheel' => $wheel
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
                    'wheel' => $legacyCoven->Wheel,
                    'element' => $legacyCoven->Element,
                    'tool' => $legacyCoven->Tool,
                    'inception_date' => $this->getDate($legacyCoven->InceptionDate),
                ]);
            }
        });

        LegacyGuild::all()->each(function (LegacyGuild $legacyGuild) {
            $leaderMember = LegacyMember::find($legacyGuild->LeaderMemberID);
            $newMember = Member::where('email', '=', $leaderMember->Email_Address)
                ->first();
            Order::firstOrCreate([
                'abbreviation' => $legacyGuild->GuildID,
                'name' => $legacyGuild->GuildName,
                'description' => $legacyGuild->Description,
                'leader_member_id' => $newMember->id ?? null,
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
            Email::create([
                'email' => $email,
                'is_primary' => $isPrimary,
                'member_id' => $member->id
            ]);

            $isPrimary = false;
        });
    }

    protected function createMailingAddressesForMember(Member $member, LegacyMember $legacyMember): void
    {
        $attributes = $this->cleanAttributes([
            'address_1' => $legacyMember->Address1 ?? 'Unknown',
            'address_2' => $legacyMember->Address2,
            'address_3' => null,
            'city' => $legacyMember->City ?? 'Unknown',
            'state' => $legacyMember->State ?? 'N/A',
            'zip' => $legacyMember->Zip ?? 'Unknown'
        ]);

        $address = Address::firstOrCreate($attributes);
        // Attach address to the Member
        $member->adresses()->attach($address);
    }

    protected function createDegreesForMember(Member $member, LegacyMember $legacyMember): void
    {

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

        return $user->exists() ? $user->first()->id : null;
    }

    protected function getDate(string $dateString): ?string
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

    protected function getBirthTime(?string $birthTime): ?string
    {
        $birthTime = str_replace(['EDST', '3:00 - 3:20 AM'], ['EDT', '3:20 AM'], $birthTime);
        try {
            $birthTime = Carbon::parse($birthTime)->format('H:i');
        } catch (\Exception $e) {
            // TODO: Gather errors
            return null;
        }

        return $birthTime;
    }

}
