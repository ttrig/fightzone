<?php

namespace App\Models;

use App\Traits\HasContent;
use App\Traits\HasOpenMat;
use App\Traits\HasTimes;

class Event extends AuditableModel
{
    use HasContent;
    use HasOpenMat;
    use HasTimes;

    protected $guarded = [];

    protected $casts = [
        'is_enabled' => 'bool',
        'is_open_mat' => 'bool',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function scopeEnabled($query)
    {
        $query->where('is_enabled', true);
    }
}
