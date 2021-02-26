<?php

namespace Tests\Feature;

use App\Models\Text;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class YouthBoxingTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $infoText = Text::factory()->create([
            'route' => 'youth_boxing',
            'name' => 'info',
        ]);

        $this->get(route('youth_boxing'))
            ->assertOk()
            ->assertSeeTextInOrder([
                __('app.youth_boxing.title'),
                $infoText->content,
            ])
        ;
    }
}
