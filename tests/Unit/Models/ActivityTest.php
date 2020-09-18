<?php

namespace Tests\Unit\Models;

use App\Models\Activity;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    public function test_getNameAttribute()
    {
        $activity = Activity::factory()->make();

        $this->assertNotEmpty($activity->name);
        $this->assertNotEquals($activity->slug, $activity->name);
    }
}
