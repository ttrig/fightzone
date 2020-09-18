<?php

namespace Tests\Feature;

use App\Models\Text;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KidsBoxingTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $infoText = Text::factory()->create([
            'route' => 'kids_boxing',
            'name' => 'info',
        ]);

        $this->get(route('kids_boxing'))
            ->assertOk()
            ->assertSeeTextInOrder([
                __('app.kids_boxing.title'),
                $infoText->content,
            ])
        ;
    }
}
