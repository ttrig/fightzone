<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateEvent;
use App\Http\Requests\UpdateEvent;
use App\Models\Activity;
use App\Models\Event;

class EventController extends AdminController
{
    public function index()
    {
        $activities = Activity::with('events')->get();
        return view('admin.event.index', compact('activities'));
    }

    public function create()
    {
        $event = new Event();
        $activities = Activity::all();
        return view('admin.event.form', compact('activities', 'event'));
    }

    public function edit(Event $event)
    {
        $event->load('activity');
        return view('admin.event.form', compact('event'));
    }

    public function store(CreateEvent $request)
    {
        $event = Event::create($request->validated());
        return redirect()
            ->route('admin.event.index')
            ->with('success', 'Scheduled event created!')
            ->with('created', $event->id)
        ;
    }

    public function update(UpdateEvent $request, Event $event)
    {
        $event->update($request->validated());
        return redirect()
            ->route('admin.event.index')
            ->with('success', 'Scheduled event updated!')
            ->with('updated', $event->id)
        ;
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()
            ->route('admin.event.index')
            ->with('success', 'Scheduled event deleted!')
        ;
    }
}
