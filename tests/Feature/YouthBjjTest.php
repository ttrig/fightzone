<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\Event;
use App\Models\Text;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class YouthBjjTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $infoText = Text::factory()->create([
            'route' => 'youth_bjj',
            'name' => 'info',
        ]);

        $events = Event::factory(4)->make();

        Activity::factory()
            ->create(['slug' => 'youth_bjj'])
            ->events()
            ->saveMany($events);

        $this->get(route('youth_bjj'))
            ->assertOk()
            ->assertSeeTextInOrder([
                __('app.youth_bjj.title'),
                __('app.youth_bjj.modal_schedule_show'),
                __('app.youth_bjj.more'),
                __('app.schedule.title'),
                __('app.youth_bjj.modal_schedule_title'),
            ])
            ->assertSeeTextInOrder([
                $infoText->content,
                $events->first()->title,
            ])
        ;
    }
}
