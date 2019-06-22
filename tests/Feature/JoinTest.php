<?php

namespace Tests\Feature;

use App\Models\Text;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JoinTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $infoText = factory(Text::class)->create([
            'route' => 'join',
            'name' => 'info',
        ]);

        $this->get(route('join'))
            ->assertOk()
            ->assertSeeTextInOrder([
                __('app.join.title'),
                __('app.join.text'),
                __('app.join.schedule'),
                __('app.join.prices'),
                $infoText->content,
            ])
        ;
    }
}
