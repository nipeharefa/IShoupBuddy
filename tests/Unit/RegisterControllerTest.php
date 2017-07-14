<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;

class RegisterControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testGuestCantVisitRegisterPage()
    {
        $response = $this->get('register');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testPostValidRegister()
    {
        $data = [
            "name"      =>  "Foo",
            "email"     =>  "foo@bar.com",
            "password"  =>  "foo",
            "phone"     =>  "082275121178"
        ];

        $response = $this->json('POST', 'auth/register', $data);

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function testAuthUserCantVisitRegister()
    {
        $this->seed('UserTableSeeder');
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('register');
        $this->assertEquals(302, $response->getStatusCode());
    }
}
