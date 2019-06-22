<?php

namespace App\Http\Controllers;

use App\Repositories\PageRepository;
use App\Repositories\ScheduleRepository;

class KidsBjjController extends Controller
{
    public function __invoke(
        PageRepository $page,
        ScheduleRepository $scheduleRepo
    ) {
        $events = $scheduleRepo
            ->getWeekSchedule()
            ->where('activity.slug', 'kids_bjj')
        ;

        return view('kids_bjj', [
            'alerts' => $page->alerts(),
            'texts' => $page->texts(),
            'eventList' => $events->groupBy('dow'),
        ]);
    }
}
