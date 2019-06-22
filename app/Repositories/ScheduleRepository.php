<?php

namespace App\Repositories;

use App\Models\Event;
use Illuminate\Support\Collection;

class ScheduleRepository
{
    public function getTodaysSchedule(): Collection
    {
        return Event::with('activity')
            ->where('dow', now()->dayOfWeekIso)
            ->orderBy('from_time')
            ->orderBy('to_time')
            ->get()
        ;
    }

    public function getWeekSchedule(): Collection
    {
        return Event::with('activity')
            ->orderBy('dow')
            ->orderBy('from_time')
            ->orderBy('to_time')
            ->get()
        ;
    }
}
