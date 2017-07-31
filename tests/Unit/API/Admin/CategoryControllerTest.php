<?php

namespace Tests\Unit\API\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAdminGetAllCategory()
    {
        $a = $this->seed('InsertDefaultAdmin');
        $admin = User::whereRole(0)->first();
        $this->actingAs($admin, 'api');
        $response = $this->json('GET', 'api/admin/category');
        $response->assertStatus(200);
    }
}
