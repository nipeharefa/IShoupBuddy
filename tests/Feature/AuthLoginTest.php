<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthLoginTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

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
