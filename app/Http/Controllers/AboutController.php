<?php

namespace App\Http\Controllers;

use App\Repositories\PageRepository;

class AboutController extends Controller
{
    public function __invoke(PageRepository $page)
    {
        $texts = $page->texts();
        return view('about', compact('texts'));
    }
}
