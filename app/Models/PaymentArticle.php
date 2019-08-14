<?php

namespace App\Models;

use App\Traits\HasContent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ttrig\Billmate\Article as BillmateArticle;

class PaymentArticle extends AuditableModel
{
    use HasContent;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        if (optional(request()->route())->getPrefix() === '/admin') {
            return $this->primaryKey;
        }

        return 'number';
    }

    public function getNameAttribute()
    {
        return app()->isLocale('en')
            ? $this->name_en
            : $this->name_sv
        ;
    }

    public function getFormattedPriceAttribute()
    {
        $formatted = app()->isLocale('en')
            ? number_format($this->price)
            : number_format($this->price, 2, ',', ' ')
        ;

        return preg_replace('/[\.,]00$/', '', $formatted);
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function billmateArticle()
    {
        return new BillmateArticle([
            'artnr' => $this->number,
            'title' => $this->name,
            'price' => $this->price,
            'quantity' => 1,
            'taxrate' => 0,
            'discount' => 0,
        ]);
    }
}
