<?php

namespace App\Http\Controllers;

use App\Repositories\PageRepository;

class AboutController extends Controller
{
    public function __invoke(PageRepository $page)
    {
        return view('about', ['texts' => $page->texts()]);
    }
}
