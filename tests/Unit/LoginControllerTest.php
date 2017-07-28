<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->seed('UserTableSeeder');
    }

    public function testGuestCanVisitLoginPage()
    {
        $response = $this->get('login');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testAuthUserCantVisitLoginPage()
    {
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('login');
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testUserLogin()
    {
        $user = User::find(1);

        $data = [
            'email'     => $user->email,
            'password'  => 'secret',
        ];
        $response = $this->json('POST', 'auth/login', $data);
        $this->assertTrue($this->isAuthenticated());
        $response->assertStatus(200);
        $response->assertJsonStructure(['message', 'status', 'user', 'redirect_to']);
    }

    public function testUserLogoutWithJson()
    {
        $user = User::find(1);

        $this->actingAs($user);
        $response = $this->json('DELETE', 'auth/logout');
        $this->assertEquals(204, $response->getStatusCode());
        $this->assertFalse($this->isAuthenticated());
    }

    public function testAdminLogin()
    {
        $a = $this->seed('InsertDefaultAdmin');
        $admin = User::whereRole(0)->first();
        $data = [
            'email'     => $admin->email,
            'password'  => 'secret',
        ];
        $response = $this->json('POST', 'auth/login', $data);
        $this->assertTrue($this->isAuthenticated());
        $response->assertStatus(200);

        $content = json_decode($response->getContent(), true);
        $this->assertEquals('/admin/product', $content['redirect_to']);
    }

    public function testAdminRedirectWhenAccessLoginPage()
    {
        $a = $this->seed('InsertDefaultAdmin');
        $admin = User::whereRole(0)->first();
        $this->actingAs($admin);
        $response = $this->get('login');
        $response->assertStatus(302);
        $response->assertRedirect('/admin/product');
    }

    public function testVendorLogin()
    {
        $this->seed('InsertVendorsTableSeeder');
        $vendor = User::whereRole(2)->first();
        $data = [
            'email'     => $vendor->email,
            'password'  => 'secret',
        ];
        $response = $this->json('POST', 'auth/login', $data);
        $this->assertTrue($this->isAuthenticated());
        $response->assertStatus(200);

        $content = json_decode($response->getContent(), true);
        $this->assertEquals('/vendor/product', $content['redirect_to']);
    }

    public function testVendorRedirectWhenAccessLoginPage()
    {
        $a = $this->seed('InsertVendorsTableSeeder');
        $admin = User::whereRole(2)->first();
        $this->actingAs($admin);
        $response = $this->get('login');
        $response->assertStatus(302);
        $response->assertRedirect('/vendor/product');
    }

    public function testUserLogout()
    {
        $user = User::find(1);

        $this->actingAs($user);
        $response = $this->delete('auth/logout');
        $this->assertEquals(302, $response->getStatusCode());
    }


}
