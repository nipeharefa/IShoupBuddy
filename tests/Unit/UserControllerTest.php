<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;

class UserControllerTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->seed('UserTableSeeder');
        $user = User::find(1);
        $this->actingAs($user, 'api');
        $response = $this->json('GET', 'api/user');
        $this->assertEquals(200, $response->getStatusCode());
    }
}
