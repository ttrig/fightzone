<?php

namespace App\Transformers;

use App\Models\Event;
use Illuminate\Support\Collection;

class ScheduleTransformer
{
    private $colorMap = [
        1 => 'RoyalBlue',
        2 => 'DarkGoldenrod',
        3 => 'Green',
        4 => 'DarkSlateGray',
        5 => 'DarkRed',
        6 => 'DarkMagenta',
        7 => 'HotPink',
    ];

    /**
     * Returns fullcalendar events for the given models.
     *
     * @param  $events  Collection with Event models.
     * @see  https://fullcalendar.io/docs/event-source-object
     */
    public function fullcalendarEvents(Collection $events): array
    {
        return $events->map(function (Event $event) {
            $day = now()->startOfWeek()->addDay($event->dow - 1);

            return [
                'title' => $this->getTitle($event),
                'start' => $day->setTimeFromTimeString($event->from_time)->toDateTimeString(),
                'end' => $day->setTimeFromTimeString($event->to_time)->toDateTimeString(),
                'textColor' => '#fff',
                'backgroundColor' => $this->getColor($event),
                'borderColor' => $this->getColor($event),
                'slug' => $event->activity->slug,
            ];
        })->toArray();
    }

    /**
     * Returns a list of events for the given Event models.
     *
     * @example
     *  [
     *      'slug' => 'bjj',
     *      'route' => 'bjj',
     *      'title' => 'Brazilian Jiu-jitsu',
     *      'classes' => [
     *          0 => [Event, ...]
     *          1 => [Event, ...]
     *          ...
     *      ],
     *  ]
     * @see  https://fullcalendar.io/docs/event-source-object
     */
    public function listItems(Collection $events): array
    {
        $items = collect([
            [
                'slug' => 'bjj',
                'route' => 'bjj',
                'title' => __('app.activity.bjj'),
            ],
            [
                'slug' => 'kids_bjj',
                'route' => 'kids_bjj',
                'title' => __('app.activity.kids_bjj'),
            ],
            [
                'slug' => 'kickboxing',
                'route' => 'kickboxing',
                'title' => __('app.activity.kickboxing'),
            ],
            [
                'slug' => 'boxing',
                'route' => 'boxing',
                'title' => __('app.activity.boxing'),
            ],
            [
                'slug' => 'wrestling',
                'route' => 'wrestling',
                'title' => __('app.activity.wrestling'),
            ],
            [
                'slug' => 'nogi',
                'route' => 'nogi',
                'title' => __('app.activity.nogi') . ' (no-gi)',
            ],
            [
                'slug' => 'sac',
                'route' => 'sac',
                'title' => __('app.activity.sac'),
            ],
        ]);

        return $items->map(function ($item) use ($events) {
            $item['classes'] = $events->where('activity.slug', $item['slug'])
                ->groupBy('dow');
            return $item;
        })->toArray();
    }

    private function getTitle(Event $event): string
    {
        $title = "\n";
        if ($event instanceof Event) {
            $title .= $event->activity->name . "\n";
        }

        if ($event->is_open_mat) {
            $title .= 'Open mat';
        } elseif ($event->content) {
            $title .= $event->content;
        }

        return $title;
    }

    private function getColor(Event $event): string
    {
        return $this->colorMap[$event->activity->id] ?? '#ccc';
    }
}
