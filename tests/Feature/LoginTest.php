<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page()
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSeeTextInOrder([
                'Login',
                'E-Mail address',
                'Password',
            ])
        ;
    }

    public function test_login_success()
    {
        $user = factory(User::class)->create(['password' => 'Passw0rd']);

        $postData = [
            'email' => $user->email,
            'password' => 'Passw0rd',
        ];

        $this->from(route('login'))
            ->post(route('login'), $postData)
            ->assertRedirect(route('admin.index'))
        ;

        $this->assertAuthenticatedAs($user);
    }

    public function test_login_when_authenticated()
    {
        $user = factory(User::class)->make();
        $this->actingAs($user)
            ->get(route('login'))
            ->assertRedirect(route('home'))
        ;
    }

    public function test_login_failure()
    {
        $postData = [
            'email' => 'admin@local',
            'password' => 'password',
        ];

        $this->from(route('login'))
            ->post(route('login'), $postData)
            ->assertRedirect(route('login'))
            ->assertSessionHasErrors('email')
        ;

        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));

        $this->assertGuest();
    }

    public function test_login_failure_and_expect_json()
    {
        $postData = [
            'email' => 'admin@local',
            'password' => 'password',
        ];

        $this->from(route('login'))
            ->postJson(route('login'), $postData)
            ->assertJsonValidationErrors(['email' => 'These credentials do not match our records.'])
        ;

        $this->assertGuest();
    }
}
