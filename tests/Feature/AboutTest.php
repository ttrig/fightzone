<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Text;

class AboutTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $infoText = factory(Text::class)->create([
            'route' => 'about',
            'name' => 'info',
        ]);

        $facilityText = factory(Text::class)->create([
            'route' => 'about',
            'name' => 'facility',
        ]);

        $this->get(route('about'))
            ->assertOk()
            ->assertSeeTextInOrder([
                __('app.about.title'),
                __('app.about.facility'),
            ])
            ->assertSeeText($infoText->content)
            ->assertSeeText($facilityText->content)
        ;
    }
}
