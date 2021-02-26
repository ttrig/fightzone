<?php

namespace Tests\Feature;

use App\Models\Text;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrainingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @dataProvider pageProvider
     */
    public function test_route($route)
    {
        $infoText = Text::factory()->create([
            'route' => $route,
            'name' => 'info',
        ]);

        $this->get(route($route))
            ->assertOk()
            ->assertSeeText(__('app.activity.' . $route))
            ->assertSeeText($infoText->content)
        ;
    }

    public function pageProvider()
    {
        return [
            ['bjj'],
            ['boxing'],
            ['kickboxing'],
            ['nogi'],
            ['sac'],
            ['gym'],
        ];
    }
}
