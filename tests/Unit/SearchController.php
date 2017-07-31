<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery;

class SearchController extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCanVisitSearchPage()
    {
        $nipe = Mockery::mock('nipe');
        $response = $this->get('search');
        $response->assertStatus(200);
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
