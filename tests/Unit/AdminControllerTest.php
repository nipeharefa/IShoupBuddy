<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    use DatabaseMigrations;

    private $admin;

    public function setUp()
    {
        parent::setUp();
        $this->seed('InsertDefaultAdmin');
        $this->admin = User::whereRole(0)->first();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAdminGetAllCategory()
    {
        $this->actingAs($this->admin);
        $response = $this->get('admin');
        $response->assertStatus(200);
    }

    public function testAdminCantAccessMemberDashboard()
    {
        $this->actingAs($this->admin);
        $response = $this->get('me');
        $response->assertStatus(403);
    }
}
