<?php

namespace App\Http\Controllers;

use App\Repositories\CarouselRepository;
use App\Repositories\PageRepository;
use App\Repositories\ScheduleRepository;

class HomeController extends Controller
{
    public function index(
        CarouselRepository $carousel,
        ScheduleRepository $schedule,
        PageRepository $page
    ) {
        $carousel = $carousel->get();
        $texts = $page->texts();
        $alerts = $page->alerts();
        $today = $schedule->getTodaysSchedule();

        return view('home', compact('carousel', 'texts', 'alerts', 'today'));
    }

    /**
     * Change user locale.
     * @see  App\Middleware\SetLocale
     */
    public function lang($str)
    {
        session()->put('locale', $str);

        return redirect()->back();
    }
}
