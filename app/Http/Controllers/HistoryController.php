<?php

namespace App\Http\Controllers;

use App\Repositories\PageRepository;

class HistoryController extends Controller
{
    public function __invoke(PageRepository $page)
    {
        return view('history', ['texts' => $page->texts()]);
    }
}
