<?php

namespace App\Http\Controllers;

use App\Repositories\PageRepository;

class PriceController extends Controller
{
    public function __invoke(PageRepository $page)
    {
        $alerts = $page->alerts();
        $texts = $page->texts();

        return view('prices', compact('alerts', 'texts'));
    }
}
