<?php

namespace Tests\Unit\API;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MeControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testGuestCantAccess()
    {
        $response = $this->json('GET', 'api/me');
        $response->assertStatus(401);
    }

    public function testAccesAPIMe()
    {
        $this->seed('UserTableSeeder');
        $user = User::find(1);
        $this->actingAs($user, 'api');
        $response = $this->json('GET', 'api/me');
        $response->assertStatus(200);
    }

    public function testGuestSessionCantAccess()
    {
        $response = $this->get('api/me');
        $response->assertStatus(302);
        $response->assertRedirect('login');
    }
}
