<?php

namespace Tests\Unit;

use App\Models\Activity;
use App\Models\Event;
use App\Transformers\ScheduleTransformer;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScheduleTransformerTest extends TestCase
{
    use RefreshDatabase;

    public function test_fullcalendarEvents()
    {
        Carbon::setTestNow('2019-01-01 12:00:00');

        $event1 = factory(Event::class)->create();
        $event2 = factory(Event::class)->state('open-mat')->create();

        $events = collect([$event1, $event2]);
        $result = (new ScheduleTransformer())->fullcalendarEvents($events);

        $this->assertEquals([
            [
                'title' => "\n" . $event1->activity->name . "\n" . $event1->content,
                'start' => '2019-01-01 12:00:00',
                'end' => '2019-01-01 13:00:00',
                'textColor' => '#fff',
                'backgroundColor' => 'RoyalBlue',
                'borderColor' => 'RoyalBlue',
                'slug' => $event1->activity->slug,
            ],
            [
                'title' => "\n" . $event2->activity->name . "\nOpen mat",
                'start' => '2019-01-01 12:00:00',
                'end' => '2019-01-01 13:00:00',
                'textColor' => '#fff',
                'backgroundColor' => 'DarkGoldenrod',
                'borderColor' => 'DarkGoldenrod',
                'slug' => $event2->activity->slug,
            ],
        ], $result);
    }

    public function test_listItems()
    {
        $activity = factory(Activity::class)->create(['slug' => 'bjj']);
        $event = $activity->events()->save(factory(Event::class)->make());

        $items = (new ScheduleTransformer())->listItems(collect([$event]));
        $item = collect($items)->firstWhere('slug', $activity->slug);

        $this->assertEquals($item['classes']->get($event->dow)->first(), $event);
    }
}
