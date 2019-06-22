<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Repositories\PageRepository;

class PriceController extends Controller
{
    public function __invoke(PageRepository $page)
    {
        $alerts = $page->alerts();
        $texts = $page->texts();
        $prices = Price::with('activity')->get();
        return view('prices', compact('alerts', 'texts', 'prices'));
    }
}
