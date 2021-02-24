<?php

namespace App\Helpers;

use App\Models\Legacy\LegacyLeadershipRole;
use App\Models\Legacy\LegacyUser;
use App\Models\Legacy\LegacyMember;
use App\Models\Member;
use App\Models\User;
use Carbon\Carbon;

class MigrationHelper
{

    public static function run(): void
    {
        $instance = new static();

        $instance->migrateFromLegacyUsers();
        $instance->migrateFromLegacyMembers();
    }

    public function migrateFromLegacyMembers(): void
    {
        LegacyMember::all()->each(function (LegacyMember $legacyMember) {
            $fromLegacy = $legacyMember->toArray();
            if (!Member::query()->where('email', '=', $legacyMember->Email_Address)->exists()) {
                $member = Member::create([
                    'active' => $legacyMember->Active,
                    'user_id' => $this->getUserIdFromEmail($legacyMember->Email_Address),
                    'email' => $legacyMember->Email_Address,
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
            }
        });
    }

    protected function getUserIdFromEmail($email): ?string
    {
        $user = User::query()->where('email', '=', $email);

        return $user->exists() ? $user->first()->id : null;
    }

    protected function getBirthTime(?string $birthTime): ?string
    {
        $birthTime = str_replace(['EDST', '3:00 - 3:20 AM'],['EDT','3:20 AM'], $birthTime);
        try {
            $birthTime = Carbon::parse($birthTime)->format('H:i');
        } catch (\Exception $e) {
            // TODO: Gather errors
            return null;
        }

        return $birthTime;
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
}
