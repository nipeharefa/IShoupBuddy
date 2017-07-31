<?php

namespace Tests\Unit;

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
    public function testCanAccessCategoryProduct()
    {
        ///http://localhost:3000/c/uncategorized
        $this->seed('InsertDefaultCategory');
        $response = $this->get('c/uncategorized');
        $response->assertStatus(200);
    }
}
