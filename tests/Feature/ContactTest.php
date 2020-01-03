<?php

namespace Tests\Feature;

use Tests\TestCase;

class ContactTest extends TestCase
{
    public function test_index()
    {
        $this->get(route('contact'))
            ->assertOk()
            ->assertSeeText(__('app.contact.title'))
        ;
    }
}
