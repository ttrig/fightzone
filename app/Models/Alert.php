<?php

namespace App\Models;

use App\Traits\HasContent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alert extends AuditableModel
{
    use HasContent;
    use HasFactory;

    // color to class-name mapping
    public const COLORS = [
        'red'    => 'danger',
        'yellow' => 'warning',
        'green'  => 'success',
        'blue'   => 'info',
    ];

    public const AVAILABLE_ROUTES = [
        'home',
        'prices',
        'schedule',
        'kids_bjj',
        'kids_boxing',
    ];

    protected $guarded = [];

    protected $casts = [
        'routes' => 'array',
    ];

    protected $dates = [
        'from_date',
        'to_date',
    ];

    public function scopeActive($query)
    {
        $now = now();

        return $query
            ->where('from_date', '<=', $now)
            ->where('to_date', '>', $now)
            ->orderBy('from_date')
        ;
    }

    public function isActive(): bool
    {
        $now = now()->startOfDay();

        return $this->from_date->lte($now)
            && $this->to_date->gt($now)
        ;
    }
}
