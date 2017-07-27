<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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
