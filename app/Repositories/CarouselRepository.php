<?php

namespace App\Repositories;

class CarouselRepository
{
    public function get()
    {
        return collect([
            [
                'title' => null,
                'text'  => null,
                'route' => null,
                'image' => '/images/carousel/fightzone.jpg',
                'imageStyles' => 'object-position:50% 50%',
            ],
            [
                'title' => __('app.activity.bjj'),
                'text'  => 'bjj',
                'route' => 'bjj',
                'image' => '/images/carousel/bjj2.jpg'
            ],
            [
                'title' => __('app.activity.boxing'),
                'text'  => 'boxing',
                'route' => 'boxing',
                'image' => '/images/carousel/boxing.jpg'
            ],
            [
                'title' => __('app.activity.kickboxing'),
                'text'  => 'kickboxing',
                'route' => 'kickboxing',
                'image' => '/images/carousel/kickboxing.jpg',
            ],
            [
                'title' => __('app.activity.nogi'),
                'text'  => 'nogi',
                'route' => 'nogi',
                'image' => '/images/carousel/nogi.jpg'
            ],
        ]);
    }
}
