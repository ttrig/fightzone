<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_setPasswordAttribute()
    {
        $cleartext = 'secret';

        $user = User::factory()->make([
            'password' => $cleartext,
        ]);

        $this->assertNotEquals($cleartext, $user->password);
        $this->assertTrue(Hash::check($cleartext, $user->password));
    }
}
