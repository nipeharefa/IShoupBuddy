<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Category;
use App\Models\User;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_seed_category()
    {
        $this->seed('InsertDefaultCategory');
        $this->assertCount(1, Category::get());
    }

    public function test_admin_can_add_category() {

        $this->seed('InsertDefaultCategory');
        $user = factory(User::class)->create([
            'role' => 0,
        ]);

        $this->actingAs($user, 'api');
        $data = [
            "name"  =>  "Food"
        ];

        $response = $this->json('POST', 'api/admin/category', $data);

        $response->assertStatus(201);

        $this->assertCount(2, Category::get());

        $response->assertJson(['slug' => 'food', 'name' => 'Food']);
    }

    public function test_admin_can_edit_category() {

        $this->seed('InsertDefaultCategory');
        $user = factory(User::class)->create([
            'role' => 0,
        ]);

        $this->actingAs($user, 'api');
        $data = [
            "name"  =>  "Food"
        ];

        $response = $this->json('PUT', 'api/admin/category/1', $data);
        $response->assertStatus(200);

        $category = Category::first();

        $response->assertJson(['slug' => 'uncategorized']);
        $this->assertSame('Food', $category->name);
    }
}
