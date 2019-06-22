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
        factory(Alert::class)->states('active')->create();
        factory(Alert::class)->states('inactive')->create();
        $this->assertEquals(1, Alert::active()->count());
    }

    public function test_isActive()
    {
        $alert1 = factory(Alert::class)->states('active')->make();
        $alert2 = factory(Alert::class)->states('inactive')->make();
        $this->assertTrue($alert1->isActive());
        $this->assertFalse($alert2->isActive());
    }
}
