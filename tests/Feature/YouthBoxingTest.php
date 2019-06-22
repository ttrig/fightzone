<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Text;

class YouthBoxingTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $infoText = factory(Text::class)->create([
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
