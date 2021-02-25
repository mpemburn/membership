<?php

namespace App\Helpers;

use App\Models\Coven;
use App\Models\Element;
use App\Models\Email;
use App\Models\Legacy\LegacyCoven;
use App\Models\Legacy\LegacyGuild;
use App\Models\Legacy\LegacyState;
use App\Models\Legacy\LegacySuffix;
use App\Models\Legacy\LegacyTitle;
use App\Models\Legacy\LegacyUser;
use App\Models\Legacy\LegacyMember;
use App\Models\Member;
use App\Models\User;
use App\Models\Wheel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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

    protected const COVEN_EXCLUDE = [
        'ELD',
        'OWS',
        'FOA'
    ];

    public static function run(): void
    {
        $instance = new static();
//        $instance->migrateFromLegacyUsers();
//        $instance->migrateFromLegacyMembers();
        $instance->populateSubTables();
    }

    public function migrateFromLegacyUsers(): void
    {
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
        LegacyMember::all()->each(function (LegacyMember $legacyMember) {
            $fromLegacy = $legacyMember->toArray();
            if (!Member::query()->where('email', '=', $legacyMember->Email_Address)->exists()) {
                $emailAddresses = $this->extractEmailAddresses($legacyMember->Email_Address);
                $member = Member::create([
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
            }
        });
    }

    public function populateSubTables()
    {
        collect(self::ELEMENTS)->each(static function ($tool, $element) {
            Element::firstOrCreate([
                'tool' => $tool,
                'element' => $element
            ]);
        });

        collect(self::WHEELS)->each(static function ($wheel) {
            Wheel::firstOrCreate([
                'wheel' => $wheel
            ]);
        });

        LegacyCoven::all()->each(function (LegacyCoven $legacyCoven) {
            if (in_array($legacyCoven->Coven, self::COVEN_EXCLUDE, true)) {
                return;
            }
            Coven::firstOrCreate([
                'name' => $legacyCoven->CovenFullName,
                'abbreviation' => $legacyCoven->Coven,
                'wheel' => $legacyCoven->Wheel,
                'element' => $legacyCoven->Element,
                'tool' => $legacyCoven->Tool,
                'inception_date' => $this->getDate($legacyCoven->InceptionDate),
            ]);
        });
        LegacyGuild::all()->each(function (LegacyGuild $legacyGuild) {

        });
        LegacyState::all()->each(function (LegacyState $legacyState) {

        });
        LegacySuffix::all()->each(function (LegacySuffix $legacySuffix) {

        });
        LegacyTitle::all()->each(function (LegacyTitle $legacyTitle) {

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