<?php

namespace Tests\Unit\API;

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
    public function testGetNonExistsProduct()
    {
        $response = $this->json('GET', 'api/product/1000');
        $response->assertStatus(404);
    }

    public function testGetProduct()
    {
        $response = $this->json('GET', 'api/product/1');
        $response->assertStatus(200);
    }
}
