<?php

namespace App\Http\Controllers;

use App\Models\Coven;
use App\Models\Email;
use App\Services\MembersService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Member;


class MembersController extends Controller
{
    protected MembersService $membersService;

    public function __construct(MembersService $membersService)
    {
        $this->membersService = $membersService;
    }

    public function index(Request $request): JsonResponse
    {
        return $this->membersService->getAllMembers($request);
    }

    public function store(Request $request): JsonResponse
    {
        return $this->membersService->create($request);
    }

    public function show(int $memberId): JsonResponse
    {
        return $this->membersService->getMember($memberId);
    }

    public function updateMember(Request $request, $id): JsonResponse
    {
        return $this->membersService->update($request);
    }

    public function addEmailToMember(Request $request): void
    {
        $member = Member::query()->find($request->get('member_id'));
        $email = new Email([
            'member_id' => $member->id,
            'email' => $request->get('email'),
            'description' => $request->get('description'),
            'is_primary' => $request->get('is_primary')
        ]);

        $member->emails()->save($email);
    }

    public function addMemberToCoven(Request $request): void
    {
        $member = Member::query()->find($request->get('member_id'));
        $coven = Coven::query()->find($request->get('coven_id'));

        if ($member->exists() && $coven->exists()) {
            $coven->members()->save($member);
        }
    }

}
