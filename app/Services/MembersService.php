<?php


namespace App\Services;


use App\Models\Coven;
use App\Models\Degree;
use App\Models\Member;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MembersService
{
    protected ValidationService $validator;

    public function __construct(ValidationService $validationService)
    {
        $this->validator = $validationService;
    }

    public function create(Request $request): JsonResponse
    {
        if ($this->validator->handle($request, [
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
        ])) {
            try {
                $data = collect($request->all());
                Member::query()->create($data->toArray());
            } catch (\Exception $e) {
                $this->validator->addError($e->getMessage());
                Log::debug($e->getMessage());
            }
        }

        if ($this->validator->hasError()) {
            return response()->json(['error' => $this->validator->getMessage()], 400);
        }

        return response()->json([
            'success' => true
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        if ($this->validator->handle($request, [
            'id' => ['required'],
        ])) {
            try {
                $memberId = $request->get('id');
                $data = $request->all();
                $member = Member::find($memberId);
                $member->update($data);
                $member->save();
            } catch (\Exception $e) {
                $this->validator->addError($e->getMessage());
                Log::debug($e->getMessage());
            }
        }

        if ($this->validator->hasError()) {
            return response()->json(['error' => $this->validator->getMessage()], 400);
        }

        return response()->json([
            'success' => true
        ]);
    }

    public function getMember(string $memberId): JsonResponse
    {
        $member = Member::find($memberId);
        if ($member->exists()) {
            return response()->json([
                'success' => true,
                'data' => $member->toArray()
            ]);
        }

        $this->validator->addError('Member not found.');

        return response()->json(['error' => $this->validator->getMessage()], 400);
    }

    public function getAllMembers(Request $request): JsonResponse
    {
        $filter = static function ($query) {
            $query->isPrimary();
        };

        $members = Member::query()
            ->where('active', '=', 1)
            ->with('primaryAddress')
            ->with('primaryEmail')
            ->with('primaryPhone')
            ->with('currentCoven')
            ->with('currentDegree')
            ->orderBy('last_name')
            ->orderBy('first_name')->get();

        if ($members->isNotEmpty()) {
            return response()->json([
                'success' => true,
                'members' => $members->toArray(),
                'covens' => $this->getCovenList(),
                'degrees' => $this->getDegreeList()
            ]);
        }
        $this->validator->addError('No members found.');

        return response()->json(['error' => $this->validator->getMessage()], 400);
    }

    protected function getCovenList(): array
    {
        return Coven::all()
            ->sortBy('abbreviation')
            ->pluck('name', 'abbreviation')
            ->toArray();
    }

    protected function getDegreeList(): array
    {
        return Degree::all()
            ->sortBy('degree')
            ->pluck('degree', 'degree')
            ->toArray();
    }
}
