<?php

namespace Tests\Unit\Listeners;

use App\Listeners\SendOrderCreatedMail;
use App\Mail\OrderCreated as OrderCreatedMail;
use Mail;
use Tests\TestCase;
use Ttrig\Billmate\Events\OrderCreated as OrderCreatedEvent;
use Ttrig\Billmate\Order;

class SendOrderCreatedMailTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Mail::fake();
    }

    public function test_happy_path()
    {
        $event = new OrderCreatedEvent(new Order(), [
            'Customer' => [
                'Billing' => [
                    'email' => 'test@developer',
                ],
            ],
        ]);

        (new SendOrderCreatedMail())->handle($event);

        Mail::assertSent(OrderCreatedMail::class, function ($mail) {
            #dd($mail->build());
            return $mail->hasTo('test@developer')
                && $mail->bcc('info@fightzone.se')
            ;
        });
    }

    public function test_sad_path()
    {
        $event = new OrderCreatedEvent(new Order(), []);

        (new SendOrderCreatedMail())->handle($event);

        Mail::assertNothingSent();
    }
}
