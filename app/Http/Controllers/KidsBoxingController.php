<?php

namespace App\Http\Controllers;

use App\Repositories\PageRepository;

class KidsBoxingController extends Controller
{
    public function __invoke(PageRepository $page)
    {
        return view('kids_boxing', [
            'alerts' => $page->alerts(),
            'texts' => $page->texts(),
        ]);
    }
}
