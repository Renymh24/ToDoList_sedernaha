<?php

namespace Tests\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;

use PHPUnit\Framework\TestCase;


class LoginTest extends TestCase
{
    /**
     * A basic test example.
     */
    use RefreshDatabase;
    public function test_user_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }
}
