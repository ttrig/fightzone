<?php

namespace Tests\Unit\Mail;

use App\Mail\OrderCreated;
use Tests\TestCase;

class OrderCreatedTest extends TestCase
{
    public function test_listener()
    {
        $this->assertNotEmpty((new OrderCreated())->render());
    }
}
