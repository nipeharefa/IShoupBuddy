<?php

namespace Tests\Feature\Member;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;

class MemberTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = factory(User::class)->create();

        $a = $this->actingAs($user, 'api');
        $response = $this->get("api/me");
        $response->assertStatus(200)
            ->json();
    }
}
