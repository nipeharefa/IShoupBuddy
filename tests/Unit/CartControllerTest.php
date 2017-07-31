<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CartControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMemberCanAccessCart()
    {
        $this->seed('UserTableSeeder');
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('cart');
        $response->assertStatus(200);
    }
}
