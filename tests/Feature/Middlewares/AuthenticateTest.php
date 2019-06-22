<?php

namespace Tests\Feature\Middlewares;

use Tests\TestCase;

class AuthenticateTest extends TestCase
{
    public function test_redirected_as_guest()
    {
        $this->get(route('admin.index'))->assertRedirect(route('login'));
    }

    public function test_redirected_as_api()
    {
        $this->withHeaders(['Accept' => 'application/json'])
            ->get(route('admin.index'))
            ->assertJson(['message' => 'Unauthenticated.'])
        ;
    }
}
