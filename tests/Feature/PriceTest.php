<?php

namespace Tests\Feature;

use App\Models\Text;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PriceTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $infoText = factory(Text::class)->create([
            'route' => 'prices',
            'name' => 'info',
        ]);

        $tablesText = factory(Text::class)->state('table')->create([
            'route' => 'prices',
            'name' => 'tables',
        ]);

        $this->get(route('prices'))
            ->assertOk()
            ->assertSeeTextInOrder([
                __('app.prices.title'),
                $infoText->content,
            ])
            ->assertSee($tablesText->content, $escaped = false)
        ;
    }
}
