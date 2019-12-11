<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_setPasswordAttribute()
    {
        $cleartext = 'secret';

        $user = factory(User::class)->make([
            'password' => $cleartext,
        ]);

        $this->assertNotEquals($cleartext, $user->password);
        $this->assertTrue(Hash::check($cleartext, $user->password));
    }
}
