<?php

namespace App\Http\Controllers;

use App\Repositories\PageRepository;

class FacilityController extends Controller
{
    public function __invoke(PageRepository $page)
    {
        return view('facility', ['texts' => $page->texts()]);
    }
}
