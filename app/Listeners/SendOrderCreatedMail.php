<?php

namespace App\Listeners;

use App\Mail\OrderCreated as OrderCreatedMail;
use Mail;
use Ttrig\Billmate\Events\OrderCreated as OrderCreatedEvent;

class SendOrderCreatedMail
{
    public function handle(OrderCreatedEvent $event)
    {
        if ($email = data_get($event, 'paymentInfo.Customer.Billing.email')) {
            Mail::to($email)
                ->bcc('info@fightzone.se')
                ->send(new OrderCreatedMail())
            ;
        }
    }
}
