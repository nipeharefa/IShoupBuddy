<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

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

    public function testUserGetSaldo()
    {
        $this->seed('UserTableSeeder');
        $user = User::find(1);
        $this->actingAs($user, 'api');
        $id = $user->id;
        $response = $this->json('GET', 'api/user/'.$id.'/saldo/transactions');
        $this->assertEquals(200, $response->getStatusCode());
    }
}
