<?php

namespace Tests\Feature;

use App\Models\Text;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SitemapTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        Text::factory()->create([
            'route' => 'home',
            'updated_at' => '2001-01-01 00:00:00',
        ]);

        Text::factory()->create([
            'route' => 'home',
            'updated_at' => '2002-01-01 00:00:00',
        ]);

        $this->get(route('sitemap'))
            ->assertOk()
            ->assertHeader('Content-Type', 'text/xml; charset=UTF-8')
            ->assertSeeInOrder([
                '<loc>' . route('home') . '</loc>',
                '<lastmod>2002-01-01</lastmod>',
            ], $escaped = false)
        ;
    }
}
