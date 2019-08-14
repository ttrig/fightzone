<?php

namespace App\Listeners;

use Ttrig\Billmate\Events\OrderCreated;

class LogOrderCreated
{
    public function handle(OrderCreated $event)
    {
        info('Billmate order created', compact('event'));
    }
}
