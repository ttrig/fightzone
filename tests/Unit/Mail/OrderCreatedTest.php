<?php

namespace Tests\Unit\Mail;

use App\Mail\OrderCreated;
use Tests\TestCase;

class LogOrderCreatedTest extends TestCase
{
    public function test_listener()
    {
        $this->assertNotEmpty((new OrderCreated())->render());
    }
}
