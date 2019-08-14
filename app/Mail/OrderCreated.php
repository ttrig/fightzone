<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class OrderCreated extends Mailable
{
    public function build()
    {
        return $this->markdown('emails.orders.created');
    }
}
