<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthLoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testVisitLoginPage()
    {
        $this->get('/login');
        $this->assertTrue(true);
    }
}
