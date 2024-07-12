<?php

namespace App\Http\Controllers;

use App\Models\Text;

class SitemapController extends Controller
{
    private $routes = [
        'home' => [
            'changefreq' => 'daily',
            'priority' => '0.8',
        ],
        'schedule' => [
            'changefreq' => 'daily',
            'priority' => '0.7',
        ],
        'prices' => [
            'changefreq' => 'daily',
            'priority' => '0.7',
        ],
        'payment.index' => [
            'changefreq' => 'monthly',
            'priority' => '0.5',
        ],
        'join' => [
            'changefreq' => 'monthly',
            'priority' => '0.4',
        ],
        'history' => [
            'changefreq' => 'monthly',
            'priority' => '0.6',
        ],
        'facility' => [
            'changefreq' => 'monthly',
            'priority' => '0.6',
        ],
        'partners' => [
            'changefreq' => 'monthly',
            'priority' => '0.6',
        ],
        'contact' => [
            'changefreq' => 'monthly',
            'priority' => '0.6',
        ],
        'bjj' => [
            'changefreq' => 'monthly',
            'priority' => '0.4',
        ],
        'kids_bjj' => [
            'changefreq' => 'monthly',
            'priority' => '0.4',
        ],
        'boxing' => [
            'changefreq' => 'monthly',
            'priority' => '0.4',
        ],
        'youth_boxing' => [
            'changefreq' => 'monthly',
            'priority' => '0.4',
        ],
        'kickboxing' => [
            'changefreq' => 'monthly',
            'priority' => '0.4',
        ],
        'youth_kickboxing' => [
            'changefreq' => 'monthly',
            'priority' => '0.4',
        ],
        'sac' => [
            'changefreq' => 'monthly',
            'priority' => '0.4',
        ],
        'gym' => [
            'changefreq' => 'monthly',
            'priority' => '0.4',
        ],
    ];

    public function __invoke()
    {
        $texts = Text::select('route', 'updated_at')
            ->orderBy('updated_at', 'desc')
            ->get()
        ;

        $urls = collect($this->routes)->map(function ($array, $route) use ($texts) {
            $updatedAt = optional($texts->firstWhere('route', $route))->updated_at;

            return [
                'loc' => route($route),
                'lastmod' => $updatedAt ? $updatedAt->toDateString() : null,
                'changefreq' => $array['changefreq'] ?? null,
                'priority' => $array['priority'] ?? null,
            ];
        });

        return response()
            ->view('sitemap', compact('urls'))
            ->header('Content-Type', 'text/xml')
        ;
    }
}
