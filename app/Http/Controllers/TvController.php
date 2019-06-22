<?php

namespace App\Http\Controllers;

use App\Repositories\ScheduleRepository;

class TvController extends Controller
{
    public function __invoke(ScheduleRepository $schedule)
    {
        $activities = $schedule->getWeekSchedule()
            ->groupBy('activity.slug')
            ->sortKeys()
            ->map(function ($events) {
                return $events->groupBy('dow');
            })
        ;

        return view('tv', compact('activities'));
    }
}
