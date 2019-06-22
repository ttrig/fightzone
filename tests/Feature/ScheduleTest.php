<?php

namespace Tests\Feature;

use App\Models\Alert;
use App\Models\Event;
use App\Models\Text;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScheduleTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $event1 = factory(Event::class)->create();
        $event2 = factory(Event::class)->state('open-mat')->create();

        $this->get(route('schedule'))
            ->assertOk()
            ->assertSeeTextInOrder([
                __('app.schedule.title'),
                __('app.home.schedule.title'),
            ])
            ->assertSeeText($event1->activity->name)
            ->assertSeeText($event1->content)
            ->assertSeeText($event2->activity->name)
            ->assertSeeText('Open mat')
        ;
    }

    public function test_index_with_info_text()
    {
        $infoText = factory(Text::class)->create([
            'route' => 'schedule',
            'name' => 'info',
        ]);

        $this->get(route('schedule'))
            ->assertOk()
            ->assertSeeText($infoText->content)
        ;
    }

    public function test_index_with_alert()
    {
        $alert = factory(Alert::class)->create();

        $this->get(route('schedule'))
            ->assertOk()
            ->assertSeeText($alert->content)
        ;
    }
}
