<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Event;
use App\Models\Text;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KidsBjjTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $infoText = factory(Text::class)->create([
            'route' => 'kids_bjj',
            'name' => 'info',
        ]);

        $events = factory(Event::class, 4)->make();

        factory(Activity::class)
            ->create(['slug' => 'kids_bjj'])
            ->events()
            ->saveMany($events);

        $this->get(route('kids_bjj'))
            ->assertOk()
            ->assertSeeTextInOrder([
                __('app.kids_bjj.title'),
                __('app.kids_bjj.modal_schedule_show'),
                __('app.kids_bjj.more'),
                __('app.schedule.title'),
                __('app.kids_bjj.modal_schedule_title'),
            ])
            ->assertSeeTextInOrder([
                $infoText->content,
                $events->first()->title,
            ])
        ;
    }
}
