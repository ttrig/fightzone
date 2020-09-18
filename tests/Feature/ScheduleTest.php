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
        $event1 = Event::factory()->create();
        $event2 = Event::factory()->openMat()->create();

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

    public function test_index_dont_show_disabled_events()
    {
        $event1 = Event::factory()->create();
        $event2 = Event::factory()->disabled()->create();

        $this->get(route('schedule'))
            ->assertOk()
            ->assertSeeText($event1->content)
            ->assertDontSeeText($event2->content)
        ;
    }

    public function test_index_with_info_text()
    {
        $infoText = Text::factory()->create([
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
        $alert = Alert::factory()->create();

        $this->get(route('schedule'))
            ->assertOk()
            ->assertSeeText($alert->content)
        ;
    }
}
