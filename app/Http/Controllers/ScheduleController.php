<?php

namespace App\Http\Controllers;

use App\Repositories\PageRepository;
use App\Repositories\ScheduleRepository;
use App\Transformers\ScheduleTransformer;

class ScheduleController extends Controller
{
    public function __invoke(
        PageRepository $pageRepo,
        ScheduleRepository $scheduleRepo,
        ScheduleTransformer $scheduleTransformer
    ) {
        $weekSchedule = $scheduleRepo->getWeekSchedule();

        $filterOptions = $weekSchedule->mapWithKeys(
            fn($event) => [$event->activity->slug => $event->activity->name]
        )->sort();

        return view('schedule', [
            'alerts' => $pageRepo->alerts(),
            'texts' => $pageRepo->texts(),
            'today' => $scheduleRepo->getTodaysSchedule(),
            'listItems' => $scheduleTransformer->listItems($weekSchedule),
            'filterOptions' => $filterOptions,
            'calendarEvents' => $scheduleTransformer->fullcalendarEvents($weekSchedule),
        ]);
    }
}
