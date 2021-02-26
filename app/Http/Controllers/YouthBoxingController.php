<?php

namespace App\Http\Controllers;

use App\Repositories\PageRepository;

class YouthBoxingController extends Controller
{
    public function __invoke(PageRepository $page)
    {
        return view('youth_kickboxing', [
            'alerts' => $page->alerts(),
            'texts' => $page->texts(),
        ]);
    }
}
