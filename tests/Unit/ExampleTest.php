<?php

namespace Tests\Unit;

use Tests\TestCase;
use \Mockery;
use App\Console\Commands\FakeStatistic;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $a = Mockery::mock(FakeStatistic::class);
        $a->shouldReceive('handle')->andReturn();
        $this->artisan('product:fakeprice');
        $this->assertTrue(true);
    }
}
