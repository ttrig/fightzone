<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_as_guest()
    {
        $this->get(route('admin.index'))->assertRedirect('/login');
    }

    public function test_index_as_user()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('admin.index'))->assertOk();
    }
}
