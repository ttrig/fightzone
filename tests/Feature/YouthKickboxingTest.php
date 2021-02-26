<?php

namespace Tests\Feature;

use App\Models\Text;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class YouthKickboxingTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $infoText = Text::factory()->create([
            'route' => 'youth_kickboxing',
            'name' => 'info',
        ]);

        $this->get(route('youth_kickboxing'))
            ->assertOk()
            ->assertSeeTextInOrder([
                __('app.youth_kickboxing.title'),
                $infoText->content,
            ])
        ;
    }
}
