<?php

namespace Tests\Feature;

use App\Models\Member;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\MemberSeeder;
use JsonException;
use Tests\TestCase;
use Faker\Factory;

class MemberTest extends TestCase
{
    protected array $attributes;

    public function setUp(): void
    {
        parent::setUp();
        // Do artisan migrate:refresh on test database
        $this->refreshDatabase();

        (new DatabaseSeeder())->call(MemberSeeder::class);
    }

    public function test_can_create_member(): void
    {
        $this->withoutExceptionHandling();

        $member = Member::factory()->create();
        $attributes = $member->toArray();

        $response = $this->post('/api/member', $attributes);

        $response->assertStatus(200);
        $this->assertDatabaseHas('members', $attributes);
    }

    public function test_can_update_member(): void
    {
        $this->withoutExceptionHandling();
        $member = Member::factory()->create();
        $attributes = $member->toArray();

        $this->post('api/member', $attributes);
        $this->assertDatabaseHas('members', $attributes);

        $attributes['first_name'] = 'Sally';

        $response = $this->put('/api/member_update/' . $member->id, $attributes);
        $response->assertStatus(200);

        $this->assertDatabaseHas('members', $attributes);
    }

    public function test_can_get_member_by_id(): void
    {
        $this->withoutExceptionHandling();

        $member = Member::factory()->create();
        $attributes = $member->toArray();
        $this->post('/api/member', $attributes);

        $response = $this->get('/api/member/' . $member->id);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => array_keys((new Member())->toArray())
            ]
        ]);
    }

    public function test_can_get_all_members(): void
    {
        $this->withoutExceptionHandling();

        $members = Member::factory()->count(5)->make();

        $aMember = $members->first();

        $members->each(function(Member $member) {
            $this->post('/api/member', $member->toArray());
        });

        $this->assertDatabaseHas('members', $aMember->toArray());

        $response = $this->get('/api/members');
        $response->assertStatus(200);

    }
}
