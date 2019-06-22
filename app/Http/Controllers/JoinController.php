<?php

namespace App\Http\Controllers;

use App\Repositories\PageRepository;

class JoinController extends Controller
{
    public function __invoke(PageRepository $page)
    {
        $texts = $page->texts();
        return view('join', compact('texts'));
    }
}
