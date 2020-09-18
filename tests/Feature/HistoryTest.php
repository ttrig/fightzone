<?php

namespace Tests\Feature;

use App\Models\Text;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $infoText = Text::factory()->create([
            'route' => 'history',
            'name' => 'info',
        ]);

        $this->get(route('history'))
            ->assertOk()
            ->assertSeeText(__('app.history.title'))
            ->assertSeeText($infoText->content)
        ;
    }
}
