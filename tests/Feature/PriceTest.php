<?php

namespace Tests\Feature;

use App\Models\Price;
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

        $comboText = factory(Text::class)->create([
            'route' => 'prices',
            'name' => 'combo',
        ]);

        $price = factory(Price::class)->create();

        $this->get(route('prices'))
            ->assertOk()
            ->assertSeeTextInOrder([
                __('app.prices.title'),
                $infoText->content,
                __('app.prices.adults'),
                __('app.prices.year'),
                trans_choice('app.prices.months', 6),
                trans_choice('app.prices.months', 1),
                __('app.prices.bjj'),
                __('app.activity.boxing'),
                __('app.activity.kickboxing'),
                __('app.activity.wrestling'),
                __('app.activity.nogi'),
                __('app.prices.youths'),
                $comboText->content,
            ])
            ->assertSeeTextInOrder($price->only([
                'adult_1_y',
                'adult_6_m',
                'adult_1_m',
                'youth_1_y',
                'youth_6_m',
                'youth_1_m',
            ]))
        ;
    }
}
