<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Text;

class KidsBoxingTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $infoText = factory(Text::class)->create([
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
