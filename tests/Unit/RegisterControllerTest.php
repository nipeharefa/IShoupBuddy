<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

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
            'name'      => 'Foo',
            'email'     => 'foo@bar.com',
            'password'  => 'foo',
            'phone'     => '082275121178',
        ];
        Event::fake();
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

    public function testVendorRegister()
    {
        $data = [
            'name'      => 'Foo',
            'email'     => 'foo@bar.com',
            'password'  => 'foo',
            'phone'     => '082275121178',
        ];

        $response = $this->json('POST', 'auth/vendor/register', $data);

        $response->assertStatus(201);
    }
}
