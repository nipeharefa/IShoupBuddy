<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;

class MeControllerTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAuthUserCantAccessMe()
    {
        $this->seed('UserTableSeeder');
        $user = User::find(1);
        $this->actingAs($user);
        $response = $this->get('me/saldo');
        $response->assertStatus(200);
    }

    public function testVendorCantAccessMePage()
    {
        $a = $this->seed('InsertVendorsTableSeeder');
        $admin = User::whereRole(2)->first();
        $this->actingAs($admin);
        $response = $this->get('me');
        $response->assertStatus(403);
    }
}
