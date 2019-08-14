<?php

namespace Tests\Unit\Listeners;

use App\Listeners\LogOrderCreated;
use Tests\TestCase;
use Ttrig\Billmate\Events\OrderCreated as OrderCreatedEvent;
use Ttrig\Billmate\Order;

class LogOrderCreatedTest extends TestCase
{
    public function test_listener()
    {
        \Log::shouldReceive('info');

        $event = new OrderCreatedEvent(new Order(), []);

        (new LogOrderCreated())->handle($event);
    }
}
