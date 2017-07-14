<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;

class LoginControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testGuestCanVisitLoginPage()
    {
        $response = $this->get('login');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testAuthUserCantVisitLoginPage()
    {
        $this->seed('UserTableSeeder');
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('login');
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testUserLogin()
    {
        $this->seed('UserTableSeeder');
        $user = User::find(1);

        $data = [
            "email"     =>  $user->email,
            "password"  =>  "secret"
        ];
        $response = $this->post('auth/login', $data);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($this->isAuthenticated());
    }

    public function testUserLogoutWithJson()
    {
        $this->seed('UserTableSeeder');
        $user = User::find(1);

        $this->actingAs($user);
        $response = $this->json('DELETE', 'auth/logout');
        $this->assertEquals(204, $response->getStatusCode());
        $this->assertFalse($this->isAuthenticated());
    }

    public function testUserLogout()
    {
        $this->seed('UserTableSeeder');
        $user = User::find(1);

        $this->actingAs($user);
        $response = $this->delete('auth/logout');
        $this->assertEquals(302, $response->getStatusCode());
    }
}
