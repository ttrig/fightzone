<?php

namespace Tests\Unit\Traits;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HasContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_getContentAttribute()
    {
        $alert = Event::factory()->make();

        $this->assertNotEmpty($alert->content);
    }
}
