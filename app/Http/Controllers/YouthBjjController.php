<?php

namespace App\Http\Controllers;

use App\Repositories\PageRepository;
use App\Repositories\ScheduleRepository;

class YouthBjjController extends Controller
{
    public function __invoke(
        PageRepository $page,
        ScheduleRepository $scheduleRepo
    ) {
        $events = $scheduleRepo
            ->getWeekSchedule()
            ->where('activity.slug', 'youth_bjj')
        ;

        return view('youth_bjj', [
            'alerts' => $page->alerts(),
            'texts' => $page->texts(),
            'eventList' => $events->groupBy('dow'),
        ]);
    }
}
