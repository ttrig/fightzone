<?php

namespace App\Traits;

trait HasTimes
{
    /**
     * @note  We dont care what day it is here.
     */
    public function getHasStartedAttribute()
    {
        return $this->from_time <= now()->format('H:i');
    }

    public function getFromTimeAttribute($val)
    {
        return $this->formatTime($val);
    }

    public function getToTimeAttribute($val)
    {
        return $this->formatTime($val);
    }

    protected function formatTime($val)
    {
        return substr($val, 0, 5);
    }
}
