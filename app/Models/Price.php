<?php

namespace App\Models;

class Price extends AuditableModel
{
    protected $guarded = ['activity_id'];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
