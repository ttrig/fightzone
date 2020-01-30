<?php

namespace Tests\Feature;

use Tests\TestCase;

class PartnersTest extends TestCase
{
    public function test_index()
    {
        $this->get(route('partners'))
            ->assertOk()
            ->assertSeeText(__('app.partners.partners'))
            ->assertSeeText(__('app.partners.friends'))
        ;
    }
}
