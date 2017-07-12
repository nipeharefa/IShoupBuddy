<?php

namespace Tests\Feature;

use Tests\TestCase;

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
