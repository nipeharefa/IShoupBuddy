<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->seed('InsertDefaultCategory');
        $this->seed('InsertDefaultProducts');
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCanVisitProductPage()
    {
        $response = $this->get('product/1');
        $response->assertStatus(200);
    }

    public function testCanNonExistsVisitProductPage()
    {
        $response = $this->get('product/10000');
        $response->assertStatus(404);
    }
}
