<?php

namespace Tests\Unit\Traits;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HasOpenMatTest extends TestCase
{
    use RefreshDatabase;

    public function test_content_is_cleared_when_open_mat()
    {
        $class = Event::factory()->create();
        $class->update(['is_open_mat' => true]);

        $this->assertNull($class->content_en);
        $this->assertNull($class->content_sv);
    }

    public function test_content_is_the_same_when_not_open_mat()
    {
        $class = Event::factory()->create();
        $class->update(['is_open_mat' => false]);

        $this->assertNotEmpty($class->content_en);
        $this->assertNotEmpty($class->content_sv);
    }
}
