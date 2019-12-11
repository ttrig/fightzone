<?php

namespace App\Repositories;

use App\Models\Alert;
use App\Models\Text;
use Illuminate\Support\Collection;
use Illuminate\Support\Fluent;

class PageRepository
{
    public function alerts(): ?Collection
    {
        return Alert::active()
            ->latest()
            ->get()
            ->filter(function ($alert) {
                return empty($alert->routes)
                    || in_array($this->getRouteName(), $alert->routes)
                ;
            });
    }

    public function texts(): Fluent
    {
        $texts = Text::where('route', $this->getRouteName())
            ->get()
            ->mapWithKeys(fn($text) => [$text->name => $text->content])
        ;

        return new Fluent($texts);
    }

    public function getRouteName(): ?string
    {
        return request()->route()->getName();
    }
}
