<?php

namespace App\Traits;

trait HasContent
{
    /**
     * Get text content (html) based on current locale.
     */
    public function getContentAttribute()
    {
        if (app()->isLocale('en')) {
            return $this->content_en;
        }
        return $this->content_sv;
    }
}
