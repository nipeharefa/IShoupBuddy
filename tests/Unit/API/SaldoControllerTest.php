<?php

namespace Tests\Unit\API;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SaldoControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUserCanGetSaldo()
    {
        $this->seed('UserTableSeeder');
        $user = User::find(1);
        $this->actingAs($user, 'api');
        $response = $this->get('api/saldo');
        $response->assertStatus(200);
    }
}
