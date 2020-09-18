<?php

namespace Tests\Feature;

use App\Models\Text;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FacilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $infoText = Text::factory()->create([
            'route' => 'facility',
            'name' => 'info',
        ]);

        $this->get(route('facility'))
            ->assertOk()
            ->assertSeeText(__('app.facility.title'))
            ->assertSeeText($infoText->content)
        ;
    }
}
