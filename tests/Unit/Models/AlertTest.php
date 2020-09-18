<?php

namespace Tests\Unit\Models;

use App\Models\Alert;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AlertTest extends TestCase
{
    use RefreshDatabase;

    public function test_scopeIsActive()
    {
        Alert::factory()->active()->create();
        Alert::factory()->inactive()->create();

        $this->assertEquals(1, Alert::active()->count());
    }

    public function test_isActive()
    {
        $alert1 = Alert::factory()->active()->make();
        $alert2 = Alert::factory()->inactive()->make();

        $this->assertTrue($alert1->isActive());
        $this->assertFalse($alert2->isActive());
    }
}
