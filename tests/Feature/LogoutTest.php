<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_logout_when_authenticated()
    {
        $user = factory(User::class)->make();

        $this->actingAs($user)
            ->post(route('logout'))
            ->assertRedirect(route('home'))
        ;

        $this->assertGuest();
    }

    public function test_logout_when_not_authenticated()
    {
        $this->post(route('logout'))->assertRedirect(route('home'));
    }
}
