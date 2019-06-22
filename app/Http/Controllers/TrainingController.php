<?php

namespace App\Http\Controllers;

use App\Repositories\PageRepository;

class TrainingController extends Controller
{
    public function __invoke(PageRepository $page)
    {
        $routeName = $page->getRouteName();
        $texts = $page->texts();

        return view('training.' . $routeName, compact('texts'));
    }
}
