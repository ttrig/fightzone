<?php

namespace Tests\Unit\Traits;

use App\Models\Event;
use Illuminate\Support\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HasTimesTest extends TestCase
{
    use RefreshDatabase;

    public function test_getHasStartedAttribute()
    {
        Carbon::setTestNow('2019-01-01 11:00:00');

        $class1 = Event::factory()->make([
            'from_time' => '10:00',
            'to_time'   => '11:00',
        ]);

        $class2 = Event::factory()->make([
            'from_time' => '12:00',
            'to_time'   => '13:00',
        ]);

        $this->assertTrue($class1->has_started);
        $this->assertFalse($class2->has_started);
    }

    public function test_getFromTimeAttribute_only_returns_hour_and_minutes()
    {
        $class = Event::factory()->make();

        $this->assertEquals(5, strlen($class->from_time));
    }

    public function test_getToTimeAttribute_only_returns_hour_and_minutes()
    {
        $class = Event::factory()->make();

        $this->assertEquals(5, strlen($class->to_time));
    }
}
